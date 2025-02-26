<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dimeqro - @yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="iluminación, material eléctrico, SIMON, TECNOLITE, IUSA, TLapps, CALUX, PHILCO">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icono.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/icono.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/icono.png">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{url('/css/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}">
    <link rel="shortcut icon" href="{{url('/')}}" style="height: 20px; width: 80px;" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://db.onlinewebfonts.com/c/2a61d83e6af5b73f8f7751643f767325?family=GreycliffCF-DemiBold" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
  <body>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <defs>
        <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
          <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
          <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
          <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
          <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
          <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
          <path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
      </defs>
    </svg>

    <div class="preloader-wrapper">
      <div class="preloader">
      </div>
    </div>
    <a style="text-decoration:none" href="https://wa.me/4421071706" target="_blank" class="btn-whatsapp-float">
      <img src="https://img.icons8.com/color/48/000000/whatsapp.png" alt="WhatsApp">
  </a>


  <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="background-color:transparent">
        <div class="modal-content" style="background-color:transparent; border:0px;">
        <div class="modal-body">
            <div class="d-flex justify-content-between">
            <h5 class="modal-title" style="color:#fff">Buscar productos</h5>
            <button type="button"  style="color:#fff; background-color:transparent; border:0px;"  data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <form action="{{url('buscar')}}">
                <input type="text" name="producto" class="form-control mt-3" placeholder="Buscar...">
            </form>
        </div>
        </div>
    </div>
    </div>


  <header>
      <div class="container-fluid" >
        <div class="row py-3 border-bottom">
          
          <div class="col-sm-4 col-lg-3 text-center text-sm-start">
            <div class="main-logo">
              <a style="text-decoration:none" href="{{url('/')}}">
                <img src="{{url('/images/logoDime.png')}} " style="height: 100px; width: auto;" alt="logo" class="img-fluid">
              </a>
            </div>
          </div>
          
             <div   class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
            <div class="search-bar row bg-light p-2 my-2 rounded-4">
              <div  class="col-md-4 d-none d-md-block">
                <select  class="form-select border-0 bg-transparent">
                  <option>Todas</option>
                  <option>Iluminación</option><option>Accesorios</option>
					<option>Cable</option>
					<option>Manguera</option>
					<option>Material Eléctrico</option>
					<option>Tubería</option>
					<option>Productos Galvanizados</option>
					<option>Charola</option>
					<option>Postes , Bases,Registros</option>
                </select>
              </div>
              <div  class="col-11 col-md-7">
                <form  class="text-center" action="{{url('buscar')}}" >
                  <input type="text" name="producto" class="form-control border-0 bg-transparent" placeholder="Busque entre más de 20,000 productos" />
                </form>
              </div>
              
            </div>
          </div>
          <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
            <div class="support-box text-end d-none d-xl-block">
              <span class="fs-6 text-muted">Contáctanos</span>
              <h5 class="mb-0">(442)107-1706</h5>
            </div>

            <ul class="d-flex justify-content-end list-unstyled m-0">
              <li >
                <a style="text-decoration:none" href="login" class=" bg-light p-2 mx-1" style="text-decoration:none;color:#003588">
                  <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#user"></use></svg> <strong>Mi cuenta</strong>
                </a>
              </li>
              
              <li class="d-lg-none position-relative">
                <a style="text-decoration:none" href="{{ url('/cart') }}" class="rounded-circle bg-light p-2 mx-1 position-relative">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg>
                    <!-- Circulo flotante con el número de artículos -->
                    <span id="circlTotal" class=" circlTotal position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                    </span>
                </a>
            </li>

              <li class="d-lg-none">
                <a style="text-decoration:none" data-bs-toggle="modal" data-bs-target="#searchModal" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                  <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#search"></use></svg>
                </a>
              </li>
            </ul>
            <!--Carrito de compras -->
            <div  class="cart text-end d-none d-lg-block dropdown">
              <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" onclick="window.location.href='{{ url('/cart') }}'" >
                <span  class="fs-6 text-muted ">Carrito</span>
                <span id="circlTotal" class=" circlTotal position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                </span>
                <span   class="cart-total fs-5 fw-bold" id='totalCarritoMoney'>$0.00</span>
              </button>
            </div>
            <!--Fin Carrito de compras -->
          </div>

        </div>
      </div>
      <div class="container-fluid">
        <div class="row py-3">
          <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
            <nav class="main-menu d-flex navbar navbar-expand-lg">

              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

                <div class="offcanvas-header justify-content-center">
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
              
                <!-- Marcas, enlaces rapidos -->
                <div class="offcanvas-body">
               
                  <!-- fin de las categorias -->
              
                  <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                    <li class="nav-item active">
                     <a style="text-decoration:none" href="{{url('/')}}" class="nav-link">Inicio</a>
                   </li>
         
         <li class="nav-item active"><a style="text-decoration:none" href="{{url('/nosotros')}}" class="nav-link">Nosotros</a></li>
                   <li class="nav-item active"><a style="text-decoration:none" href="{{url('/contacto')}}" class="nav-link">Contacto</a></li>
          
          <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Soluciones</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none" href="{{url('/solucion-iluminacion')}}" class="dropdown-item">Iluminación  </a></li>
                       <li><a style="text-decoration:none" href="{{url('/solucion-material_electrico')}}" class="dropdown-item">Material Eléctrico </a></li>
                       <li><a style="text-decoration:none" href="{{url('/solucion-energia_renovable')}}" class="dropdown-item">Energía Renovable </a></li>
                       
                       <li><a style="text-decoration:none" href="{{url('/solucion-instalacion_electrica')}}" class="dropdown-item">Instalación Eléctrica </a></li>
                       <li><a style="text-decoration:none" href="{{url('/solucion-levantamiento_conteo_planos')}}" class="dropdown-item">Levantamiento y Conteo en obra y/o Planos en Obra </a></li>
                       <li><a style="text-decoration:none" href="{{url('/solucion-garantia_postventa')}}" class="dropdown-item">Garantía y Postventa </a></li>
                     </ul>
                   </li>
         
       
         
         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Iluminación de hogar y Jardín</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Tecnolite</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Calux</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}"class="dropdown-item">Philco</a></li>
           </ul>
                   </li>
         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Iluminación Industrial</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Supra</a></li>
           <li><a style="text-decoration:none"href="{{url('/solucion-venta')}}"class="dropdown-item">Energain</a></li>
           </ul>
                   </li>
         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Iluminación de Proyectos</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none"href="{{url('/solucion-venta')}}" class="dropdown-item">Zeraus</a></li>
           <li><a style="text-decoration:none"href="{{url('/solucion-venta')}}" class="dropdown-item">Construlita</a></li>
           </ul>
                   </li>
         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Iluminación Variedad</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Forthlighting</a></li>
           <li><a style="text-decoration:none"href="{{url('/solucion-venta')}}" class="dropdown-item">Simon</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Tlapps</a></li>
           </ul>
                   </li>
         
         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Material Eléctrico y Otros</a>
                     <ul class="dropdown-menu" aria-labelledby="pages">
                       <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">IUSA</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Conductores del Norte</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Tuboflex</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Plastistrech</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Anclo</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Argos</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Jupiter</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Emsa</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">TAMSA</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">Charofil</a></li>
           <li><a style="text-decoration:none" href="{{url('/solucion-venta')}}" class="dropdown-item">ILUMAX</a></li>
           </ul>
                   </li>
         
       
         
                   
         
         
                 </ul>
                
                </div>
                <!-- Fin de enlaces rapidos por marca -->
              </div>
          </div>
        </div>
      </div>
    </header>
    
    @yield('body')
    <a href="https://www.tienda.dimeqro.com" target="_blank" 
   style="position: fixed; bottom: 20px; left: 20px; background-color: #ffe600; color: #333; 
          padding: 10px 15px; border-radius: 50px; font-weight: bold; font-size: 14px;
          display: flex; align-items: center; text-decoration: none; box-shadow: 2px 2px 10px rgba(0,0,0,0.2);">
    <img src="https://www.expoknews.com/wp-content/uploads/2020/03/1200px-MercadoLibre.svg-1.png" alt="Mercado Libre" style="height: 30px; margin-right: 8px;">
    Encuéntranos en Mercado Libre
