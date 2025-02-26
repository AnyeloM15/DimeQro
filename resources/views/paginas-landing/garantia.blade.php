@extends('master')
@section('title','Iluminación y Material Eléctrico')

@section('body')




<div class="d-flex justify-content-center align-items-center text-white text fw-bold"
   style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
   url('images/imagen19(grande).jpeg') center/cover no-repeat; 
   height: 50vh; width: 100%;">
   <h1 class="display-1" style="color:#fff">Garantía y Postventa </h1>
</div>

	  
	 
	
	 <section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex flex-wrap justify-content-between mb-5" >
              <h2 class="section-title" style="color:#003588">Garantía y Postventa</h2>
			   <div class="row">
			 <div class="col-md-6">
       <p>
			

      DIMEQRO cuenta con la distribución de las marcas más reconocidas en el mercado de material eléctrico, iluminación, placas y accesorios, que dan el soporte para temas de garantías postventa, aun cuando en un proyecto se cuente con más de una marca, DIMEQRO hará valida todas las garantías.
      </p><p>
      Asesoría en proyectos de Iluminación Brindamos a cada uno de nuestros clientes que nos visitan y que nos siguen a través de nuestras redes sociales una asesoría profesional y especializada.
            <h5>Nos enfocamos en transformar espacios con soluciones modernas, eficientes y sustentables. ¡Conócenos y descubre cómo podemos ser parte del éxito de tus proyectos!
                  </h5>
			</div>
			 <div class="col-md-6">
			  <center><img src="images/s3.png" style="width:400px" class="img-fluid"  style="object-fit: cover;"></center>
			 </div>
			  </div>
            </div>
            
          </div>
        </div>
        
      </div>
	  
	  
    </section>
	
	
    @include('recursos-landing.normas')
    @include('recursos-landing.si-eres-un-cliente')
    @include('recursos-landing.porque-elegirnos')

  

@endsection