@extends('master')

@section('title', 'Confirmación de Pedido')

@section('body')
<section class="py-5" style="background-image: url('{{url("images/imagen22(grande).jpeg")}}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container-fluid">
        <div class="bg-secondary py-5 my-5 rounded-5" style="background-color: rgba(255,255,255,0.9) !important;">
            <div class="container my-5">
                <div class="row">
                    <div class="col-md-12 p-5 text-center">
                        <div class="section-header">
                            <h2 class="text-success">✅ ¡Pedido Realizado con Éxito!</h2>
                            <p>Tu pedido con número <strong>#{{ $order }}</strong> ha sido registrado correctamente.</p>
                            <p>Nos pondremos en contacto contigo pronto.</p>
                            <a href="{{url('/dashboard')}}" class="btn btn-primary">Ver Pedido</a>
                        </div>
                        <hr class="my-4">
                        <div class="alert alert-warning py-4 px-5 text-center" style="border-left: 5px solid #ffc107;">
                            <h4 class="text-dark fw-bold">⚠️ ¡Importante! No olvides enviar tu comprobante de pago</h4>
                            <p class="mb-3">Para agilizar el proceso de envío/entrega, por favor envíanos tu comprobante de pago por:</p>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="https://wa.me/" target="_blank" class="btn btn-dark mx-2" style="background-color:#26cd0c">
                                    📲 Enviar por WhatsApp
                                </a>
                                <a href="{{url('/dashboard')}}" class="btn btn-primary mx-2">
                                    📤 Subir Comprobante en Historial de Pedidos
                                </a>
                            </div>
                        </div>
                        <p class="text-muted mt-3">Si ya realizaste tu pago, asegúrate de enviarnos tu comprobante lo antes posible para procesar tu pedido rápidamente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection
