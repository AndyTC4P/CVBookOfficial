<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpresaAprobada
{
    public function handle(Request $request, Closure $next): Response
{
    if (auth()->check() && auth()->user()->role === 'empresa' && auth()->user()->status !== 'aprobado') {
        return redirect()->route('empresa.esperando');
    }

    return $next($request);
}

}

