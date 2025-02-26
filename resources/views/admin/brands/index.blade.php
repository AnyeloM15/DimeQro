@extends('masterpage.admin')

@section('title', 'Gestión de Marcas')

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
                        <h5 class="card-title fw-semibold">Gestión de Marcas</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewBrand">Crear Nueva Marca</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="brandsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Estatus</th>
                                <th>Logo</th>
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

<!-- Modal for Add/Edit Brand -->
<div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="brandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brandModalLabel">Crear Nueva Marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="brandForm" name="brandForm" enctype="multipart/form-data">
                    <input type="hidden" name="brand_id" id="brand_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de la Marca</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">Estatus</label>
                        <select class="form-control" id="active" name="active">
                            <option value="">Seleccione un estatus</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <input type="file" class="form-control" id="logo" name="logo">
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
<script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    var table = $('#brandsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('brands.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'active', name: 'active'},
            {data: 'logo', name: 'logo', render: function (data) {
                return data ? `<img src="public/${data}" height="50" alt="Logo">` : 'No Logo';
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewBrand').click(function () {
        $('#brandForm').trigger("reset");
        $('#brandModal').modal('show');
        $('#brandModalLabel').text("Crear Nueva Marca");
        $('#brand_id').val('');
    });

    $('#brandForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('brands.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#brandForm').trigger("reset");
                $('#brandModal').modal('hide');
                table.ajax.reload();
                $.notify({message: data.success}, {type: 'success'});
            },
            error: function (data) {
                $.notify({message: 'Error al guardar la marca.'}, {type: 'danger'});
            }
        });
    });

    $('body').on('click', '.edit', function () {
        var brand_id = $(this).data('id');
        $.get("{{ url('brands') }}/" + brand_id + "/edit", function (data) {
            $('#brandModalLabel').text("Editar Marca");
            $('#brandForm').attr('action', "{{ route('brands.store') }}");
            $('#brand_id').val(data.id);
            $('#name').val(data.name);
            $('#active').val(data.active);
            $('#brandModal').modal('show');
        })
    });

    $('body').on('click', '.delete', function () {
        var brand_id = $(this).data("id");
        if (confirm("¿Estás seguro de que quieres eliminar esta marca?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('brands') }}/" + brand_id,
                success: function (data) {
                    table.ajax.reload(null, false);
                    $.notify({message: 'Marca eliminada exitosamente.'}, {type: 'success'});
                },
                error: function (data) {
                    $.notify({message: 'Error al eliminar la marca.'}, {type: 'danger'});
                }
            });
        }
    });
});
</script>
@endsection
