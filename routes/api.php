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

    // ✅ Lista oficial de categorías permitidas
    $categorias_validas = [
        'Tecnología e Informática',
        'Salud',
        'Educación',
        'Ingenierías',
        'Administración y Negocios',
        'Derecho y Ciencias Jurídicas',
        'Ciencias Sociales',
        'Marketing y Ventas',
        'Arte y Creatividad',
        'Deportes y Recreación',
        'Comunicación y Medios',
        'Construcción y Mantenimiento',
        'Transporte y Logística',
        'Servicios Personales',
        'Agroindustria y Medio Ambiente',
        'Estudiante',
        'Otro',
    ];

    // 🔎 Filtro por categoría (con validación exacta)
    if ($request->filled('categoria')) {
        $categoria = trim($request->categoria);
        if (in_array($categoria, $categorias_validas)) {
            $query->where('categoria_profesion', $categoria);
        }
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









