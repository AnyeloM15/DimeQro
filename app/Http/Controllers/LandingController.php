<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function welcome(){
        // Recuperar las categorías donde active = 1, limitando a las primeras 20
        $categories = Category::where('active', 1)->get();

        // Pasar las categorías a la vista
        return view('welcome', compact('categories'));
    }
}
