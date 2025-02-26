@extends('masterpage.admin')

@section('title', 'Gestión de Productos')

@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Gestión de Productos</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewProduct">Crear Nuevo Producto</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Subcategoría</th>
                                <th>Marca</th>
                                <th>Código del Producto</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Foto Portada</th>
                                <th>Fotos Adicionales</th>
                                <th>Activo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit Product -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Crear/Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="mb-3">
                        <label for="subcategory_id" class="form-label">Subcategoría</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Marca</label>
                        <select id="brand_id" name="brand_id" class="form-select">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="product_code" class="form-label">Código del Producto</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Foto Portada</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="images" class="form-label">Fotos Adicionales</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">Activo</label>
                        <select id="active" name="active" class="form-select">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {


    function format(d) {
            return d.additional_photos;
        }



    var table = $('#productsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category', name: 'category'},
            {data: 'subcategory.name', name: 'subcategory.name'},
            {data: 'brand.name', name: 'brand.name'},
            {data: 'product_code', name: 'product_code'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'price', name: 'price'},
            {data: 'stock', name: 'stock'},
            {data: 'cover', name: 'cover'},
           // {data: 'additional_photos', name: 'additional_photos'},
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },

            {data: 'active', name: 'active', render: function(data) {
                // Uso de clases de Bootstrap para estilos de etiquetas
                var label = data ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                return label;
            }},


            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

     // Controlador de detalles de fila
    $('#productsTable').on('click', 'td.dt-control', function () {
        
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // Si los detalles están mostrando, esconderlos
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Mostrar los detalles
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });

    $('#createNewProduct').click(function () {
        $('#productForm').trigger("reset");
        $('#productModal').modal('show');
        $('#productModalLabel').text("Crear Nuevo Producto");
        $('#product_id').val('');
    });

    $('#productForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('products.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#productForm').trigger("reset");
                $('#productModal').modal('hide');
                table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.edit', function () {
        var product_id = $(this).data('id');
        $.get("{{ url('products') }}/" + product_id + "/edit", function (data) {
            $('#productModalLabel').text("Editar Producto");
            $('#product_id').val(data.id);
            $('#subcategory_id').val(data.subcategory_id);
            $('#brand_id').val(data.brand_id);
            $('#product_code').val(data.product_code);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#price').val(data.price);
            $('#stock').val(data.stock);
            $('#active').val(data.active);
            $('#productModal').modal('show');
        })
    });

    $('body').on('click', '.delete', function () {
        var product_id = $(this).data("id");
        if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('products') }}/" + product_id,
                success: function (data) {
                    table.ajax.reload(null, false);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    $('body').on('click', '.deleteImage', function () {
        var photoId=$(this).data('id');
        
        if (confirm('¿Estás seguro de que quieres eliminar esta imagen de portada?')) {
            $.ajax({
                url: '{{ url("delete-image") }}/' + photoId,  // Asegúrate de que esta URL y método HTTP coinciden con tu configuración de rutas en Laravel
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(result) {
                    $('.deleteImage'+photoId).hide();
                },
                error: function(err) {
                    alert('Error al eliminar la imagen de portada.');
                    console.error('Error:', err);
                }
            });
        }
    });

    
});

</script>
@endsection
