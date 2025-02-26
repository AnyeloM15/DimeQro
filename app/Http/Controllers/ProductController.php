<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Auth;

use DataTables;

class ProductController extends Controller
{

    public function loadProducts(Request $request)
    {
            // Número de productos a mostrar por petición
            $limit = 20;

            // Offset para saber desde dónde comenzar a cargar productos (se recibe por AJAX)
            $offset = $request->get('offset', 0);

            // Obtener los productos activos, con sus relaciones: subcategoría, categoría, marca e imágenes
            $products = Product::where('active', 1)
                                ->with(['subcategory.category', 'brand', 'images'])
                                ->where('stock','>','0');
                                
            // Verifica si $category está definida y añade la condición de filtro
            if ($request->has('category')) {
                $products = $products->whereHas('subcategory.category', function ($query) use ($request) {
                    $query->where('categories.id', $request->get('category')); // Filtra por category.id
                });
            }

            // Verificar si la clave de búsqueda está presente
            if ($request->has('clave')) {
                $clave = $request->get('clave');
                
                // Filtrar productos que coincidan exactamente con la clave de búsqueda
                $products = Product::where(function ($query) use ($clave) {
                    $query->where('products.name', $clave)
                          ->orWhere('products.description', $clave)
                          ->orWhereHas('subcategory', function ($q) use ($clave) {
                              $q->where('subcategories.name', $clave);
                          })
                          ->orWhereHas('subcategory.category', function ($q) use ($clave) {
                              $q->where('categories.name', $clave);
                          })
                          ->orWhereHas('brand', function ($q) use ($clave) {
                              $q->where('brands.name', $clave);
                          });
                });
            
                // Si no hay coincidencias exactas, buscar coincidencias parciales
                if ($products->count() == 0) {
                    $palabrasClave = explode(' ', $clave);
            
                    $products = Product::where(function ($query) use ($palabrasClave) {
                        foreach ($palabrasClave as $palabra) {
                            $query->orWhere('products.name', 'like', "%{$palabra}%")
                                  ->orWhere('products.description', 'like', "%{$palabra}%")
                                  ->orWhereHas('subcategory', function ($q) use ($palabra) {
                                      $q->where('subcategories.name', 'like', "%{$palabra}%");
                                  })
                                  ->orWhereHas('subcategory.category', function ($q) use ($palabra) {
                                      $q->where('categories.name', 'like', "%{$palabra}%");
                                  })
                                  ->orWhereHas('brand', function ($q) use ($palabra) {
                                      $q->where('brands.name', 'like', "%{$palabra}%");
                                  });
                        }
                    });
                }
            }
            


            // Aplicar paginación con offset y limit
            $products = $products->skip($offset)
                                ->take($limit)
                                ->get();

            // Generar el HTML de los productos
            $html = '';
            foreach ($products as $product) {
                // Obtener la primera imagen del producto o usar la imagen por defecto
                $image = $product->images->first() ? asset( $product->images->first()->image) : asset('assets/admin/categories/1726875110_negro.png');
                
                // Verificar si la subcategoría y la categoría existen
                $subcategoryName = $product->subcategory ? $product->subcategory->name : 'Sin Subcategoría';
                $categoryName = $product->subcategory && $product->subcategory->category ? $product->subcategory->category->name : 'Sin Categoría';

                $product_short_name = strlen($product->name) > 35 ? substr($product->name, 0, 35) . '...' : $product->name;
                $html .= '
                    <div class="col-md-2">
                            <div class="product-item">
                                <a class="nav-link" href="'.url('producto').'/'.$product->id.'" style="text-decoration:none !important">
                                        <img src="' . $image . '" alt="' . $product->name . '" class="img-fluid" style="object-fit: cover; width: 100%; height: 300px; display: block; margin: 0 auto;">
                                        <h3>'.$product_short_name.'</h3>
                                        <span style="font-size:30px">$' .number_format($product->price, 2) . '</span> MXP<br>
                                        <span style="font-size:10px">Marca: ' . $product->brand->name . '</span>
                                        <span style="font-size:10px">Categoría: ' . $categoryName . ' / Subcategoría: ' . $subcategoryName . '</span><br>
                                        <span>Stock: ' . $product->stock . '</span>
                                </a>
                                <a style="text-decoration:none;background-color:#003588 !important;color:#fff !important ;padding:1px;border-radius:5px" href="'.url('producto').'/'.$product->id.'"  class="nav-link "><center><i class="fa fa-eye"></i> Ver producto</center> </a>
                            </div>
                    </div>';

            }
            $html .= '';

            // Devolver el HTML generado
            return response()->json(['html' => $html]);
    }

