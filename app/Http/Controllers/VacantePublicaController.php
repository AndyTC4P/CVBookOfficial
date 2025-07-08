<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacante;

class VacantePublicaController extends Controller
{
    public function ver($slug)
    {
        $vacante = Vacante::where('slug', $slug)->firstOrFail();
        return view('vacantes.publica', compact('vacante'));
    }
}

