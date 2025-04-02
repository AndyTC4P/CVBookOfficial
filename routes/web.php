<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;
use Illuminate\Support\Facades\Auth;

// Página de bienvenida
Route::view('/', 'welcome');

// Página principal del usuario autenticado (Menú Principal)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Página del perfil del usuario
Route::view('profile', 'profile')
    ->middleware(['auth']) // Solo accesible si el usuario ha iniciado sesión
    ->name('profile');

// 🔹 RUTAS PARA GESTIONAR CVs 🔹

// Muestra el formulario para crear un nuevo CV
Route::get('/cv/create', [CVController::class, 'create'])
    ->middleware(['auth']) // Solo accesible para usuarios autenticados
    ->name('cv.create');

// Muestra todos los CVs del usuario autenticado
Route::get('/cv', [CVController::class, 'index'])
    ->middleware(['auth']) // Protegido para que solo el usuario vea sus propios CVs
    ->name('cv.index');

// Muestra un CV en particular (puede ser público o privado)
Route::get('/cv/{id}', [CVController::class, 'show'])
    ->name('cv.show');

// Muestra el formulario para editar un CV específico
Route::get('/cv/{id}/edit', [CVController::class, 'edit'])
    ->middleware(['auth']) // Solo el dueño del CV puede acceder a esta ruta
    ->name('cv.edit');

// Actualiza un CV con la información editada
Route::put('/cv/{id}', [CVController::class, 'update'])
    ->middleware(['auth'])
    ->name('cv.update');

    Route::delete('/cv/{id}', [CVController::class, 'destroy'])->name('cv.destroy');

// Incluye las rutas de autenticación generadas por Laravel Breeze/Jetstream
require __DIR__.'/auth.php';

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
