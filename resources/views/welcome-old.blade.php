    @extends('master')
    @section('title',env('APP_NAME'))

    @section('body')
    <!-- ***** Main Banner Area Start ***** -->


    <div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <!-- Banner grande para la primera categoría -->
            @foreach($categories->take(1) as $category)
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                            <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                <span>{{ Str::limit($category->description, 20, '...') }}</span>
                                <div class="main-border-button">
                                    <a href="{{url('categoria').'/'.$category->id}}">Descubrir más</a>
                                </div>
                            </div>
                            <img src="{{ url($category->image) }}" alt="">
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Cuatro cuadros para las siguientes categorías (dos filas de dos columnas) -->
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        @foreach($categories->skip(1)->take(4) as $category)
                            <div class="col-lg-6">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                        <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                            <span>{{ Str::limit($category->description, 20, '...') }}</span>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                                <p>{{ Str::limit($category->description, 100, '...') }}</a>
                                                </p>
                                                <div class="main-border-button">
                                                <a href="{{url('categoria').'/'.$category->id}}">Descubrir más</a>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{ url($category->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Botón para ver más categorías -->
    <div class="container mt-5">
    <div class="row justify-content-center">
        <a class="btn btn-outline-dark rounded-0" data-toggle="collapse" href="#collapseCategorias" role="button"
            aria-expanded="false" aria-controls="collapseCategorias">
            Ver más
        </a>
    </div>
    </div>

    <!-- Categorías adicionales ocultas (Bootstrap Collapse) -->

    <div class="container collapse mt-4 " id="collapseCategorias">
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="right-content">


                <div class="row">
                    @foreach($categories->skip(5) as $category)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <!-- Aquí ajustamos a 4 columnas en pantallas grandes -->
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                        <span>{{ Str::limit($category->description, 20, '...') }}</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                        <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                            <p>{{ Str::limit($category->description, 100, '...') }}
                                            </p>
                                            <div class="main-border-button">
                                            <a href="{{url('categoria').'/'.$category->id}}">Descubrir más</a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{url('categoria').'/'.$category->id}}">
                                        <img src="{{ url($category->image) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>





    <section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="item ">
                <div class="section-heading">
                    <h2>Explora Nuestros Productos</h2>
                    <span>Explora nuestras categorías destacadas, donde encontrarás productos de calidad y las mejores
                        ofertas.</span>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="product-container"></div>
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <br>
                <button id="load-more" class="btn btn-outline-dark rounded-0" data-offset="0">Ver más</button>
            </div>
        </div>
    </div>
    </section>


<!-- ***** Explore Area Starts ***** -->
<section class="section" id="explore">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <h2>Explora Nuestros Productos</h2>
                    <span>Explora nuestra diversa gama de productos y disfruta de una experiencia de compra segura y cómoda. Ya sea que busques iluminación moderna, tecnología de punta o accesorios para el hogar, tenemos lo que necesitas.</span>
                    <div class="quote">
                        <i class="fa fa-quote-left"></i>
                        <p>Compra con confianza utilizando los métodos de pago que ofrecemos: Tarjetas de Crédito/Débito, Mercado Pago, PayPal, entre otros.</p>
                    </div>
                    <p>Contamos con más de {{ number_format(DB::table('products')->count()) }} productos, desde lámparas innovadoras hasta gadgets de última generación. Todos nuestros productos cumplen con los más altos estándares de calidad y eficiencia.</p>
                    <p>Si nuestra tienda ha sido útil para ti, te agradecemos que compartas nuestra plataforma con tus amigos y familiares. ¡Gracias por elegirnos!</p>
                
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="leather">
                                <h4>MSI</h4>
                                <span>Aceptamos todas las tarjetas</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="first-image">
                                <img src="landing/images/explore-image-01.jpg" alt="Lámparas Modernas">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="second-image">
                                <img src="landing/images/explore-image-02.jpg" alt="Focos de Alta Eficiencia">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="types">
                                <h4>Variedad de Productos</h4>
                                <span>Más de {{ number_format(DB::table('products')->count()) }} Productos Disponibles</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- ***** Explore Area Ends ***** -->
    {{--
    <!-- ***** Social Area Starts ***** -->
    <section class="section" id="social">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Social Media</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row images">
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Fashion</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-01.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>New</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-02.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Brand</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-03.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Makeup</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-04.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Leather</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-05.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Bag</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="landing/images/instagram-06.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- ***** Social Area Ends ***** -->
    
    <!-- ***** Subscribe Area Starts ***** -->
    <div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2>By Subscribing To Our Newsletter You Can Get 30% Off</h2>
                    <span>Details to details is what makes Hexashop different from the other themes.</span>
                </div>
                <form id="subscribe" action="" method="get">
                    <div class="row">
                        <div class="col-lg-5">
                            <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name" required="">
                            </fieldset>
                        </div>
                        <div class="col-lg-5">
                            <fieldset>
                                <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                    placeholder="Your Email Address" required="">
                            </fieldset>
                        </div>
                        <div class="col-lg-2">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-dark-button"><i
                                        class="fa fa-paper-plane"></i></button>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li>Store Location:<br><span>Sunny Isles Beach, FL 33160, United States</span></li>
                            <li>Phone:<br><span>010-020-0340</span></li>
                            <li>Office Location:<br><span>North Miami Beach</span></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li>Work Hours:<br><span>07:30 AM - 9:30 PM Daily</span></li>
                            <li>Email:<br><span>info@company.com</span></li>
                            <li>Social Media:<br><span><a href="#">Facebook</a>, <a href="#">Instagram</a>, <a
                                        href="#">Behance</a>, <a href="#">Linkedin</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ***** Subscribe Area Ends ***** -->

    --}}

    <div class="container">
    <div class="section-heading">
        <h2>Preguntas Frecuentes</h2><br>
    </div>
    <!-- Collapse de FAQs con Bootstrap 4.5 -->
    @include("info.acordeonfaq")
    </div>

    @endsection

    @section('js')
    <script>
    $(document).ready(function () {
        // Cargar los primeros productos cuando se cargue la página
        loadMoreProducts();

        // Al hacer clic en "Ver más"
        $('#load-more').on('click', function () {
            loadMoreProducts();
        });

        // Función para cargar más productos con AJAX
        function loadMoreProducts() {
            let offset = $('#load-more').data('offset');

            $.ajax({
                url: "{{ url('load-products') }}", // Ruta para cargar los productos
                type: 'GET',
                data: {
                    offset: offset // Enviamos el número de productos ya cargados
                },
                success: function (response) {
                    // Añadir los nuevos productos al contenedor
                    $('#product-container').append(response.html);

                    // Actualizar el offset
                    $('#load-more').data('offset', offset + 8);

                    // Si no hay más productos, ocultar el botón
                    if (response.html.trim() === '') {
                        $('#load-more').hide();
                    }
                },
                error: function () {
                    alert('Error al cargar los productos.');
                }
            });
        }
    });

    </script>
    @endsection
