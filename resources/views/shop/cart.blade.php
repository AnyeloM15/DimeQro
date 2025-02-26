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
               <p><strong>Total:</strong> ${{ number_format($totalItem, 2) }} MXP</p>
            </a>
            <div class="total float-rigth">
               <div class="btn btn-danger" style="text-decoration:none" onclick="deleteCart({{ $id }},1)"><a style="text-decoration:none;color:#fff" href="#"><i class="fa fa-trash"></i> Eliminar</a></div>
            </div>
         </div>
      </div>
      @endforeach
      <br><br>
      

<!-- Método de Envío -->
<div class="metodo-envio mt-4 p-4 border rounded bg-light">
    <h4 class="fw-bold"><i class="fas fa-truck"></i> Método de Envío</h4>
    <form id="shippingForm">
        @csrf
        <div class="mb-3">
            <label for="shipping_method" class="form-label">Selecciona una opción:</label>
            <select class="form-control" id="shipping_method" name="shipping_method" required>
                <option value="tienda">Recoger en tienda (Gratis)</option>
                <option value="domicilio">Envío a domicilio (Con cargo adicional)</option>
                
            </select>
        </div>

        <!-- Dirección de la Tienda (Visible cuando elige "Recoger en tienda") -->
        <div id="store_info" class="p-3 border rounded bg-white">
            <h5>📍 Dirección para recolectar:</h5>
            <p><strong>Dirección:</strong> {{ DB::table('site_settings')->first()->address }}</p>
            <p><strong>Teléfono:</strong> {{ DB::table('site_settings')->first()->phone }}</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.973227750246!2d-100.38232442494503!3d20.548276280983544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d344f6cc25511f%3A0xc14de1261dbc48c9!2sBlvrd%20de%20los%20Gobernadores%201981%2C%20Villas%20del%20Cimatario%2C%20San%20Andres%2C%2076085%20Santiago%20de%20Quer%C3%A9taro%2C%20Qro.!5e0!3m2!1ses!2smx!4v1740069458672!5m2!1ses!2smx" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              
        </div>

        <!-- Dirección del Usuario (Visible cuando elige "Envío a domicilio") -->
        <div id="shipping_address_section" class="p-3 border rounded bg-white">
            <h5>🏠 Dirección de Envío (Con cargo adicional):</h5>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address" 
                   value="{{ auth()->user()->shipping_address ?? '' }}" placeholder="Ingrese su dirección">
        </div>
    </form>
</div>

<div class="total-carrito mt-4 p-4 border rounded bg-light">
    <h4 style="color:#000 !important" class="fw-bold">
        Subtotal: 
        <span style="color:#000 !important" class="text-primary">
            ${{ number_format($totalCarrito / 1.16, 2) }} MXP
        </span>
    </h4>
    <h4 style="color:#000 !important" class="fw-bold">
        IVA (16%): 
        <span style="color:#000 !important" class="text-danger">
            ${{ number_format($totalCarrito - ($totalCarrito / 1.16), 2) }} MXP
        </span>
    </h4>
    <h2 class="fw-bold text-success" style="color:#26cd0c !important">
        Total del Carrito: ${{ number_format($totalCarrito, 2) }} MXP
    </h2>
    
    <!-- Mensaje de Costo de Envío (Solo visible cuando se elige Envío a Domicilio) -->
    <div id="shipping_cost_message" class="mt-3 p-2 border rounded bg-warning text-dark fw-bold" style="display: none;">
        🚚 Costo de Envío: <br>
        <small>Se le contactará para establecer el cargo adicional.</small>
    </div>

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

<div class="text-right">
    <br>
    <div class="total pagar">
        <div class="main-border-button">
            <a class="btn btn-dark" style="width:100%;color:#fff" id="payNowButton">
                <center>
                    <i class="fa-solid fa-file-invoice"></i>  Pagar Ahora
                </center>
            </a>
        </div>
    </div>
</div>


 
   @else
   <div class="alert alert-warning">No hay productos en el carrito.</div>
   @endif
</div>
<br><br><br>
@endsection
@section('js')





<script>
document.addEventListener("DOMContentLoaded", function () {
    let shippingMethod = document.getElementById("shipping_method");
    let storeInfo = document.getElementById("store_info");
    let shippingAddressSection = document.getElementById("shipping_address_section");
    let shippingCostMessage = document.getElementById("shipping_cost_message");
    let payNowButton = document.getElementById("payNowButton");

    function toggleShippingMethod() {
        if (shippingMethod.value === "tienda") {
            storeInfo.style.display = "block"; 
            shippingAddressSection.style.display = "none"; 
            shippingCostMessage.style.display = "none"; 
        } else {
            storeInfo.style.display = "none"; 
            shippingAddressSection.style.display = "block"; 
            shippingCostMessage.style.display = "block"; 
        }
    }

    // Detectar cambios en el método de envío
    shippingMethod.addEventListener("change", toggleShippingMethod);
    toggleShippingMethod();

    // Al hacer clic en "Pagar Ahora", enviar los datos al servidor
    payNowButton.addEventListener("click", function (event) {
        event.preventDefault();

        let shippingData = {
            shipping_method: shippingMethod.value,
            shipping_address: shippingMethod.value === "domicilio" ? document.getElementById("shipping_address").value : null
        };

        fetch("{{ route('checkout.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(shippingData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Pedido realizado correctamente. Redirigiendo...");
                window.location.href = "{{url('/order-confirmation')}}/" + data.order_id;
            } else {
                alert("Error: " + data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
</script>




@endsection