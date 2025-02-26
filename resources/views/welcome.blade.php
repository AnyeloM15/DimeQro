@extends('master')
@section('title','Iluminación y Material Eléctrico')

@section('body')


	
	@include('recursos-landing.carrousel')
    {{-- @include('recursos-landing.nosotros')
    @include('recursos-landing.servicios')--}}
    
    @include('recursos-landing.categorias')
    @include('recursos-landing.nuestras-marcas')
    @include('recursos-landing.compra-en-linea')
	@include('recursos-landing.cupones')
    {{--@include('recursos-landing.los-mas-buscados')--}}
    @include('recursos-landing.productos')
	@include('recursos-landing.podria-interesarte')
    @include('recursos-landing.si-eres-un-cliente')
    @include("info.acordeonfaq")

  

@endsection


