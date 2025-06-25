<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function eliminarUsuario($id)
    {
        if (auth()->id() == $id) {
            return back()->with('success', 'No puedes eliminarte a ti mismo.');
        }

        $usuario = User::findOrFail($id);
        $usuario->delete();

        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}
