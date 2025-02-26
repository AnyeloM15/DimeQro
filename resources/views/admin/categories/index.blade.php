@extends('masterpage.admin')

@section('title', 'Gestión de Categorías')

@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.compat.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Gestión de Categorías</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewCategory">Crear Nueva Categoría</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="categoriesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estatus</th>
                                <th>Imagen</th>
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

<!-- Modal for Add/Edit Category -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Crear Nueva Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" name="categoryForm" enctype="multipart/form-data">
                    <input type="hidden" name="category_id" id="category_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen de la Categoría</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>

                    <div class="mb-3">
                        <label for="active" class="form-label">Estatus</label>
                        <select class="form-control" id="active" name="active">
                            <option value="">Seleccione un estatus</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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
<script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    var table = $('#categoriesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('categories.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'active', name: 'active'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewCategory').click(function () {
        $('#categoryForm').trigger("reset");
        $('#categoryModal').modal('show');
        $('#categoryModalLabel').text("Crear Nueva Categoría");
        $('#category_id').val('');
    });

    $('#categoryForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('categories.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#categoryForm').trigger("reset");
                $('#categoryModal').modal('hide');
                table.ajax.reload();
                $.notify({message: 'Categoría guardada exitosamente.'}, {type: 'success'});
            },
            error: function (error) {
                console.log('Error:', error);
                $.notify({message: 'Error al guardar la categoría.'}, {type: 'danger'});
            }
        });
    });

    $('body').on('click', '.edit', function () {
        var category_id = $(this).data('id');
        $.get("{{ url('categories') }}/" + category_id + "/edit", function (data) {
            $('#categoryModalLabel').text("Editar Categoría");
            $('#categoryForm').attr('action', "{{ route('categories.update', '') }}/" + category_id);
            $('#category_id').val(data.id);
            $('#active').val(data.active);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#categoryModal').modal('show');

        })
    });

    $('body').on('click', '.delete', function () {
        var category_id = $(this).data("id");
        if (confirm("¿Estás seguro de que quieres eliminar esta categoría?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('categories') }}/" + category_id,
                success: function (data) {
                    table.ajax.reload(null, false);
                    $.notify({message: 'Categoría eliminada exitosamente.'}, {type: 'success'});
                },
                error: function (data) {
                    console.log('Error:', data);
                    $.notify({message: 'Error al eliminar la categoría.'}, {type: 'danger'});
                }
            });
        }
    });
});
</script>
@endsection
