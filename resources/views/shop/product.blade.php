@extends('master')
@section('title',env('APP_NAME'))
@section('body')
<!-- ***** Main Banner Area Start ***** -->
<br><br><br>
<!-- ***** Product Area Starts ***** -->
<section class="section" id="product">
   <div class="container">
      <div class="row">
         <div class="col-md-8 d-flex">
            <!-- Miniaturas verticales a la izquierda -->
            @if($product->images && $product->images->count() > 1)
            <div class="thumbnails-container me-3">
               @foreach($product->images as $key => $image)
               <img src="{{ asset($image->image) }}" 
                  class="img-thumbnail thumbnail-img" 
                  data-bs-target="#productGallery" data-bs-slide-to="{{ $key }}" 
                  alt="Miniatura {{ $key }}">
               @endforeach
            </div>
            @endif
            <!-- Galería principal con carrusel -->
            <div id="productGallery" class="carousel slide w-100" data-bs-ride="carousel">
               <!-- Contenedor de imágenes principales -->
               <div class="carousel-inner">
                  @if($product->images && $product->images->count() > 0)
                  @foreach($product->images as $key => $image)
                  <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                     <div class="image-container">
                        <img src="{{ asset($image->image) }}" class="product-image" alt="{{ $product->name }}">
                     </div>
                  </div>
                  @endforeach
                  @else
                  <div class="carousel-item active">
                     <div class="image-container">
                        <p class="text-center text-black">No hay imágenes disponibles para este producto.</p>
                     </div>
                  </div>
                  @endif
               </div>
               <!-- Controles de navegación -->
               <button class="carousel-control-prev" type="button" data-bs-target="#productGallery" data-bs-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               </button>
               <button class="carousel-control-next" type="button" data-bs-target="#productGallery" data-bs-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               </button>
            </div>
         </div>
      
         <div class="col-md-4">
            <div class="right-content">
               <h4>{{ $product->name }}</h4>
               <span class="price" style="font-size:30px;color:#000"><strong>${{ number_format($product->price, 2) }}</strong></span><br>
               <span>{{ $product->description }}</span>
               <div class="quote">
                  <p>{{ $product->quote }}</p>
               </div>
               @if($product->stock>0)
               <div class="col-md-12">
                  <table class="table table-borderless" width="100%" style="width:100%;border:1px">
                     <tr>
                        <td class="text-start">
                           <h6 style="font-size:20px;color:#000"><i class="fa fa-quote-left"></i> No. de órdenes</h6>
                        </td>
                        <td class="text-end">
                           <small>Disponibles </small> <small id="disponibles">{{$product->stock }}</small><br>
                           <div class="input-group">
                              <input type="button" value="-" class="btn btn-dark minus"/>
                              <input type="number" readonly step="1" min="1" max="{{ $product->stock }}" 
                                 name="quantity" 
                                 id="quantity" 
                                 value="{{ session()->has('carrito') && isset(session('carrito')[$product->id]) ? session('carrito')[$product->id]['cantidad'] : 1 }}" 
                                 title="Qty" 
                                 class="form-control" size="4"/>
                              <input type="button" value="+" class="btn btn-dark  plus"/>
                           </div>
                           <a href="JavaScript:deleteCart({{ $product->id }})" style="color:#e3032b;text-decoration:none;" class="{{ session()->has('carrito') && isset(session('carrito')[$product->id]) ? '' : 'd-none' }} delete-cart" id="delete-cart-{{ $product->id }}">
                           <small><i class="fa fa-trash"></i> Eliminar Productos</small>
                           </a>
                        </td>
                     </tr>
                     <tr>
                        <td class="text-start">
                           <h4><span id="totalPrice">Total ${{ number_format($product->price, 2) }}</span> MXP</h4> 
                        </td>
                        <td class="text-end">
                           <div class="main-border-button" onclick="addCart()">
                              <a href="#" class="btcart btn btn-dark">
                              @if(session()->has('carrito') && isset(session('carrito')[$product->id]))
                              <i class="fa fa-shopping-cart"></i> Actualizar
                              @else
                              <i class="fa fa-shopping-cart"></i> Agregar 
                              @endif
                              </a>
                           </div>
                        </td>
                     </tr>
                  </table>
                  <div>
                     <br>
                  </div>
               </div>
               <div class="total">
                  <br>
                  <a href="#" class="btn btn-dark" style="width:100% ;color:#fff"  onclick="addCart('1')">
                     <center><i class="fa-solid fa-money-bill-transfer"></i> Pagar</center>
                  </a>
               </div>
               @else
               <br><br><br>
               <div class="alert alert-warning">Producto no disponible por el momento</div>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
<br><br><br>



@include('recursos-landing.productos')

@endsection


@section('js')
<script>
   
   var price={{$product->price}};
   var stock={{$product->stock}};
   var id={{$product->id}};
   $("#totalPrice").html('Total $' + Number($("#quantity").val() * price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   document.addEventListener('DOMContentLoaded', function () {
       const minusButton = document.querySelector('.minus');
       const plusButton = document.querySelector('.plus');
       const qtyInput = document.querySelector('input[name="quantity"]');
       
       
   
       // Función para disminuir la cantidad
       minusButton.addEventListener('click', function () {
           let currentValue = parseInt(qtyInput.value);
           if (currentValue > 1) {
               qtyInput.value = currentValue - 1;
           }
           //$("#disponibles").html(stock-$("#quantity").val());
           $("#totalPrice").html('Total $' + Number($("#quantity").val() * price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
       });
   
       // Función para aumentar la cantidad
       plusButton.addEventListener('click', function () {
           let currentValue = parseInt(qtyInput.value);
           let maxValue = parseInt(qtyInput.max);
   
           if (currentValue < maxValue) {
               qtyInput.value = currentValue + 1;
           }
           //$("#disponibles").html(stock-$("#quantity").val());
           $("#totalPrice").html('Total $' + Number($("#quantity").val() * price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   
       });
   });
   
   function addCart(pago=null){
       cart(id,$("#quantity").val(),pago);
   }
   
</script>
@endsection