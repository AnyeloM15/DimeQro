<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function categorias(){
        return view('shop.categorias');
    }

    public function marcas(){
        return view('shop.marcas');
    }

    
}
