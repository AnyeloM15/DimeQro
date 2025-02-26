
@extends('masterpage.admin')

@section('title', 'Gestión de Preguntas Frecuentes')

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
                        <h5 class="card-title fw-semibold">Gestión de Preguntas Frecuentes</h5>
                    </div>
                    <div>
                        <button class="btn btn-success mb-2" id="createNewFAQ">Añadir Nueva Pregunta</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="faqsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pregunta</th>
                                <th>Respuesta</th>
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

<!-- Modal para Crear/Editar Preguntas Frecuentes -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="faqModalLabel">Crear/Editar Pregunta Frecuente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="faqForm" name="faqForm">
                    <input type="hidden" name="faq_id" id="faq_id">
                    <div class="mb-3">
                        <label for="question" class="form-label">Pregunta</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Respuesta</label>
                        <textarea class="form-control" id="answer" name="answer" required></textarea>
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
    var table = $('#faqsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('faqs.index') }}",  // RUTA para obtener las FAQs
        columns: [
            {data: 'id', name: 'id'},
            {data: 'question', name: 'question'},
            {data: 'answer', name: 'answer'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    // Mostrar modal para crear nueva pregunta
    $('#createNewFAQ').click(function () {
        $('#faqForm').trigger("reset");
        $('#faqModalLabel').text("Crear Nueva Pregunta");
        $('#faq_id').val('');
        $('#faqModal').modal('show');
    });

    // Enviar datos para crear o editar la pregunta frecuente
    $('#faqForm').on('submit', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "{{ route('faqs.store') }}",  // RUTA para crear/actualizar la pregunta
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#faqForm').trigger("reset");
                $('#faqModal').modal('hide');
                table.ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    // Editar una pregunta
    $('body').on('click', '.edit', function () {
        var faq_id = $(this).data('id');
        $.get("{{ url('faqs') }}/" + faq_id + "/edit", function (data) {
            $('#faqModalLabel').text("Editar Pregunta Frecuente");
            $('#faq_id').val(data.id);
            $('#question').val(data.question);
            $('#answer').val(data.answer);
            $('#faqModal').modal('show');
        })
    });

    // Eliminar una pregunta
    $('body').on('click', '.delete', function () {
        var faq_id = $(this).data("id");
        if (confirm("¿Estás seguro de que quieres eliminar esta pregunta?")) {
            $.ajax({
                type: "DELETE",
                url: "{{ url('faqs') }}/" + faq_id,
                success: function (data) {
                    table.ajax.reload(null, false);
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
