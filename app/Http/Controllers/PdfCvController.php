<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CV;

class PdfCvController extends Controller
{
    public function export($slug)
    {
        $cv = CV::with(['experiencias', 'estudios', 'habilidades', 'idiomas'])->where('slug', $slug)->firstOrFail();

        $pdf = Pdf::loadView('pdf.cv', compact('cv'))
                  ->setPaper('A4', 'portrait'); // Fuerza tamaño correcto y evita errores visuales

        return $pdf->download('cv_'.$cv->nombre.'_'.$cv->apellido.'.pdf');
    }
}


