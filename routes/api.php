<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\CV;

Route::get('/cvs/buscar', function (Request $request) {
    // 🔐 Validar clave secreta
    $claveSivi = $request->header('x-sivi-key');
    if ($claveSivi !== config('sivi.secret')) {
        return response()->json(['error' => 'No autorizado'], 403);
    }

    $query = CV::query()->where('publico', 1);

    if ($request->filled('categoria')) {
        $query->where('categoria_profesion', $request->categoria);
    }

    if ($request->filled('habilidades')) {
        $habilidades = explode(',', $request->habilidades);
        $query->where(function ($q) use ($habilidades) {
            foreach ($habilidades as $habilidad) {
                $q->orWhere('habilidades', 'like', '%' . trim($habilidad) . '%');
            }
        });
    }

    if ($request->filled('idiomas')) {
        $idiomas = explode(',', $request->idiomas);
        $query->where(function ($q) use ($idiomas) {
            foreach ($idiomas as $idioma) {
                $q->orWhere('idiomas', 'like', '%' . trim($idioma) . '%');
            }
        });
    }

    return response()->json($query->limit(10)->get());
});