    public function categoriaProducts($id){
        $type='category';
        $complemento='de la Categoría '.Category::where('id',$id)->first()->name;
        return view('shop.search_product', compact('type','id','complemento'));
    }

    public function buscar(Request $request){
        $type='clave';
        $id=$request->get('producto');
        $complemento='de la Busqueda '.$id;
        return view('shop.search_product', compact('type','id','complemento'));
    }

    


    

    public function producto($id){
       
        $product = Product::where('active', 1)
        ->with(['subcategory.category', 'brand', 'images'])
        ->findOrFail($id);
        return view('shop.product', compact('product'));

    }


    public function cart(){
        session()->forget('last_order_id'); 
        return view('shop.cart');
    }

    public function getTotalCarrito(Request $request)
    {
        $totalCarrito = 0;
        $total = 0; // Total de artículos contando repetidos
        $totalProductosUnicos = 0; // Productos distintos en el carrito

        if (session()->has('carrito') && count(session('carrito')) > 0) {
            foreach (session('carrito') as $id => $item) {
                $product = \App\Models\Product::find($id);

                if ($product) {
                    $totalCarrito += $product->price * $item['cantidad'];
                    $total += $item['cantidad']; // Sumamos todas las cantidades de productos
                }
            }
            $totalProductosUnicos = count(session('carrito')); // Contamos productos distintos
        }

        return response()->json([
            'status' => 'success',
            'total' => $total, // Total de artículos contando repetidos
            'totalProductosUnicos' => $totalProductosUnicos, // Productos distintos en el carrito
            'precioTotal' => number_format($totalCarrito, 2) // Total en formato de moneda
        ]);
    }




