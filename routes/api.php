<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\CV;

Route::get('/cvs/buscar', function (Request $request) {
    // 🔐 Validar clave secreta
    $claveSivi = $request->header('x-sivi-key');
    if ($claveSivi !== config('sivi.secret')) {
        return response()->json(['error' => 'No autorizado'], 403);
    }

    $query = CV::query()->where('publico', 1);

    // 🔎 Filtro por categoría
    if ($request->filled('categoria')) {
        $query->whereRaw('LOWER(categoria_profesion) = ?', [strtolower(trim($request->categoria))]);
    }

    // 🔎 Filtro por habilidades (mejorado)
    if ($request->filled('habilidades')) {
        $habilidades = explode(',', $request->habilidades);
        $query->where(function ($q) use ($habilidades) {
            foreach ($habilidades as $habilidad) {
                $q->orWhereRaw("LOWER(habilidades) LIKE ?", ['%' . strtolower(trim($habilidad)) . '%']);
            }
        });
    }

    // 🔎 Filtro por idiomas (mejorado)
    if ($request->filled('idiomas')) {
        $idiomas = explode(',', $request->idiomas);
        $query->where(function ($q) use ($idiomas) {
            foreach ($idiomas as $idioma) {
                $q->orWhereRaw("LOWER(idiomas) LIKE ?", ['%' . strtolower(trim($idioma)) . '%']);
            }
        });
    }

    return response()->json($query->limit(10)->get());
});








