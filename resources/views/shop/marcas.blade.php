
 
@extends('master')

@section('title', 'Promociones y Descuentos')

@section('body')
<br><br>

<section class="section" id="men">
    

        <div class="container  mt-4 " >
        <div class="row">
                <div class="item ">
                <div class="section-heading">
                    <h2>Nuestras Marcas</h2>
                    <span>Explora nuestras marcas de confianza, ofreciendo productos de alta calidad.</span>
                </div>

                </div>
            </div>
            <div class="main-banner" id="top" style="padding-top:10px">
                <div class="container-fluid">
                <div class="right-content">
                    <div class="row">
                    @foreach(DB::table('brands')->where('active', 1)->get() as $brand)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="right-first-image">
                                    <div class="thumb">
                                        <div class="inner-content">
                                            <a href="{{url('marca').'/'.$brand->id}}"><h4>{{ $brand->name }}</h4></a>
                                        </div>
                                        <div class="hover-content">
                                            <div class="inner">
                                            <a href="{{url('marca').'/'.$brand->id}}"><h4>{{ $brand->name }}</h4></a>
                                                
                                                <div class="main-border-button">
                                                <a href="{{url('marca').'/'.$brand->id}}">Descubrir más</a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{url('marca').'/'.$brand->id}}">
                                                <img src="{{ url($brand->logo) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>

    </section>


@endsection




