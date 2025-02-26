@extends('master')
@section('title', env('APP_NAME'))

@section('body')

    <div class="container-fluid">
        <div class="section-heading">
        <h2 class="section-title" style="color: #003588; letter-spacing: 0.5px; font-size: 28px;">
        Proceder al pago de los articulos selecionados<br><br>
              </h2>
        </div>
        
        @if(session()->has('carrito') && count(session('carrito')) > 0)
        <div id="carrito-body">
            @php
                $totalCarrito = 0;
            @endphp
            @foreach(session('carrito') as $id => $item)
                @php
                    // Obtener el producto basado en el id desde la base de datos
                    $product = \App\Models\Product::find($id);
                    $totalItem = $product->price * $item['cantidad'];
                    $totalCarrito += $totalItem;
                    // Obtener la imagen del producto o una imagen predeterminada
                    $image = $product->images->first() ? asset($product->images->first()->image) : asset('assets/admin/categories/1726875110_negro.png');
                @endphp

                <!-- Producto individual en el carrito -->
                <div class="carrito-item row mb-3 p-3 border rounded" id="product-{{ $id }}">
                    <div class="col-2">
                        <img src="{{ $image }}" alt="{{ $product->name }}" class="img-fluid">
                    </div>
                    <div class="col-10">
                        <a href="{{url('producto').'/'.$product->id}}"  style="text-decoration:none !important" >
                            <h5>{{ $product->name }}</h5>
                        
                        <p><strong>Cantidad:</strong> {{ $item['cantidad'] }}</p>
                        <p><strong>Precio Unitario:</strong> ${{ number_format($product->price, 2) }} MXP</p>
                        <p><strong>Total:</strong> ${{ number_format($totalItem, 2) }} MXP</p></a>
                        
                        <div class="total float-rigth">
                         <div class="btn btn-danger" style="text-decoration:none" onclick="deleteCart({{ $id }})"><a style="text-decoration:none;color:#fff" href="#"><i class="fa fa-trash"></i> Eliminar</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
            <br><br>
            


            <div class="total-carrito mt-4 p-4 border rounded bg-light">
    <h4 style="color:#000 !important" class="fw-bold">Subtotal: <span style="color:#000 !important" class="text-primary">${{ number_format($totalCarrito / 1.16, 2) }} MXP</span></h4>
    <h4 style="color:#000 !important" class="fw-bold">IVA (16%): <span style="color:#000 !important" class="text-danger">${{ number_format($totalCarrito - ($totalCarrito / 1.16), 2) }} MXP</span></h4>
    <h2 class="fw-bold text-success" style="color:#26cd0c !important">Total del Carrito: ${{ number_format($totalCarrito, 2) }} MXP</h2>

    <hr>

    <!-- Método de Pago -->
    <div class="metodo-pago mt-3">
        <h4 class="fw-bold"><i class="fas fa-university"></i> Método de Pago: Transferencia Bancaria / SPEI</h4>
        
        <div class="p-3 border rounded bg-white">
            <p class="mb-1"><strong>Banco:</strong> Banco Nacional Digital</p>
            <p class="mb-1"><strong>Cuenta CLABE:</strong> 0123 4567 8910 1112 1314</p>
            <p class="mb-1"><strong>Número de Cuenta:</strong> 5678 9012 3456</p>
            <p class="mb-1"><strong>Nombre del Beneficiario:</strong> Tienda Online S.A. de C.V.</p>
            <p class="mb-1"><strong>Referencia:</strong> Tu Número de Pedido</p>
        </div>

      
    </div>
</div>



        </div>

        <div class="text-right">
            <br>
           
            <div class="total pagar">
                <div class="main-border-button"><a class="btn btn-dark" style="width:100%;color:#fff"  href="#"><center>
                <i class="fa-solid fa-file-invoice"></i>  Pagar Ahora</center></a></div>
            </div>
        </div>

        @else
        

        <div class="alert alert-warning">No hay productos en el carrito.</div>

        @endif
    </div>

<br><br><br>
@endsection

@section('js')

@endsection
