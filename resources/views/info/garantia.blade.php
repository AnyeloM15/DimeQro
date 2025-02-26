


 
@extends('master')

@section('title', 'Política de Garantía')


@section('body')

<div class="d-flex justify-content-center align-items-center text-white text fw-bold"
   style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
   url('images/s5.png') center/cover no-repeat; 
   height: 50vh; width: 100%;">
   <h1 class="display-1" style="color:#fff">Política de Garantía</h1>
</div>
<section class="py-5 overflow-hidden">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="section-header d-flex flex-wrap justify-content-between mb-5" >
              
               <div class="row">
                  <div class="col-md-12">
                  {!! DB::table('site_settings')->first()->warranty_policy !!}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@include("info.acordeonfaq")


@endsection












