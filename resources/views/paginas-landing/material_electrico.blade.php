@extends('master')
@section('title','Iluminación y Material Eléctrico')
@section('body')
<div class="d-flex justify-content-center align-items-center text-white text fw-bold"
   style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
   url('images/b1.png') center/cover no-repeat; 
   height: 50vh; width: 100%;">
   <h1 class="display-1" style="color:#fff">Matrial Eléctrico</h1>
</div>
<section class="py-5 overflow-hidden">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="section-header d-flex flex-wrap justify-content-between mb-5" >
               <h2 class="section-title" style="color:#003588">Matrial Eléctrico</h2>
               <div class="row">
                  <div class="col-md-12">
                     <p>
                        En DIME Contamos con una amplia cartera de fabricantes de material eléctrico para Alta, media y baja tensión.
                        Asesoría Brindamos a cada uno de nuestros clientes asesoría en cuestión de producto de material eléctrico adecuado para su proyecto.
                     </p>
                     <h5>Nos enfocamos en transformar espacios con soluciones modernas, eficientes y sustentables. ¡Conócenos y descubre cómo podemos ser parte del éxito de tus proyectos!
                     </h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@include('recursos-landing.normas')
{{--@include('recursos-landing.compra-en-linea')--}}
{{--@include('recursos-landing.nuestras-lamparas')--}}
@include('recursos-landing.porque-elegirnos')
@include('recursos-landing.si-eres-un-cliente')
{{--@include('recursos-landing.podria-interesarte')--}}
@endsection