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




Route::get('/admin/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
       $users = User::all();
$cvs = CV::latest()->get();
$empresasPendientes = User::where('role', 'empresa')->where('status', 'pendiente')->get();

return view('admin.dashboard', compact('users', 'cvs', 'empresasPendientes'));

    }

    abort(403, 'No autorizado');
})->middleware('auth')->name('admin.dashboard');


// Página de bienvenida
Route::view('/', 'welcome');

// Página principal del usuario autenticado (Menú Principal)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Página del perfil del usuario
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// 🔹 RUTAS PARA GESTIONAR CVs 🔹

// Muestra el formulario para crear un nuevo CV
// (¡IMPORTANTE! Esta ruta debe ir antes que /cv/{slug})
Route::get('/cv/create', [CVController::class, 'create'])
    ->middleware(['auth'])
    ->name('cv.create');

// Muestra todos los CVs del usuario autenticado
Route::get('/cv', [CVController::class, 'index'])
    ->middleware(['auth'])
    ->name('cv.index');

// Mostrar un CV específico por su slug
Route::get('/cv/{slug}', [CVController::class, 'show'])
    ->name('cv.show');

// Mostrar formulario para editar un CV por slug
Route::get('/cv/{slug}/edit', [CVController::class, 'edit'])
    ->middleware(['auth'])
    ->name('cv.edit');

// Actualizar un CV por slug
Route::put('/cv/{slug}', [CVController::class, 'update'])
    ->middleware(['auth'])
    ->name('cv.update');

// Eliminar un CV por slug
Route::delete('/cv/{slug}', [CVController::class, 'destroy'])
    ->name('cv.destroy');

// Rutas de autenticación generadas por Breeze o Jetstream
require __DIR__.'/auth.php';

// Cierre de sesión manual
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::view('/faq', 'faq')->name('faq');
Route::view('/terminos', 'terms')->name('terms');
Route::get('/cv/demo/pdf', function () {
    $pdf = Pdf::loadView('pdf.plantilla-demo');
    return $pdf->stream('cv-demo.pdf');
})->name('cv.demo.pdf');
Route::get('/cv/{slug}/pdf', [PdfCvController::class, 'export'])->name('cv.pdf');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/busqueda-cvs', function () {
        return view('admin.busqueda-cvs');
    })->name('admin.busqueda-cvs');
});
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

Route::get('/empresa/chat-demo', function () {
    return view('empresa.chat-demo');
});
Route::view('/privacidad-sivi', 'privacy-sivi')->name('privacidad.sivi');
Route::post('/cv/{cv}/favorito-toggle', [CVController::class, 'toggleFavorito'])->name('cv.favorito.toggle');
Route::get('/', function () {
    return redirect()->away('https://www.grupofazit.com/cvbook');
});
Route::get('/cv/{slug}/word', [WordCvController::class, 'export'])->name('cv.word');
Route::view('/privacidad', 'politica')->name('politica.privacidad');
Route::get('/registro-empresa', [EmpresaRegisterController::class, 'create'])->name('empresa.registro');
Route::post('/registro-empresa', [EmpresaRegisterController::class, 'store'])->name('empresa.registrar');
Route::middleware(['auth', EmpresaAprobada::class])->group(function () {
    Route::get('/admin/busqueda-cvs', function () {
        return view('admin.busqueda-cvs');
    })->name('admin.busqueda-cvs');
});
// Aprobación de empresas por el admin
Route::middleware('auth')->group(function () {
    Route::post('/admin/empresas/{user}/aprobar', [EmpresaController::class, 'aprobar'])->name('admin.empresas.aprobar');
    Route::post('/admin/empresas/{user}/rechazar', [EmpresaController::class, 'rechazar'])->name('admin.empresas.rechazar');
});
Route::get('/empresa/esperando-aprobacion', function () {
    return view('empresa.esperando-aprobacion');
})->middleware('auth')->name('empresa.esperando');
Route::delete('/admin/eliminar-usuario/{id}', [AdminController::class, 'eliminarUsuario'])
    ->middleware(['auth']) // Aquí eliminamos 'admin'
    ->name('admin.eliminarUsuario');



