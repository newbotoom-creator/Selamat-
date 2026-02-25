<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Contoh membuat Middleware cek Admin (php artisan make:middleware IsAdmin)
public function handle(Request $request, Closure $next)
{
    if (auth()->check() && auth()->user()->is_admin == 1) {
        return $next($request);
    }
    
    return redirect('/')->with('error', 'Anda tidak memiliki akses admin.');
}
}