</a>
   
    <footer class="py-5">
      <div class="container-fluid">
        <div class="row">

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="footer-menu">
              <img src="{{url('images/logoDime.png')}}" style="height: 100px; width: auto;" alt="logo" class="img-fluid">
              <div class="social-links mt-5">
                <ul class="d-flex list-unstyled gap-2">
                  <li>
                    <a style="text-decoration:none" href="{{ DB::table('site_settings')->first()->facebook }}" class="btn btn-outline-light">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z"/></svg>
                    </a>
                  </li>
                  
                  <li>
                    <a style="text-decoration:none" href="{{ DB::table('site_settings')->first()->instagram }}" class="btn btn-outline-light">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.3 7.3 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.3 7.3 0 0 0 2.43.47C8.94 22 9.28 22 12 22s3.06 0 4.12-.06a7.3 7.3 0 0 0 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.85 4.85 0 0 0 1.16-1.77a7.59 7.59 0 0 0 .46-2.43c0-1.06.06-1.4.06-4.12s0-3.06-.06-4.12ZM20.14 16a5.61 5.61 0 0 1-.34 1.86a3.06 3.06 0 0 1-.75 1.15a3.19 3.19 0 0 1-1.15.75a5.61 5.61 0 0 1-1.86.34c-1 .05-1.37.06-4 .06s-3 0-4-.06a5.73 5.73 0 0 1-1.94-.3a3.27 3.27 0 0 1-1.1-.75a3 3 0 0 1-.74-1.15a5.54 5.54 0 0 1-.4-1.9c0-1-.06-1.37-.06-4s0-3 .06-4a5.54 5.54 0 0 1 .35-1.9A3 3 0 0 1 5 5a3.14 3.14 0 0 1 1.1-.8A5.73 5.73 0 0 1 8 3.86c1 0 1.37-.06 4-.06s3 0 4 .06a5.61 5.61 0 0 1 1.86.34a3.06 3.06 0 0 1 1.19.8a3.06 3.06 0 0 1 .75 1.1a5.61 5.61 0 0 1 .34 1.9c.05 1 .06 1.37.06 4s-.01 3-.06 4ZM12 6.87A5.13 5.13 0 1 0 17.14 12A5.12 5.12 0 0 0 12 6.87Zm0 8.46A3.33 3.33 0 1 1 15.33 12A3.33 3.33 0 0 1 12 15.33Z"/></svg>
                    </a>
                  </li>
                  </ul>
              </div>
            </div>
          </div>

          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Marcas</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Calux')}}" class="nav-link">Calux</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=TLapps')}}" class="nav-link">TLapps</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Simon')}}" class="nav-link">Simon</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Iusa')}}" class="nav-link">Iusa</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Philco')}}" class="nav-link">Philco</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Tecnolite')}}" class="nav-link">Tecnolite</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Supra')}}" class="nav-link">Supra</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Energain')}}" class="nav-link">Energain</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Zeraus')}}" class="nav-link">Zeraus</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Construlita')}}" class="nav-link">Construlita</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Forlighting')}}" class="nav-link">Forlighting</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Conductores del Norte')}}" class="nav-link">Conductores del Norte</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Tuboflex')}}" class="nav-link">Tuboflex</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Plasti Stretch')}}" class="nav-link">Plasti Stretch</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Anclo')}}" class="nav-link">Anclo</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Argos')}}" class="nav-link">Argos</a>
                </li>
                <li class="menu-item">
                    <a style="text-decoration:none" href="{{url('buscar?producto=Jupiter')}}" class="nav-link">Jupiter</a>
                </li>
            </ul>
              
            </div>
          </div>
          
          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Categoría</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Lámparas</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Interiores</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Exteriores</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Accesorios eléctricos</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Conductores</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Iluminación vial</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="#" class="nav-link">Materiales eléctricos</a>
                </li>
              </ul>
            </div>
          </div>
          
        
          
          <div class="col-md-2 col-sm-6">
    <div class="footer-menu">
        <h5 class="widget-title">Ayuda e Información</h5>
        <ul class="menu-list list-unstyled">
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/terminos-y-condiciones') }}">Términos y Condiciones</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/devoluciones-y-reembolsos') }}">Política de Devoluciones</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/politica-de-envios') }}">Política de Envíos</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/politica-de-cookies') }}">Política de Cookies</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/politica-de-garantia') }}">Política de Garantía</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/metodos-de-pago') }}">Métodos de Pago</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/politica-de-seguridad') }}">Política de Seguridad</a></li>
            <li class="menu-item"><a class="nav-link" style="text-decoration:none" href="{{ url('/promociones-y-descuentos') }}">Promociones y Descuentos</a></li>
        </ul>
    </div>
