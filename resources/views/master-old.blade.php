<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" type="text/css" href="{{url('/').'/'}}landing/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{url('/').'/'}}landing/css/font-awesome.css">
        <link rel="stylesheet" href="{{url('/').'/'}}landing/css/templatemo-hexashop.css">
        <style>

            .btn-flotante {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #000;
                color: white;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
                z-index:9000
                }

                .btn-flotante2 {
                position: fixed;
                bottom: 90px;
                right: 20px;
                background-color: #000;
                color: white;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                display: flex;
                justify-content: center;
                align-items: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
                z-index:9000
                }

                .btn-flotante:hover {
                background-color: #cccccc;
                }

                .btn-flotante2:hover {
                background-color: #cccccc;
                }

                .btn-flotante i {
                font-size: 24px;
                }

                .btn-flotante2 i {
                font-size: 24px;
                }
        </style>
    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    <button class="btn-flotante" onclick="buscar()">
    <i class="fas fa-search"></i>
  </button>

  
  <button class="btn-flotante2" onclick="window.location.href='{{ url('/cart') }}'">

                                        <span  style="
                                            position: absolute;
                                            top: -5px;
                                            right: -5px;
                                            color: #000;
                                            border-radius: 50%;
                                            font-size: 12px;
                                            font-weight: bold;
                                        " class="mycart">
                                              {{ session()->has('carrito') && count(session('carrito')) > 0 ? count(session('carrito')) : '' }}
                                        </span>
                                   
    <i class="fas fa-shopping-cart"></i>
  </button>


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="{{url('/')}}" class="logo">
                            <img style="width:100px" src="{{url('/').'/'}}{{ DB::table('site_settings')->first()->logo }}">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ url('/') }}" class="active">Inicio</a></li>

                            <!-- Submenú de Categorías dinámicas -->
                            <li class="submenu">
                                <a href="javascript:;">Categorías</a>
                                <ul>
                                    @foreach(DB::table('categories')->where('active',1)->limit(10)->get() as $category)
                                        <li><a href="{{url('categoria').'/'.$category->id}}">{{ $category->name }}</a></li>
                                    @endforeach
                                    <li><a href="{{ url('/categorias') }}">Ver más</a></li>
                                </ul>
                            </li>

                                                        <!-- Submenú de Marcas dinámicas -->
                            <li class="submenu">
                                <a href="javascript:;">Marcas</a>
                                <ul>
                                    @foreach(DB::table('brands')->where('active',1)->limit(20)->get() as $brand)
                                        <li><a href="{{url('marca').'/'.$category->id}}">{{ $brand->name }}</a></li>
                                    @endforeach
                                    <li><a href="{{ url('/marcas') }}">Ver más</a></li>
                                </ul>
                            </li>


                            <!-- Enlace a la página de Nosotros -->
                            <li class="scroll-to-section"><a href="{{ url('/nosotros') }}">Nosotros</a></li>

                            <!-- Enlace a la página de Contacto -->
                            <li class="scroll-to-section"><a href="{{ url('/contacto') }}">Contacto</a></li>

                            <li class="scroll-to-section"><a href="JavaScript:buscar()"><i class="fas fa-search"></i> Buscar</a></li>

                           
                            <li class="scroll-to-section" style="position: relative;">
                                <a href="{{ url('/cart') }}">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="mycart d-none d-md-block" style="
                                        position: absolute;
                                        top: -0px;
                                        right: -0px;
                                        color: black;
                                        border-radius: 50%;
                                        padding: 3px 3px;
                                        font-size: 10px;
                                        font-weight: bold;
                                        line-height: 1;
                                        display: none; 
                                    ">
                                         {{ session()->has('carrito') && count(session('carrito')) > 0 ? count(session('carrito')) : '' }}
                                    </span>
                                </a>
                            </li>




    

                            <li>
                                @if (Auth::check())
                                    <!-- Si el usuario está autenticado -->
                                    <li><a href="{{ url('/dashboard') }}">Mi Cuenta</a></li>
                                @else
                                    <!-- Si el usuario no está autenticado -->
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @endif
                            </li>
                        </ul>
      
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>

    
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="background-color:transparent">
        <div class="modal-content" style="background-color:transparent; border:0px;">
        <div class="modal-body">
            <div class="d-flex justify-content-between">
            <h5 class="modal-title" style="color:#fff">Buscar productos</h5>
            <button type="button" onclick="JavaScript:cerrarbuscar()" style="color:#fff; background-color:transparent; border:0px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form action="{{url('buscar')}}">
                <input type="text" name="producto" class="form-control mt-3" placeholder="Buscar...">
            </form>
        </div>
        </div>
    </div>
    </div>


  


    <!-- ***** Header Area End ***** -->
    @yield('body')
    

  
   <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="first-item">
                        <div class="logo">
                            <img src="{{url('/').'/'}}{{ DB::table('site_settings')->first()->logo }}" alt="hexashop ecommerce templatemo">
                        </div>
                        <ul>
                            <li><a href="#">Dir: {{ DB::table('site_settings')->first()->address }}</a></li>
                            <li><a href="#">Tel: {{ DB::table('site_settings')->first()->phone }}</a></li>
                            <li><a href="mailto:{{ DB::table('site_settings')->first()->email }}">Email: {{ DB::table('site_settings')->first()->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <h4>Compras y Categorías</h4>
                    <ul>
                        @foreach(DB::table('categories')->where('active',1)->get() as $index => $category)
                            @if($index < 6)
                                <li><a href="{{url('categoria').'/'.$category->id}}">{{ $category->name }}</a></li>
                            @else
                                <li class="collapse more-categories"><a href="{{url('categoria').'/'.$category->id}}">{{ $category->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    @if(DB::table('categories')->count() > 6)
                        <a href="#" class="btn-link" data-toggle="collapse" data-target=".more-categories" aria-expanded="false" aria-controls="more-categories">Ver más</a>
                    @endif
                </div>
                <div class="col-lg-3">
                    <h4>Enlaces Útiles</h4>
                    <ul>
                        <li><a href="{{ url('/') }}">Inicio</a></li>
                        <li><a href="{{ url('/nosotros') }}">Acerca de Nosotros</a></li>
                        <li>
                            <a href="https://wa.me/{{ DB::table('site_settings')->first()->whatsapp }}?text=Hola, estoy interesado en recibir asistencia sobre mis compras en {{ env('APP_NAME') }}. ¿Podrían ayudarme?" target="_blank">
                                <i class="fa fa-whatsapp"></i> Ayuda
                            </a>
                        </li>
                        <li><a href="{{ url('/contacto') }}">Contacto</a></li>
                        <li><a href="{{ url('/preguntas-frecuentes') }}">Preguntas Frecuentes</a></li> <!-- Enlace a la sección de FAQs -->
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h4>Ayuda &amp; Informaci&oacute;n</h4>
                    <ul>
                        <li><a href="{{ url('/terminos-y-condiciones') }}">Términos y Condiciones</a></li>
                        <li><a href="{{ url('/devoluciones-y-reembolsos') }}">Política de Devoluciones</a></li>
                        <li><a href="{{ url('/politica-de-envios') }}">Política de Envíos</a></li>
                        <li><a href="{{ url('/politica-de-cookies') }}">Política de Cookies</a></li>
                        <li><a href="{{ url('/politica-de-garantia') }}">Política de Garantía</a></li>
                        <li><a href="{{ url('/metodos-de-pago') }}">Métodos de Pago</a></li>
                        <li><a href="{{ url('/politica-de-seguridad') }}">Política de Seguridad</a></li>
                        <li><a href="{{ url('/promociones-y-descuentos') }}">Promociones y Descuentos</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="under-footer">
                        <p>Copyright © 2022 Dimeqro. Todos los derechos reservados.
                            <br>Diseño: MKT
                            <br>Distribuido por: MKT
                        </p>
                        <ul>
                            <li><a href="{{ DB::table('site_settings')->first()->facebook }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ DB::table('site_settings')->first()->twitter }}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ DB::table('site_settings')->first()->instagram }}"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="{{ DB::table('site_settings')->first()->whatsapp }}"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{url('/').'/'}}landing/js/popper.js"></script>
    <script src="{{url('/').'/'}}landing/js/bootstrap.min.js"></script>
    <!-- Plugins -->
    <script src="{{url('/').'/'}}landing/js/imgfix.min.js"></script> 
    <script src="{{url('/').'/'}}landing/js/lightbox.js"></script> 
    <!-- Global Init -->
    <script src="{{url('/').'/'}}landing/js/custom.js?v=122"></script>


    <script>
        

        function buscar(){
            $("#searchModal").modal('show');
        }
        function cerrarbuscar(){
            $("#searchModal").modal('hide');
        }


        function cart(id,total,pago=null){
           
            
            $.ajax({
                url: '{{url("/agregar-al-carrito")}}', // Ruta hacia el controlador que manejará la solicitud
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // El token CSRF para la seguridad
                    id: id,
                    total: total
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $.notify("Producto agregado al carrito!", "success");
                        $(".delete-cart").removeClass("d-none");
                        $(".btcart").html('<i class="fa fa-shopping-cart"></i>  Actualizar');
                        // Actualiza el carrito en la interfaz, si es necesario
                        if(pago==1){
                            window.location.href = "{{ url('/cart') }}"; // Redirige a la URL del carrito
                        }
                    } else if (response.status === 'error') {
                        $.notify('Error: ' + response.message, "danger");
                    }
                    $(".mycart").html(response.total);
                },
                error: function(xhr, status, error) {
                    $.notify('Hubo un error al agregar el producto al carrito.', "danger");
                }
            });

        }


        function deleteCart(productId) {
          
          $.ajax({
              url: '{{url("/carrito/eliminar/")}}'+'/' + productId,
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  if (response.status === 'success') {
                      // Eliminar el div correspondiente al producto
                      $('#product-' + productId).remove();

                      // Actualizar el total del carrito
                      $('#total-carrito').html('<h3><strong>Total del Carrito:</strong> $' + response.costo + '</h3>');

                      // Si no quedan productos en el carrito, mostrar un mensaje
                      if ($('.carrito-item').length === 0) {
                          $('#carrito-body').html('<div class="alert alert-warning">No hay productos en el carrito.</div>');
                          $(".pagar").hide();
                      }
                      
                      $(".mycart").html(response.total);
                      $.notify('Producto eliminado', "success");
                      $(".delete-cart").addClass("d-none");
                      $(".qtycart").val(1);
                      

                      $(".btcart").html('<i class="fa fa-shopping-cart"></i>  Agregar al carrito');


                  } else {
                      alert('Error al eliminar el producto');
                      $.notify('Error al eliminar el producto.', "danger");
                  }
              },
              error: function(xhr) {
                  alert('Hubo un error en la solicitud');
                  $.notify('Hubo un error en la solicitud', "danger");
              }
          });
      }

    </script>

    
    @yield('js')

  </body>
</html>