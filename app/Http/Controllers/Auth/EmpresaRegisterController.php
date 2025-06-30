<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class EmpresaRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-empresa');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre_empresa' => 'required|string|max:255',
        'nombre_contacto' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'politica_privacidad' => 'accepted',
        'g-recaptcha-response' => 'required|captcha',
    ]);

    $user = User::create([
        'name' => $request->nombre_contacto,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'empresa',
        'status' => null, // aún no se valida por el admin
    ]);
     // ✅ Iniciar sesión automáticamente para que se redirija a /verify-email
    Auth::login($user);

    // Enviar email de verificación
    $user->sendEmailVerificationNotification();

    return redirect()->route('verification.notice');

}

}


