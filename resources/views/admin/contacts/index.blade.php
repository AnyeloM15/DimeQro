@extends('masterpage.admin')

@section('title', 'Gestión de Mensajes')

@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Gestión de Mensajes</h5><br>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="contactsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Mensaje</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal para actualizar el estado -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="contactForm">
                    <input type="hidden" name="contact_id" id="contact_id">
                    <div class="mb-3">
                        <label for="status">Estatus</label>
                        <select class="form-control" name="status" id="status">
                            <option value="pendiente">Pendiente</option>
                            <option value="atendido">Atendido</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
    var table = $('#contactsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('contacts.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'contact', name: 'contact'},
            {data: 'message', name: 'message'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // Abrir modal de edición solo para cambiar el estado
    $('body').on('click', '.edit', function () {
        var contact_id = $(this).data('id');
        $.get("{{ url('contacts') }}/" + contact_id + "/edit", function (data) {
            $('#contact_id').val(data.id);
            $('#status').val(data.status);
            $('#contactModal').modal('show');
        });
    });

    // Enviar solo el nuevo estado del mensaje
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        var contact_id = $('#contact_id').val();
        var status = $('#status').val();

        $.ajax({
            type: 'PATCH',
            url: "{{ url('contacts') }}/" + contact_id + "/status",
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function (data) {
                $('#contactModal').modal('hide');
                table.ajax.reload();
                alert(data.success);
            },
            error: function (xhr) {
                alert("Error: " + xhr.responseJSON.message);
            }
        });
    });

    // Eliminar un mensaje
    $('body').on('click', '.delete', function () {
        var contact_id = $(this).data("id");
        if (confirm("¿Eliminar este mensaje?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('contacts') }}/" + contact_id,
                success: function (data) {
                    table.ajax.reload();
                    alert('Mensaje eliminado correctamente.');
                },
                error: function (data) {
                    alert('Error al eliminar el mensaje.');
                }
            });
        }
    });
});
</script>

@endsection
