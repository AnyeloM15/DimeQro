@extends('masterpage.admin')

@section('title', 'Gestión de Usuarios')

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
                        <h5 class="card-title fw-semibold">Gestión de Usuarios</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewUser">Crear Nuevo Usuario</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="usersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
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

<!-- Modal para Crear/Editar Usuarios -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Crear/Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Código de País</label>
                        <select class="form-control" id="country_code" name="country_code">
                        <option value="+52">+52 - México</option>
                        <option value="+1">+1 - Estados Unidos / Canadá</option>
                        <option value="+54">+54 - Argentina</option>
                        <option value="+591">+591 - Bolivia</option>
                        <option value="+56">+56 - Chile</option>
                        <option value="+57">+57 - Colombia</option>
                        <option value="+506">+506 - Costa Rica</option>
                        <option value="+53">+53 - Cuba</option>
                        <option value="+593">+593 - Ecuador</option>
                        <option value="+503">+503 - El Salvador</option>
                        <option value="+34">+34 - España</option>
                        <option value="+502">+502 - Guatemala</option>
                        <option value="+504">+504 - Honduras</option>
                        <option value="+52">+52 - México</option>
                        <option value="+505">+505 - Nicaragua</option>
                        <option value="+507">+507 - Panamá</option>
                        <option value="+595">+595 - Paraguay</option>
                        <option value="+51">+51 - Perú</option>
                        <option value="+1-809">+1-809 / +1-829 / +1-849 - República Dominicana</option>
                        <option value="+598">+598 - Uruguay</option>
                        <option value="+58">+58 - Venezuela</option>
                        <option value="+44">+44 - Reino Unido</option>
                        <option value="+61">+61 - Australia</option>
                        <option value="+64">+64 - Nueva Zelanda</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-control" id="role" name="role">
                            <option value="cliente">Cliente</option>
                            {{--<option value="admin">Admin</option>--}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacío para no cambiar">
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

    // Inicializar DataTable
    var table = $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            { 
                data: 'phone', 
                name: 'phone', 
                render: function (data, type, row) {
                    if (row.country_code && data) {
                        return `${row.country_code} ${data}`;
                    }
                    return 'Número no disponible'; 
                }
            },
            {data: 'role', name: 'role', render: function (data) {
                return `<span class=" bg-${data === 'admin' ? 'success' : 'warning'}">${data}</span>`;
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Mostrar modal para crear nuevo usuario
    $('#createNewUser').click(function () {
        $('#userForm').trigger("reset");
        $('#userModalLabel').text("Crear Nuevo Usuario");
        $('#user_id').val('');
        $('#userModal').modal('show');
    });

    // Enviar datos para crear o editar usuario
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: "{{ route('users.store') }}",
            data: formData,
            success: function (data) {
                $('#userForm').trigger("reset");
                $('#userModal').modal('hide');
                table.ajax.reload();
                alert(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // Editar usuario
    $('body').on('click', '.edit', function () {
        var user_id = $(this).data('id');
        $.get("{{ url('users') }}/" + user_id + "/edit", function (data) {
            $('#userModalLabel').text("Editar Usuario");
            $('#user_id').val(data.id);
            $('#name').val(data.name);
            $('#email').val(data.email);
            $('#country_code').val(data.country_code);
            $('#phone').val(data.phone);
            $('#role').val(data.role);
            $('#userModal').modal('show');
        })
    });

    // Eliminar usuario
    $('body').on('click', '.delete', function () {
        var user_id = $(this).data("id");
        if (confirm("¿Eliminar este usuario?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('users') }}/" + user_id,
                success: function (data) {
                    table.ajax.reload();
                    alert('Usuario eliminado correctamente.');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});
</script>
@endsection