    public function agregarAlCarrito(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'status' => 'login'
            ]);
        }

        // Validar datos
        $request->validate([
            'id' => 'required|integer|exists:products,id',
            'total' => 'required|integer|min:1'
        ]);

        // Iniciar sesión si no existe
        if (!session()->has('carrito')) {
            session()->put('carrito', []);
        }

        // Obtener el producto
        $product = Product::findOrFail($request->id);

        // Verificar stock
        if ($product->stock < $request->total) {
            return response()->json([
                'status' => 'error',
                'message' => 'No hay suficiente stock disponible.'
            ]);
        }

        // Obtener carrito actual
        $carrito = session()->get('carrito', []);

        // Si el producto ya está en el carrito, reemplazar la cantidad
        $carrito[$product->id] = [
            'cantidad' => $request->total, // 🔹 Ahora reemplaza la cantidad
            'precio' => $product->price
        ];

        // Guardar cambios en la sesión
        session()->put('carrito', $carrito);
        session()->save(); // 🔹 Forzar el guardado de la sesión
        session()->regenerate(); // 🔹 Regenerar sesión para evitar problemas de caché

        // Depuración: Verificar que el carrito no esté vacío
        \Log::info('Carrito actualizado:', $carrito);

        // Calcular precio total y cantidad total de artículos en el carrito
        $precioTotal = 0;
        $totalArticulos = 0;

        foreach ($carrito as $id => $item) {
            $precioTotal += $item['precio'] * $item['cantidad'];
            $totalArticulos += $item['cantidad'];
        }

        


        return response()->json([
            'status' => 'success',
            'total' => $totalArticulos, // 🔹 Cantidad total de artículos en el carrito
            'precioTotal' => number_format($precioTotal, 2)
        ]);
    }









    public function eliminarDelCarrito($id)
    {
        // Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        // Verificar si el producto existe en el carrito antes de eliminarlo
        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
            session()->save(); //  Asegura que la sesión se guarde inmediatamente
        }

        // Calcular el nuevo total en dinero y la cantidad total de artículos
        $totalCarrito = 0;
        $totalArticulos = 0;

        foreach ($carrito as $productoId => $item) {
            $product = \App\Models\Product::find($productoId);
            if ($product) {
                $totalCarrito += $product->price * $item['cantidad'];
                $totalArticulos += $item['cantidad']; //  Cuenta la cantidad total de productos en el carrito
            }
        }

        // Retornar respuesta JSON con la información actualizada del carrito
        return response()->json([
            'status' => 'success',
            'costo' => number_format($totalCarrito, 2), // Total en dinero formateado
            'total' => $totalArticulos //  Ahora devuelve la cantidad total de productos en el carrito
        ]);
    }






    

    

    public function marcaProducts($id){
        $type='brand';
        $complemento='de la Marca '.Brand::where('id',$id)->first()->name;
        return view('shop.search_product', compact('type','id','complemento'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            
                $data = Product::with('subcategory.category', 'brand')
                ->select(['id', 'product_code', 'name', 'description', 'price', 'stock', 'active', 'subcategory_id', 'brand_id'])
                ->latest();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('cover', function($row) {
                        // Busca la imagen de portada del producto
                        $cover = ProductImage::where('product_id', $row->id)->where('is_cover', 1)->first();
                    
                        // Comprueba si existe una imagen de portada y genera la etiqueta <img> correspondiente con un botón de eliminación
                        if ($cover) {
                            $img = '<div style="position: relative; display: inline-block;">';
                            $img .= '<img src="public/'.$cover->image.'" height="50" alt="Portada">';
                            $img .= '<button data-id="'.$cover->id.'" class="deleteImage deleteImage'.$cover->id.'" style="position: absolute; top: 0; right: 0; border: none; background-color: transparent; color: red; font-weight: bold;">&times;</button>';
                            $img .= '</div>';
                        } else {
                            $img = 'Sin imagen';  // Mensaje o imagen predeterminada si no hay portada
                        }
                    
                        return $img;
                    })
                    ->addColumn('additional_photos', function($row) {
                        // Busca todas las imágenes que no son de portada para este producto
                        $additionalPhotos = ProductImage::where('product_id', $row->id)
                                                        ->where('is_cover', '<>', 1)
                                                        ->get();
                    
                        // Concatenar todas las imágenes en una sola cadena HTML
                        $imagesHtml = '';
                        foreach ($additionalPhotos as $photo) {
                            $imagesHtml .= '<div style="display: inline-block; position: relative; margin-right: 5px;">';
                            $imagesHtml .= '<img src="public/'.$photo->image.'" class="deleteImage'.$photo->id.'" height="50" alt="Additional Photo">';
                            $imagesHtml .= '<button data-id="'.$photo->id.'" class="deleteImage deleteImage'.$photo->id.'"   style="position: absolute; top: 0; right: 0; border: none; background-color: transparent; color: red; font-weight: bold;">&times;</button>';
                            $imagesHtml .= '</div>';
                        }
                    
                        return $imagesHtml ?: 'Sin imágenes adicionales';  // Devuelve la cadena o un mensaje si no hay imágenes
                    })
                    ->addColumn('category', function($product) {
                        return optional($product->subcategory)->category->name ?? 'No Category';
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm" data-id="' . $row->id . '">Editar</a> ';
                        $btn .= '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" data-id="' . $row->id . '">Eliminar</a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'cover', 'additional_photos'])
                    ->make(true);// Asegúrate de devolver la vista si no es una solicitud AJAX
        }

        $subcategories = Subcategory::all(); // Obtener todas las subcategorías
        $brands = Brand::all();
        return view('admin.products.index', compact('subcategories', 'brands'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|integer|exists:subcategories,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'product_code' => 'required|string|max:255|unique:products,product_code,' . $request->product_id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);


    
        $product_id = $request->input('product_id');
        $product = Product::find($product_id);
    
        if (!$product) {
            $product = new Product();
        } else {
            // Si se está actualizando y el código del producto cambia, asegúrate de actualizar la validación
            $request->validate([
                'product_code' => 'required|string|max:255|unique:products,product_code,' . $product_id,
            ]);
        }
    
        $product->fill($request->all());
        $product->save();

        if ($request->hasFile('image')) {
            // Asegúrate de que product_id se obtiene correctamente
            $product_id = $request->input('product_id') ?: $product->id;
        
            // Verificar si ya existe una imagen de portada para este producto
            $image = ProductImage::where('product_id', $product_id)->where('is_cover', 1)->first();
        
            // Si no existe, crea una nueva instancia de ProductImage
            if (!$image) {
                $image = new ProductImage();
                $image->product_id = $product_id;  // Asegúrate de asignar product_id
                $image->is_cover = 1;  // Suponiendo que esta imagen debe ser la portada
            }
        
            // Construye el nombre del archivo y mueve el archivo subido
            $filename = time() . '_' . $request->image->getClientOriginalName();
            $destinationPath = public_path('/assets/admin/products');  // Verifica que esta ruta es correcta
            $request->image->move($destinationPath, $filename);
        
            // Guarda la ruta de la imagen en el modelo
            $image->image = 'assets/admin/products/' . $filename;
        
            // Guarda el modelo de imagen
            $image->save();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/assets/admin/products');  // Verifica que esta ruta es correcta y accesible
                $file->move($destinationPath, $filename);  // Mueve el archivo al directorio deseado
    
                // Crear y guardar la instancia de ProductImage para cada archivo
                $image = new ProductImage();
                $image->product_id = $request->input('product_id');  // Asegúrate de que este valor es proporcionado correctamente
                $image->image = 'assets/admin/products/' . $filename;  // Guarda la ruta relativa
                $image->is_cover = 0;  // Asumiendo que estas imágenes no son de portada
    
                $image->save();
            }
        }
    
        return response()->json(['success' => $product_id ? 'Producto actualizado exitosamente.' : 'Producto creado exitosamente.']);
    }

    public function edit($id)
    {
        $product = Product::with('subcategory', 'brand')->find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            // Establece el campo 'active' en 0 para un borrado lógico
            $product->active = 0;
            $product->save(); // Guarda el cambio en la base de datos

            return response()->json(['success' => 'Producto desactivado exitosamente.']);
        }

        return response()->json(['error' => 'Producto no encontrado.'], 404);
    }

    
    public function destroyPhoto($id)
    {
        $photo = ProductImage::find($id);
        if ($photo) {
            // Opcional: Eliminar archivo de imagen del servidor
            $filePath = public_path($photo->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Eliminar el registro de la base de datos
            $photo->delete();
            return response()->json(['success' => 'Imagen eliminada exitosamente.']);
        }

        return response()->json(['error' => 'Imagen no encontrada.'], 404);
    }

    public function checkAndMoveImages()
    {
        // Obtener todas las imágenes de la tabla product_images
        $images = ProductImage::all();

        foreach ($images as $image) {
            // Ruta completa de la imagen en la carpeta assets/admin/products/
            $imagePath = public_path('assets/admin/products/' . basename($image->image));

            // Verificar si la imagen existe en el servidor
            if (File::exists($imagePath)) {
                // Si la imagen existe, moverla a la carpeta assets/admin/exist/
                $newPath = public_path('assets/admin/exist/' . basename($image->image));
                File::move($imagePath, $newPath);

                // Actualizar la ruta en la base de datos
                $image->image = 'assets/admin/exist/' . basename($image->image);
                $image->save();
            } else {
                // Si la imagen no existe, eliminar el registro
                $image->delete();
            }
        }

        return "Operación completada.";
    }

    public function exportCSV()
    {
        // Crear una respuesta de tipo streaming
        $response = new StreamedResponse(function () {

            // Abrir un "archivo" para escritura en el buffer de salida
            $handle = fopen('php://output', 'w');

            // Agregar la cabecera UTF-8 (BOM) para evitar problemas con caracteres especiales
            fputs($handle, "\xEF\xBB\xBF");

            // Escribir los encabezados del CSV
            fputcsv($handle, [
                'ID', 'Categoría', 'Subcategoría', 'Marca', 'Código de Producto', 'Nombre', 'Descripción', 'Precio', 'Stock', 'Foto'
            ]);

            // Ejecutar la consulta y obtener los resultados
            $products = DB::select("
                SELECT 
                    a.id,
                    c.name as categoria,
                    b.name as subcategoria,
                    d.name as marca,
                    product_code,
                    a.name,
                    a.description,
                    price,
                    stock,
                    NVL(e.image,'-') as foto 
                FROM products a
                LEFT JOIN subcategories b ON b.id = a.subcategory_id
                LEFT JOIN categories c ON b.category_id = c.id
                LEFT JOIN brands d ON d.id = a.brand_id
                LEFT JOIN product_images e ON a.id = e.product_id
            ");

            // Iterar sobre los resultados de la consulta y escribir cada fila en el archivo CSV
            foreach ($products as $product) {
                fputcsv($handle, [
                    $product->id,
                    $product->categoria,
                    $product->subcategoria,
                    $product->marca,
                    $product->product_code,
                    $product->name,
                    $product->description,
                    $product->price,
                    $product->stock,
                    $product->foto
                ]);
            }

            // Cerrar el archivo en el buffer de salida
            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ]);

        return $response;
    }


    
}
