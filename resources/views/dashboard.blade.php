@extends('masterpage.admin')

@section('title', 'Gestión de Pedidos')

@section('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title fw-semibold">Gestión de Pedidos</h5><br>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="ordersTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Detalle</th> 
                                <th>Cliente</th>
                                <th>Teléfono</th>
                                <th>Total</th>
                                <th>Dirección de Envío</th>
                                <th>Estado</th>
                                <th>Comentarios</th>
                                <th>Comprobante</th>
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

<!-- Modal para Editar Pedido -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="orderForm">
                    <input type="hidden" name="order_id" id="order_id">

                    <!-- Estado del Pedido -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-control" name="status" id="status">
                            <option value="pending">Pendiente</option>
                            <option value="processing">Procesando</option>
                            <option value="shipped">Enviado</option>
                            <option value="delivered">Entregado</option>
                            <option value="completed">Completado</option>
                            <option value="cancelled">Cancelado</option>
                        </select>
                    </div>

                    <!-- Comprobante de Pago -->
                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Comprobante de Pago</label>
                        <div id="comprobanteContainer"></div> <!-- Aquí se cargará el comprobante -->
                        <input type="file" name="comprobante" class="form-control mt-2" id="comprobanteInput">
                    </div>

                    <!-- Comentarios -->
                    <div class="mb-3">
                        <label for="comments" class="form-label">Comentarios</label>
                        <textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Añadir comentarios sobre el pedido..."></textarea>
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
    var table = $('#ordersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        order: [[0, "desc"]], // Ordena por la primera columna (ID) en orden descendente
        columns: [
            
            {data: 'id', name: 'id'},
            {
                className: 'details-control',
                orderable: false,
                data: null,
                defaultContent: '<button class="btn btn-sm btn-primary">📄 Ver detalle</button>',
            },
            {data: 'user.name', name: 'user.name'},
            { 
                data: 'user.phone', 
                name: 'user.phone', 
                render: function (data, type, row) {
                    if (row.user && row.user.country_code && row.user.phone) {
                        return `${row.user.country_code} ${row.user.phone}`;
                    }
                    return 'Número no disponible'; 
                }
            },
            {data: 'total', name: 'total'},
            {data: 'shipping_address', name: 'shipping_address'},
            {data: 'status', name: 'status', render: function(data) {
                let statusMap = {
                    'pending': {text: 'Pendiente', class: 'badge bg-warning'},
                    'processing': {text: 'Procesando', class: 'badge bg-primary'},
                    'shipped': {text: 'Enviado', class: 'badge bg-info'},
                    'delivered': {text: 'Entregado', class: 'badge bg-success'},
                    'completed': {text: 'Completado', class: 'badge bg-secondary'},
                    'cancelled': {text: 'Cancelado', class: 'badge bg-danger'}
                };
                let status = statusMap[data] || {text: 'Desconocido', class: 'badge bg-dark'};
                return `<span class="${status.class}">${status.text}</span>`;
            }},
            {data: 'comments', name: 'comments'},
            {data: 'comprobante', name: 'comprobante', orderable: false, searchable: false, render: function(data, type, row) {
                if (data) {
                    return `<a href="${data}" target="_blank" class="btn btn-info btn-sm">📄 Ver comprobante</a>`;
                } else {
                    return `
                        <form action="{{ url('orders') }}/${row.id}/upload-comprobante" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="comprobante" class="form-control form-control-sm">
                            <button type="submit" class="btn btn-success btn-sm mt-1">Subir</button>
                        </form>
                    `;
                }
            }},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Control para mostrar/ocultar productos
    $('#ordersTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            $.get("{{ url('orders') }}/" + row.data().id + "/products", function (data) {
                row.child(data).show();
                tr.addClass('shown');
            });
        }
    });

     // Cargar datos en el modal al hacer clic en "Editar"
    $('body').on('click', '.edit', function () {
        var order_id = $(this).data('id');

        $.ajax({
            url: "{{ url('orders') }}/" + order_id + "/edit",
            type: "GET",
            success: function (data) {
                $('#order_id').val(data.id);
                $('#status').val(data.status);
                $('#comments').val(data.comments || '');

                // Comprobante de pago (si existe)
                if (data.comprobante) {
                    $('#comprobanteContainer').html(
                        `<a href="{{ url('/') }}/${data.comprobante}" target="_blank" class="btn btn-info btn-sm">📄 Ver Comprobante</a>`
                    );
                } else {
                    $('#comprobanteContainer').html('<p class="text-muted">No se ha subido un comprobante.</p>');
                }

                $('#orderModal').modal('show'); // Mostrar modal
            },
            error: function () {
                alert("Error al cargar los datos del pedido.");
            }
        });
    });

    // Guardar cambios en el pedido
    $('#orderForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var order_id = $('#order_id').val();

        $.ajax({
            type: 'POST',
            url: "{{ url('orders') }}/" + order_id + "/update",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $('#orderModal').modal('hide');
                table.ajax.reload();
                alert("Pedido actualizado correctamente.");
            },
            error: function () {
                alert("Error al actualizar el pedido.");
            }
        });
    });

});
</script>
@endsection
