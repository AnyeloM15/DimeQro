

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            @if(isset($type) && isset($id))
                <h2  class="section-title">Explora Nuestros Productos {{$complemento}}</h2>
                <span>Explora nuestras categorías destacadas, donde encontrarás productos de calidad y las mejore ofertas.</span>
            
            @else
            @if(isset($product->name))
               
               <h4 class="section-title">Tambien podrian interesarte mas productos de la marca {{$product->brand->name}} </h4><br><br>
            @else
               <h2 class="section-title">Nuestros Productos </h2><br><br>
            @endif
            
            @endif
            </div>
        </div>
        <div id="product-container"></div>
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <br>
                <button id="load-more" class="btn btn-dark btn-lg" data-offset="0">Ver más</button>
            </div>
        </div>
    </div>
    <br><br><br>



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

            let ajaxData = {
                offset: offset // Siempre se enviará el offset
            };

            // Solo agregar si existen
            @if(isset($type) && isset($id) and !isset($product->name))
                ajaxData["{{ $type }}"] = "{{ $id }}";
            @elseif(isset($product->name))
                 ajaxData["clave"] = "{{  $product->brand->name }}";
            @endif


            $.ajax({
                url: "{{ url('load-products') }}", // Ruta para cargar los productos
                type: 'GET',
                data: ajaxData,
                success: function (response) {
                    let productContainer = $('#product-container');

                    // Verificar si ya existe un .row dentro del contenedor de productos
                    if (productContainer.find('.row').length === 0) {
                        productContainer.append('<div class="row"></div>');
                    }

                    // Añadir los nuevos productos dentro del .row existente
                    productContainer.find('.row').append(response.html);

                    // Actualizar el offset
                    $('#load-more').data('offset', offset + 8);

                    // Si no hay más productos, ocultar el botón
                    if (response.html.trim() === '') {
                        $('#load-more').hide();
                    }
                },
                error: function () {
                    //alert('Error al cargar los productos.');
                }
            });
        }
    });

    </script>
    @endsection