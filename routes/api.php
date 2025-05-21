<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\CV;

Route::get('/cvs/buscar', function (Request $request) {
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

    return response()->json($query->limit(10)->get());
});




