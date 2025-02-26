@extends('master')
@section('title','Iluminación y Material Eléctrico')

@section('body')




<div class="d-flex justify-content-center align-items-center text-white text fw-bold"
    style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
            url('images/imagen22(grande).jpeg') center/cover no-repeat; 
           height: 50vh; width: 100%;">
    <h1 class="display-1" style="color:#fff">Iluminación</h1>
</div>




      <section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex flex-wrap justify-content-between mb-5" >
              <h2 class="section-title" style="color:#003588">Iluminación</h2>
			   <div class="row">
			 <div class="col-md-6">
			 <p>En DimeQro Creamos diseňos de iluminación innovadores para cada espacio en construcción o remodelación. Contamos con un área de Desarrollos de Proyectos, el cual brinda asesoría a todos nuestros clientes, para el desarrollo de sus proyectos de iluminación especializados, con la má alta tecnología, servicio y calidad. Diseňo de iluminación Creamos diseňos de iluminación innovadores para cada espacio en construcción o remodelación, cubriendo las necesidades específicas de cada área, garantizando la satisfacción total a nuestros clientes.

</p><p>Asesoría en proyectos de Iluminación Brindamos a cada uno de nuestros clientes que nos visitan y que nos siguen a través de nuestras redes sociales una asesoría profesional y especializada, para la correcta iluminación de sus espacios.</p>


			<h5>Nos enfocamos en transformar espacios con soluciones modernas, eficientes y sustentables. ¡Conócenos y descubre cómo podemos ser parte del éxito de tus proyectos!
            </h5>
			</div>
			 <div class="col-md-6">
			  <center><img src="images/s2.png" class="img-fluid"  style="object-fit: cover;"></center>
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