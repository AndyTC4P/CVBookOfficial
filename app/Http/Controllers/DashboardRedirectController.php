<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->role === 'empresa') {
            return redirect()->route('buscar-cvs');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Para usuarios normales
        return view('dashboard');
    }
}


