<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Admin Panel')</title>
  <link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/img/icono.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/img/icono.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/img/icono.png') }}">
  <link rel="shortcut icon" type="image/png" href="{{url('assets/images/logos/favicon.png') }}" />
  @yield('css')
  <link rel="stylesheet" href="{{url('assets/css/styles.min.css')}}?v={{time()}}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  
</head>
<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('masterpage.sidebar')
    <div class="body-wrapper">
    @include('masterpage.header')
      <div class="{{--container-fluid--}}">
          <br><br><br>
          @yield('content')
        {{--@include('masterpage.footer')--}}
      </div>
    </div>
  </div>
    <!-- For Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="{{url('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{url('assets/js/app.min.js') }}"></script>
  <script src="{{url('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="{{url('assets/js/dashboard.js') }}?v=23"></script>
  <script src="{{url('assets/js/bootstrap-notify.js')}}"></script>
  <script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[type="number"]').attr('step', '0.01');
    $('input[type="number"]').on('input', function () {
        // Permite solo números y un punto decimal
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        // Elimina puntos extra si se introducen más de uno
        if ($(this).val().split(".").length > 2) {
            $(this).val($(this).val().replace(/\.$/, ''));
        }
    });

    
  }); 
  </script>
  @yield('js')
   
</body>
</html>