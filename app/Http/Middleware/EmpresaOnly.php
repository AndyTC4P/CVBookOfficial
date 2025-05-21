<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmpresaOnly
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'empresa') {
            return $next($request);
        }

        abort(403, 'Acceso restringido solo para empresas.');
    }
}

