<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Faq;
use App\Http\Controllers\PdfCvController;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Models\CV;
use Illuminate\Http\Request;
use App\Http\Controllers\WordCvController;
use App\Http\Controllers\Auth\EmpresaRegisterController;
use App\Http\Middleware\EmpresaAprobada;
use App\Http\Controllers\Admin\EmpresaController;
use Illuminate\Support\Str;
use App\Livewire\DetalleVacante;
use App\Livewire\VerPostulaciones;
use App\Livewire\VacantesEmpresa;
use App\Livewire\ListaVacantes;
use App\Http\Controllers\VacantePublicaController;



// 🧠 Panel de administración
Route::get('/admin/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        $users = User::all();
        $cvs = CV::latest()->get();
        $empresasPendientes = User::where('role', 'empresa')->where('status', 'pendiente')->get();
        return view('admin.dashboard', compact('users', 'cvs', 'empresasPendientes'));
    }
    abort(403, 'No autorizado');
})->middleware('auth')->name('admin.dashboard');

// 🏠 Página de bienvenida
Route::view('/', 'welcome');

// 🧑‍💼 Dashboard del usuario autenticado
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🧾 Perfil del usuario
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// 🔹 RUTAS PARA GESTIONAR CVs 🔹

// 📝 Formulario para crear CV
Route::get('/cv/create', [CVController::class, 'create'])
    ->middleware(['auth'])
    ->name('cv.create');

// 📄 Listar CVs del usuario
Route::get('/cv', [CVController::class, 'index'])
    ->middleware(['auth'])
    ->name('cv.index');

// 🔍 Ver CV por slug
Route::get('/cv/{slug}', [CVController::class, 'show'])
    ->name('cv.show');

// ✏️ Editar CV
Route::get('/cv/{slug}/edit', [CVController::class, 'edit'])
    ->middleware(['auth'])
    ->name('cv.edit');

// 💾 Actualizar CV
Route::put('/cv/{slug}', [CVController::class, 'update'])
    ->middleware(['auth'])
    ->name('cv.update');

// ❌ Eliminar CV
Route::delete('/cv/{slug}', [CVController::class, 'destroy'])
    ->name('cv.destroy');

// 🔐 Rutas de autenticación
require __DIR__.'/auth.php';

// 🔓 Logout manual
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// 📚 Página de preguntas frecuentes
Route::view('/faq', 'faq')->name('faq');

// 📄 Términos y condiciones
Route::view('/terminos', 'terms')->name('terms');

// 📥 Demo PDF
Route::get('/cv/demo/pdf', function () {
    $pdf = Pdf::loadView('pdf.plantilla-demo');
    return $pdf->stream('cv-demo.pdf');
})->name('cv.demo.pdf');

// 📥 Exportar CV en PDF
Route::get('/cv/{slug}/pdf', [PdfCvController::class, 'export'])->name('cv.pdf');

// 🔁 Cambiar rol desde admin
Route::post('/admin/cambiar-rol/{user}', function (Request $request, User $user) {
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        abort(403, 'No autorizado');
    }

    $request->validate([
        'nuevo_rol' => 'required|in:usuario,empresa,admin',
    ]);

    $user->role = $request->input('nuevo_rol');
    $user->save();

    return redirect()->route('admin.dashboard')->with('success', 'Rol actualizado correctamente.');
})->middleware('auth')->name('admin.cambiarRol');

// 💬 Chat demo para empresas
Route::get('/empresa/chat-demo', function () {
    return view('empresa.chat-demo');
});

// 🔏 Política de privacidad extendida
Route::view('/privacidad-sivi', 'privacy-sivi')->name('privacidad.sivi');

// ⭐ Marcar CV como favorito
Route::post('/cv/{cv}/favorito-toggle', [CVController::class, 'toggleFavorito'])->name('cv.favorito.toggle');

// 🌐 Redirección a sitio oficial
Route::get('/', function () {
    return redirect()->away('https://www.grupofazit.com/cvbook');
});

// 📥 Exportar CV en Word
Route::get('/cv/{slug}/word', [WordCvController::class, 'export'])->name('cv.word');

// 🔒 Política de privacidad
Route::view('/privacidad', 'politica')->name('politica.privacidad');

// 🏢 Registro de empresas
Route::get('/registro-empresa', [EmpresaRegisterController::class, 'create'])->name('empresa.registro');
Route::post('/registro-empresa', [EmpresaRegisterController::class, 'store'])->name('empresa.registrar');

