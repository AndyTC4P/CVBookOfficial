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

    // 🔎 Filtro base: solo CVs públicos
    $query = CV::query()->where('publico', 1);

    // ✅ Lista de categorías permitidas
    $categorias_validas = [
        'Tecnología e Informática', 'Salud', 'Educación', 'Ingenierías',
        'Administración y Negocios', 'Derecho y Ciencias Jurídicas',
        'Ciencias Sociales', 'Marketing y Ventas', 'Arte y Creatividad',
        'Deportes y Recreación', 'Comunicación y Medios', 'Construcción y Mantenimiento',
        'Transporte y Logística', 'Servicios Personales', 'Agroindustria y Medio Ambiente',
        'Estudiante', 'Otro',
    ];

    // 🔎 Filtro por categoría exacta
    if ($request->filled('categoria')) {
        $categoria = trim($request->categoria);
        if (in_array($categoria, $categorias_validas)) {
            $query->where('categoria_profesion', $categoria);
        }
    }

    // 🔎 Filtro por habilidades (mejorado con LOWER)
    if ($request->filled('habilidades')) {
        $habilidades = explode(',', $request->habilidades);
        $query->where(function ($q) use ($habilidades) {
            foreach ($habilidades as $habilidad) {
                $q->orWhereRaw("LOWER(habilidades) LIKE ?", ['%' . strtolower(trim($habilidad)) . '%']);
            }
        });
    }

    // 🧠 Normalizador de texto
    $normalizar = fn($texto) => Str::of($texto)->lower()->ascii()->trim()->__toString();

    // 🗣️ Lista oficial de idiomas válidos (puedes expandirla)
    $idiomas_validos = [
        'espanol' => 'Español',
        'ingles' => 'Inglés',
        'frances' => 'Francés',
        'aleman' => 'Alemán',
        'portugues' => 'Portugués',
        'italiano' => 'Italiano',
        'japones' => 'Japonés',
    ];

    // 🚀 Obtener resultados base
    $cvs = $query->get();

    // 🔎 Filtro por idiomas (en PHP, flexible y preciso)
    if ($request->filled('idiomas')) {
        $idiomas_solicitados_raw = explode(',', $request->idiomas);

        // Convertir a claves normalizadas y filtrar solo válidos
        $idiomas_buscados = collect($idiomas_solicitados_raw)
            ->map($normalizar)
            ->filter(fn($idioma) => isset($idiomas_validos[$idioma]))
            ->map(fn($clave) => $idiomas_validos[$clave])
            ->values()
            ->toArray();

        $cvs = $cvs->filter(function ($cv) use ($idiomas_buscados, $normalizar) {
            $idiomas_cv = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas ?? '[]', true);

            if (!is_array($idiomas_cv)) return false;

            $idiomas_cv_norm = array_map($normalizar, $idiomas_cv);

            foreach ($idiomas_buscados as $idioma) {
                if (in_array($normalizar($idioma), $idiomas_cv_norm)) {
                    return true;
                }
            }
            return false;
        })->values();
    }

    // 📦 Respuesta final (máximo 10 resultados)
    return response()->json($cvs->take(10));
});