</div>

           
          <div class="col-md-2 col-sm-6">
            <div class="footer-menu">
              <h5 class="widget-title">Contacto</h5>
              <ul class="menu-list list-unstyled">
                <li class="menu-item">
                  <a style="text-decoration:none" href="tel:+52{{ DB::table('site_settings')->first()->phone }}" class="nav-link">Tel: {{ DB::table('site_settings')->first()->phone }}</a>
                </li>
                <li class="menu-item">
                  <a style="text-decoration:none" href="mailto:{{ DB::table('site_settings')->first()->email }}" class="nav-link">{{ DB::table('site_settings')->first()->email }}</a>
                </li>
                <li class="menu-item">
                  <span class="nav-link">{{ DB::table('site_settings')->first()->address }}</span>
                </li>
                
              </ul>

              <div class="col-md-2 col-sm-6">
                
              </div>

              <div class="map-container mt-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3735.973227750246!2d-100.38232442494503!3d20.548276280983544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d344f6cc25511f%3A0xc14de1261dbc48c9!2sBlvrd%20de%20los%20Gobernadores%201981%2C%20Villas%20del%20Cimatario%2C%20San%20Andres%2C%2076085%20Santiago%20de%20Quer%C3%A9taro%2C%20Qro.!5e0!3m2!1ses!2smx!4v1740069458672!5m2!1ses!2smx" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        
          
        </div>
      </div>
    </footer>
    <div id="footer-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 copyright">
		    
            <small style="color:#003588">Encuentranos en:</small><img src="{{url('/images/mercado.png')}}" alt="Mercado Libre" class="me-2" style="height: 30px;"/>
            <p>© Dimeqro. Todos los derechos reservados.</p>
          </div>
          
        </div>
      </div>
    </div>
    <script src="{{url('/js/jquery-1.11.0.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{url('js/plugins.js')}}"></script>
    <script src="{{url('js/script.js')}}"></script>

    <script>
        

        

        function buscar(){
            $("#searchModal").modal('show');
        }
        function cerrarbuscar(){
            $("#searchModal").modal('hide');
        }


        getTotalCart();
        function getTotalCart(pago=null){
           $.ajax({
               url: '{{url("/get-total-carrito")}}', // Ruta hacia el controlador que manejará la solicitud
               type: 'POST',
               success: function(response) {
                   if (response.status === 'success') {
                       $("#totalCarritoMoney").html(response.precioTotal);
                       $(".circlTotal").html(response.total);
                   } else if (response.status === 'error') {
                       $.notify('Error: ' + response.message, "danger");
                   }
                  
                   if (pago == 1) {
                      window.location.href = "{{ url('/cart') }}";
                   }
               },
               error: function(xhr, status, error) {
                   $.notify('Hubo un error al agregar el producto al carrito.', "danger");
               }
           });

       }


       function cart(id, total, pago = null) {
          console.log("Enviando a AJAX:", { id, total }); // Depuración

          $.ajax({
              url: '{{ url("/agregar-al-carrito") }}',
              type: 'POST',
              data: { id: id, total: total },
              success: function(response) {
                  if (response.status === 'success') {
                      $("#totalCarritoMoney").html(response.precioTotal);
                      $(".mycart").html(response.total); // Actualizar contador
                      getTotalCart(pago);
                      $.notify("Producto agregado al carrito!", "success");
                      $(".delete-cart").removeClass("d-none");
                      $(".btcart").html('<i class="fa fa-shopping-cart"></i>  Actualizar');

                      
                  } else {
                      $.notify("Error: " + response.message, "danger");
                  }
              },
              error: function(xhr) {
                  console.error("Error en AJAX:", xhr.responseText);
                  $.notify("Hubo un error al agregar el producto al carrito.", "danger");
              }
          });
      }



        function deleteCart(productId) {
          
          $.ajax({
              url: '{{url("/carrito/eliminar/")}}'+'/' + productId,
              type: 'POST',
              success: function(response) {
                  if (response.status === 'success') {
                      $("#totalCarritoMoney").html(response.costo);
                      getTotalCart();
                      // Eliminar el div correspondiente al producto
                      $('#product-' + productId).remove();

                      // Actualizar el total del carrito
                      $('#total-carrito').html('<h3><strong>Total del Carrito:</strong> $' + response.costo + '</h3>');

                      // Si no quedan productos en el carrito, mostrar un mensaje
                      if ($('.carrito-item').length === 0) {
                          $('#carrito-body').html('<div class="alert alert-warning">No hay productos en el carrito.</div>');
                          $(".pagar").hide();
                      }
                      
                      $(".mycart").html(response.total);
                      $.notify('Producto eliminado', "success");
                      $(".delete-cart").addClass("d-none");
                      $(".qtycart").val(1);
                      

                      $(".btcart").html('<i class="fa fa-shopping-cart"></i>  Agregar');


                  } else {
                      alert('Error al eliminar el producto');
                      $.notify('Error al eliminar el producto.', "danger");
                  }
              },
              error: function(xhr) {
                  alert('Hubo un error en la solicitud');
                  $.notify('Hubo un error en la solicitud', "danger");
              }
          });
      }

    </script>

    @yield('js')
  </body>
</html>