// ✅ Ruta AJAX para saber si la empresa ya fue aprobada
Route::match(['get', 'post'], '/empresa/check-aprobacion', function () {
    if (auth()->check() && auth()->user()->role === 'empresa') {
        return response()->json([
            'aprobada' => auth()->user()->status === 'aprobado',
        ]);
    }
    return response()->json(['aprobada' => false], 401);
})->middleware('auth')->name('check.aprobacion');

// 🧾 Aprobación de empresas por el admin
Route::middleware('auth')->group(function () {
    Route::post('/admin/empresas/{user}/aprobar', [EmpresaController::class, 'aprobar'])->name('admin.empresas.aprobar');
    Route::post('/admin/empresas/{user}/rechazar', [EmpresaController::class, 'rechazar'])->name('admin.empresas.rechazar');
});

// 🟡 Vista de espera para empresas NO aprobadas
Route::get('/empresa/esperando-aprobacion', function () {
    if (auth()->check() && auth()->user()->role === 'empresa') {
        if (auth()->user()->status === 'aprobado') {
            return redirect()->route('admin.busqueda-cvs');
        }
        return view('empresa.esperando-aprobacion');
    }
    return redirect()->route('login');
})->middleware('auth')->name('empresa.esperando');

// 🗑 Eliminar usuario desde admin
Route::delete('/admin/eliminar-usuario/{id}', [AdminController::class, 'eliminarUsuario'])
    ->middleware(['auth']) // Eliminamos 'admin' para permitir validaciones internas
    ->name('admin.eliminarUsuario');

// 🔎 Empresas aprobadas con email verificado pueden buscar CVs
Route::middleware(['auth', 'verified', EmpresaAprobada::class])->group(function () {
    Route::get('/admin/busqueda-cvs', function () {
        return view('admin.busqueda-cvs');
    })->name('admin.busqueda-cvs');
});

Route::get('/gpt-cvs', function (Request $request) {
    $query = CV::query()->where('publico', 1);

    if ($request->filled('categoria')) {
        $query->where('categoria_profesion', $request->categoria);
    }

    if ($request->filled('habilidades')) {
        $habilidades = explode(',', $request->habilidades);
        $query->where(function ($q) use ($habilidades) {
            foreach ($habilidades as $h) {
                $q->orWhereRaw('LOWER(habilidades) LIKE ?', ['%' . strtolower(trim($h)) . '%']);
            }
        });
    }

    $normalizar = fn($texto) => Str::of($texto)->lower()->ascii()->trim()->__toString();

    $idiomas_validos = [
        'espanol' => 'Español', 'ingles' => 'Inglés',
        'frances' => 'Francés', 'aleman' => 'Alemán',
        'portugues' => 'Portugués', 'italiano' => 'Italiano',
        'japones' => 'Japonés',
    ];

    $cvs = $query->get();

    if ($request->filled('idiomas')) {
        $idiomas_buscados = collect(explode(',', $request->idiomas))
            ->map($normalizar)
            ->filter(fn($i) => isset($idiomas_validos[$i]))
            ->map(fn($k) => $idiomas_validos[$k])
            ->toArray();

        $cvs = $cvs->filter(function ($cv) use ($idiomas_buscados, $normalizar) {
            $idiomas_cv = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas ?? '[]', true);
            if (!is_array($idiomas_cv)) return false;
            $idiomas_cv_norm = array_map($normalizar, $idiomas_cv);
            foreach ($idiomas_buscados as $idioma) {
                if (in_array($normalizar($idioma), $idiomas_cv_norm)) return true;
            }
            return false;
        })->values();
    }

    // 👉 Vista simulada como HTML con <script> JSON que ChatGPT puede leer
    return response("
        <html><body>
        <script type='application/json'>" . json_encode($cvs->take(10)) . "</script>
        </body></html>
    ", 200)->header('Content-Type', 'text/html');
});
Route::get('/vacantes/{id}', DetalleVacante::class)->name('vacantes.detalle');
Route::get('/empresa/vacantes/{id}/postulaciones', VerPostulaciones::class)
    ->middleware(['auth']) // ✅ solo auth, SIN 'empresa.only'
    ->name('empresa.vacantes.postulaciones');
    
Route::get('/empresa/vacantes', VacantesEmpresa::class)
    ->middleware(['auth', 'verified']) // <- agrega esto
    ->name('empresa.vacantes');
    Route::get('/vacantes', ListaVacantes::class)
    ->middleware(['auth', 'verified']) // si usas verificación por correo
    ->name('vacantes.lista');
    Route::get('/vacante/{slug}', [VacantePublicaController::class, 'ver'])->name('vacante.publica');
Route::get('/vacante/{slug}', [VacantePublicaController::class, 'ver'])->name('vacante.publica');







