@extends('masterpage.admin')

@section('title', 'Editar Configuración del Sitio')

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
                        <h5 class="card-title fw-semibold">Editar Configuración del Sitio</h5>
                    </div>
                </div>
                <form action="{{ url('settings') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Logo -->
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo del Sitio</label>
                        <input type="file" class="form-control" id="logo" name="logo">
                        @if($settings->logo)
                            <img src="{{ url('public/'.$settings->logo) }}" height="100" alt="Logo del Sitio">
                        @endif
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $settings->email }}">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address }}">
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $settings->phone }}">
                    </div>

                    <!-- Redes Sociales -->
                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $settings->facebook }}">
                    </div>

                    <div class="mb-3">
                        <label for="twitter" class="form-label">Twitter</label>
                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $settings->twitter }}">
                    </div>

                    <div class="mb-3">
                        <label for="whatsapp" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $settings->whatsapp }}">
                    </div>

                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $settings->instagram }}">
                    </div>

                    <div class="mb-3">
                        <label for="youtube" class="form-label">YouTube</label>
                        <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $settings->youtube }}">
                    </div>

                    <!-- Nuevos campos de texto enriquecido -->
                    <div class="mb-3">
                        <label for="terms" class="form-label">Términos y Condiciones</label>
                        <textarea id="terms" name="terms" class="form-control">{{ $settings->terms }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="refund_policy" class="form-label">Política de Devoluciones</label>
                        <textarea id="refund_policy" name="refund_policy" class="form-control">{{ $settings->refund_policy }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="shipping_policy" class="form-label">Política de Envíos</label>
                        <textarea id="shipping_policy" name="shipping_policy" class="form-control">{{ $settings->shipping_policy }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cookie_policy" class="form-label">Política de Cookies</label>
                        <textarea id="cookie_policy" name="cookie_policy" class="form-control">{{ $settings->cookie_policy }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="warranty_policy" class="form-label">Política de Garantía</label>
                        <textarea id="warranty_policy" name="warranty_policy" class="form-control">{{ $settings->warranty_policy }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="payment_methods" class="form-label">Métodos de Pago</label>
                        <textarea id="payment_methods" name="payment_methods" class="form-control">{{ $settings->payment_methods }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="security_policy" class="form-label">Política de Seguridad</label>
                        <textarea id="security_policy" name="security_policy" class="form-control">{{ $settings->security_policy }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="promotions" class="form-label">Promociones y Descuentos</label>
                        <textarea id="promotions" name="promotions" class="form-control">{{ $settings->promotions }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Configuración</button>
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

<!-- CKEditor actualizado a 4.25.0-lts -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('terms');
    CKEDITOR.replace('refund_policy');
    CKEDITOR.replace('shipping_policy');
    CKEDITOR.replace('cookie_policy');
    CKEDITOR.replace('warranty_policy');
    CKEDITOR.replace('payment_methods');
    CKEDITOR.replace('security_policy');
    CKEDITOR.replace('promotions');
</script>
@endsection
