
@extends('masterpage.admin')

@section('title', 'Gestión de Subcategorías')

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
                        <h5 class="card-title fw-semibold">Gestión de Subcategorías</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewSubcategory">Crear Nueva Subcategoría</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="subcategoriesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estatus</th>
                                <th>Foto</th>
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

<!-- Modal for Add/Edit Subcategory -->
<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModalLabel">Crear Nueva Subcategoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
        <div class="modal-body">
            <form id="subcategoryForm" name="subcategoryForm">
                <input type="hidden" name="subcategory_id" id="subcategory_id">
                <div class="mb-3">
                    <label for="category_id" class="form-label">Categoría</label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de la Subcategoría</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen de la Subcategoría</label>
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

@endsection
@section('js')

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
    var table = $('#subcategoriesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('subcategories.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'category', name: 'category.name'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'active', name: 'active'},
            {data: 'image', name: 'image'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewSubcategory').click(function () {
        $('#subcategoryForm').trigger("reset");
        $('#subcategoryModal').modal('show');
        $('#subcategoryModalLabel').text("Crear Nueva Subcategoría");
        $('#subcategory_id').val('');
    });

    $('#subcategoryForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('subcategories.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#subcategoryForm').trigger("reset");
                $('#subcategoryModal').modal('hide');
                table.ajax.reload();
                $.notify({message: 'Subcategoría guardada exitosamente.'}, {type: 'success'});
            },
            error: function (error) {
                console.log('Error:', error);
                $.notify({message: 'Error al guardar la subcategoría.'}, {type: 'danger'});
            }
        });
    });

    $('body').on('click', '.edit', function () {
        var subcategory_id = $(this).data('id');
        $.get("{{ url('subcategories') }}/" + subcategory_id + "/edit", function (data) {
            $('#subcategoryModalLabel').text("Editar Subcategoría");
            $('#categoryForm').attr('action', "{{ route('subcategories.update', '') }}/" + subcategory_id);
            $('#subcategory_id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#active').val(data.active);
            $('#category_id').val(data.category_id);
            $('#subcategoryModal').modal('show');
        })
    });

    $('body').on('click', '.delete', function () {
        var subcategory_id = $(this).data("id");
        if (confirm("¿Estás seguro de que quieres eliminar esta subcategoría?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('subcategories') }}/" + subcategory_id,
                success: function (data) {
                    table.ajax.reload(null, false);
                    $.notify({message: 'Subcategoría eliminada exitosamente.'}, {type: 'success'});
                },
                error: function (data) {
                    console.log('Error:', data);
                    $.notify({message: 'Error al eliminar la subcategoría.'}, {type: 'danger'});
                }
            });
        }
    });
});
</script>
@endsection