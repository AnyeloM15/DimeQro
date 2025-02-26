<?php
namespace App\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Rutas excluidas de la verificación CSRF.
     */
    protected $except = [
        '/agregar-al-carrito',
        '/carrito/eliminar/*',
        '/get-total-carrito',
    ];
}

