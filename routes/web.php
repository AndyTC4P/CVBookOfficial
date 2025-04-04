<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Faq;

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
