<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\EmpresaAprobadaMail;


class EmpresaController extends Controller
{
    public function aprobar(User $user)
{
    $user->status = 'aprobado';
    $user->save();

    Mail::to($user->email)->send(new EmpresaAprobadaMail($user));

    return back()->with('success', 'Empresa aprobada correctamente y correo enviado.');
}


    public function rechazar(User $user)
    {
        $user->status = 'rechazado';
        $user->save();

        return back()->with('error', 'Empresa rechazada.');
    }
}
