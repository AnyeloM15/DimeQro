@extends('master')
@section('title', 'Promociones y Descuentos')
@section('body')
<br><br>
<section class="section" id="men">

<div class="container  mt-4 " >
<div class="row">
        <div class="item ">
        <div class="section-heading">
            <h2>Últimas Categorías</h2>
            <span>Explora nuestras categorías destacadas, donde encontrarás productos de calidad y las mejores ofertas.</span>
        </div>
        </div>
    </div>
    <div class="main-banner" style="padding-top:10px" >
        <div class="container-fluid">
        <div class="right-content">
            <div class="row">
                @foreach(DB::table('categories')->where('active', 1)->get() as $category)
                <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="right-first-image">
                            <div class="thumb">
                                <div class="inner-content">
                                    <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                    <span>{{ Str::limit($category->description, 20, '...') }}</span>
                                </div>
                                <div class="hover-content">
                                    <div class="inner">
                                    <a href="{{url('categoria').'/'.$category->id}}"><h4>{{ $category->name }}</h4></a>
                                        <p>{{ Str::limit($category->description, 100, '...') }}</p>
                                        <div class="main-border-button">
                                        <a href="{{url('categoria').'/'.$category->id}}">Descubrir más</a>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url('categoria').'/'.$category->id}}">
                                        <img src="{{ url($category->image) }}" alt="">
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