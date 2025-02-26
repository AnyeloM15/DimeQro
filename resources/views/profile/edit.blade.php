
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
                <h5 class="card-title fw-semibold">Administrar Perfil</h5><br>
                
                @include('profile.partials.update-profile-information-form')

                @include('profile.partials.update-password-form')

        </div>
    </div>

            </div>
        </div>
    </div>
</div>




@endsection

