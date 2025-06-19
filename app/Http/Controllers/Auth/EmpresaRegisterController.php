<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        ]);

        User::create([
            'name' => $request->nombre_contacto,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'empresa',
            'status' => 'pendiente',
        ]);

        return redirect()->route('login')->with('status', 'Registro enviado. Un administrador revisará tu solicitud.');
    }
}

