<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\CV;

Route::middleware('throttle:60,1')->get('/cvs/buscar', function (Request $request) {
    $referer = $request->header('referer');
    $userAgent = $request->header('user-agent');

    // Permitir solo si viene del dominio o del GPT
    if (
        (! $referer || ! str_contains($referer, 'cvbook.online')) &&
        (! $userAgent || ! str_contains($userAgent, 'ChatGPT'))
    ) {
        return response()->json(['error' => 'Acceso no autorizado'], 403);
    }

    $query = CV::query()->where('publico', 1);

    if ($request->filled('categoria')) {
        $query->where('categoria_profesion', $request->categoria);
    }

    if ($request->filled('habilidades')) {
        $habilidades = array_map('trim', explode(',', $request->habilidades));
        $query->where(function ($q) use ($habilidades) {
            foreach ($habilidades as $habilidad) {
                $q->orWhereRaw('LOWER(habilidades) LIKE ?', ['%' . strtolower($habilidad) . '%']);
            }
        });
    }

    return response()->json($query->limit(10)->get());
});





