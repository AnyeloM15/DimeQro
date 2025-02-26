<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use DataTables;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'shipping_method' => 'required|in:tienda,domicilio',
            'shipping_address' => 'nullable|string|max:255'
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();
        $cart = session('carrito', []);

        if (empty($cart)) {
            return response()->json(['error' => 'El carrito está vacío.'], 400);
        }

        // Revisar si el usuario ya tiene un pedido en sesión para evitar duplicados
        if (session()->has('last_order_id')) {
            return response()->json([
                'success' => false,
                'message' => 'El pedido ya fue registrado.',
                'order_id' => session('last_order_id')
            ]);
        }

        // Calcular el total del pedido asegurando que los precios provengan de la base de datos
        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['error' => 'Producto no encontrado.'], 404);
            }

            // Validar si hay suficiente stock disponible
            if ($product->stock < $item['cantidad']) {
                return response()->json(['error' => "Stock insuficiente para el producto: {$product->name}"], 400);
            }

            $total += $product->price * $item['cantidad'];
        }

        // Definir la dirección de envío
        $shipping_address = ($request->shipping_method === 'domicilio') ? $request->shipping_address : 'Recoger en tienda';

        // Crear el pedido en la tabla `orders`
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending', // Estado inicial del pedido
            'shipping_address' => $shipping_address // Guardar la dirección en el pedido
        ]);

        // Guardar los productos comprados en `order_items` y descontar el stock
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['cantidad'],
                    'price' => $product->price // Precio al momento de la compra
                ]);

                // Descontar stock
                $product->stock -= $item['cantidad'];
                $product->save();
            }
        }

        // Guardar el ID del pedido en la sesión para evitar duplicaciones si el usuario refresca la página
        session(['last_order_id' => $order->id]);

        // Vaciar el carrito después de completar el pedido
        Session::forget('carrito');

        return response()->json([
            'success' => true,
            'message' => 'Pedido realizado correctamente.',
            'order_id' => $order->id
        ]);
    }

    public function index(Request $request)
    {
        $user = auth()->user();
    
        // Si es admin, ve todos los pedidos; si es cliente, solo ve los suyos
        $query = Order::with(['user']);
    
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }
    
        if ($request->ajax()) {
            $data = $query->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('comprobante', function ($order) {
                    return $order->comprobante;
                })
                ->addColumn('action', function ($row) use ($user) {
                    if ($user->role === 'admin') {
                        return '<button class="btn btn-primary btn-sm edit" data-id="' . $row->id . '">Editar</button>';
                    }
                    return '<span class="text-muted">No autorizado</span>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin.orders');
    }
    
    public function edit($id)
    {
        $order = Order::find($id);
        $user = auth()->user();
    
        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }
    
        // Si el usuario no es admin y el pedido no es suyo, bloquear acceso
        if ($user->role !== 'admin' && $order->user_id !== $user->id) {
            return response()->json(['error' => 'No autorizado.'], 403);
        }
    
        return response()->json($order);
    }
    
    public function update(Request $request, $id)
{
    $order = Order::with('items.product')->find($id);
    $user = auth()->user();

    if (!$order) {
        return response()->json(['error' => 'Pedido no encontrado.'], 404);
    }

    // Solo administradores pueden cambiar el estado
    if ($user->role !== 'admin' && $request->has('status')) {
        return response()->json(['error' => 'No autorizado para cambiar el estado del pedido.'], 403);
    }

    $request->validate([
        'status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled',
        'comments' => 'nullable|string',
        'comprobante' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
    ]);

    $previousStatus = $order->status; // Guardar el estado anterior

    if ($user->role === 'admin') {
        $order->status = $request->status;

        // Si el pedido se está cancelando, devolver el stock
        if ($previousStatus !== 'cancelled' && $request->status === 'cancelled') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->stock += $item->quantity; // Regresar el stock
                    $product->save();
                }
            }
        }

        // Si el pedido estaba cancelado y vuelve a otro estado, volver a descontar stock
        if ($previousStatus === 'cancelled' && $request->status !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    // Solo descontamos stock si hay suficiente disponible
                    if ($product->stock >= $item->quantity) {
                        $product->stock -= $item->quantity;
                        $product->save();
                    } else {
                        return response()->json(['error' => "Stock insuficiente para el producto: {$product->name}"], 400);
                    }
                }
            }
        }
    }

    $order->comments = $request->comments;

    // Subir comprobante si se envió
    if ($request->hasFile('comprobante')) {
        $file = $request->file('comprobante');
        $filename = 'comprobante_' . $order->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('comprobante/comprobantes/'), $filename);
        $order->comprobante = 'comprobante/comprobantes/' . $filename;
    }

    $order->save();

    return response()->json(['success' => 'Pedido actualizado correctamente.']);
}

    
    
    public function getOrderProducts($id)
{
    $order = Order::with('items.product.images')->find($id);
    
    if (!$order) {
        return response()->json(['error' => 'Pedido no encontrado.'], 404);
    }

    $html = '<table class="table table-sm table-bordered mt-2">';
    $html .= '<thead><tr><th>Imagen</th><th>Producto</th><th>Cantidad</th><th>Precio</th></tr></thead><tbody>';

    foreach ($order->items as $item) {
        // Obtener la primera imagen del producto si existe
        $image = $item->product->images->first() ? asset('public/'.$item->product->images->first()->image) : asset('images/default.png');

        $html .= '<tr>
                    <td><img src="'.$image.'" width="50" height="50" class="img-thumbnail"></td>
                    <td>'.$item->product->name.'</td>
                    <td>'.$item->quantity.'</td>
                    <td>$'.number_format($item->price, 2).' MXP</td>
                  </tr>';
    }

    $html .= '</tbody></table>';
    return response()->json($html);
}


public function uploadComprobante(Request $request, $id)
{
    $order = Order::find($id);

    if (!$order) {
        return back()->with('error', 'Pedido no encontrado.');
    }

    if ($request->hasFile('comprobante')) {
        $file = $request->file('comprobante');
        $filename = 'comprobante_' . $order->id . '.' . $file->getClientOriginalExtension();
        
        // Ruta de almacenamiento en public/comprobante/comprobantes/
        $destinationPath = public_path('comprobante/comprobantes/');
        
        // Mover el archivo al destino
        $file->move($destinationPath, $filename);
        
        // Guardar la ruta en la base de datos (solo la ruta relativa para evitar problemas)
        $order->comprobante = 'comprobante/comprobantes/' . $filename;
        $order->save();

        return back()->with('success', 'Comprobante subido correctamente.');
    }

    return back()->with('error', 'No se pudo subir el comprobante.');
}





    


}
