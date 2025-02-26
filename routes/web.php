<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\LandingController;



use App\Http\Controllers\EventController;
require __DIR__.'/auth.php';


use App\Http\Controllers\CategoryController;
Route::resource('categories', CategoryController::class);

use App\Http\Controllers\SubcategoryController;
Route::resource('subcategories', SubcategoryController::class);

use App\Http\Controllers\BrandController;
Route::resource('brands', BrandController::class);

use App\Http\Controllers\ProductController;
Route::resource('products', ProductController::class);
Route::delete('/delete-image/{id}', [ProductController::class, 'destroyPhoto']);

use App\Http\Controllers\SiteSettingController;
Route::get('/settings', [SiteSettingController::class, 'edit']);
Route::post('/settings', [SiteSettingController::class, 'update']);


use App\Http\Controllers\FAQController;
Route::resource('faqs', FAQController::class);



Route::get('/checkAndMoveImages', [ProductController::class, 'checkAndMoveImages']);
Route::get('/exportCSV', [ProductController::class, 'exportCSV']);
Route::get('/load-products', [ProductController::class, 'loadProducts'])->name('load-products');

Route::get('/categoria/{id}', [ProductController::class, 'categoriaProducts'])->name('categoriaProducts');
Route::get('/marca/{id}', [ProductController::class, 'marcaProducts'])->name('marcaProducts');
Route::get('/buscar', [ProductController::class, 'buscar'])->name('buscar');
Route::get('/producto/{id}', [ProductController::class, 'producto'])->name('producto');
// En tu archivo routes/web.php
Route::post('/agregar-al-carrito', [ProductController::class, 'agregarAlCarrito'])->name('agregar-al-carrito');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/carrito/eliminar/{id}', [ProductController::class, 'eliminarDelCarrito'])->name('carrito.eliminar');
Route::post('/get-total-carrito', [ProductController::class, 'getTotalCarrito'])->name('get-total-carrito');





/*
UPDATE product_images
SET image = REPLACE(image, 'exist', 'products')
WHERE image LIKE '%exist%';

drop table inv;
create table inv as SELECT a.id,c.name categoria,b.name subcategoria,d.name marca,product_code,a.name,a.description,price,stock,NVL(e.image,'-') as 
foto FROM products a
left join subcategories b on b.id=subcategory_id
left join categories c on b.category_id=c.id
left join brands d on d.id=brand_id
left join product_images e on a.id=e.product_id;
*/ 



Route::get('/', [LandingController::class, 'welcome'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/preguntas-frecuentes', function () { 
    return view('info.faq'); 
})->name('terminos');

Route::get('/terminos-y-condiciones', function () {
    return view('info.terminos');
})->name('terminos');

Route::get('/devoluciones-y-reembolsos', function () {
    return view('info.devoluciones');
})->name('devoluciones');

Route::get('/politica-de-envios', function () {
    return view('info.envios');
})->name('envios');

Route::get('/politica-de-cookies', function () {
    return view('info.cookies');
})->name('cookies');

Route::get('/politica-de-garantia', function () {
    return view('info.garantia');
})->name('garantia');

Route::get('/faq', function () {
    return view('info.faq');
})->name('faq');



Route::get('/nosotros', function () {
    return view('paginas-landing.nosotros');
});


Route::get('/contacto', function () {
    return view('paginas-landing.contacto');
});


Route::get('/solucion-iluminacion', function () {
    return view('paginas-landing.sol_iluminacion');
});

Route::get('/solucion-material_electrico', function () {
    return view('paginas-landing.material_electrico');	
});


Route::get('/solucion-energia_renovable', function () {
    return view('paginas-landing.energia_renovable');	
});


Route::get('/solucion-instalacion_electrica', function () {
    return view('paginas-landing.instalacion');	
});


Route::get('/solucion-levantamiento_conteo_planos', function () {
    return view('paginas-landing.levantamiento');	
});

Route::get('/solucion-garantia_postventa', function () {
    return view('paginas-landing.garantia');	
});

Route::get('/solucion-venta', function () {
    return view('paginas-landing.venta');	
});



Route::get('/metodos-de-pago', function () {
    return view('info.metodos_pago');
})->name('metodos_pago');

Route::get('/politica-de-seguridad', function () {
    return view('info.seguridad');
})->name('seguridad');

Route::get('/promociones-y-descuentos', function () {
    return view('info.promociones');
})->name('promociones');

use App\Http\Controllers\ShopController;
Route::get('categorias', [ShopController::class, 'categorias'])->name('categorias');
Route::get('marcas', [ShopController::class, 'marcas'])->name('marcas');
Route::get('marcas', [ShopController::class, 'marcas'])->name('marcas');



// Ruta para redirigir al usuario a Google
Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
// Ruta para manejar la respuesta de Google
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pago', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/failure', [PaymentController::class, 'failure'])->name('payment.failure');
    Route::get('/pending', [PaymentController::class, 'pending'])->name('payment.pending');
    Route::post('/webhook', [PaymentController::class, 'webhook'])->name('webhook');

});







