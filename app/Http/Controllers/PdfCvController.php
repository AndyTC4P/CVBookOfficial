<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CV;

class PdfCvController extends Controller
{
    public function export($slug)
    {
        $cv = CV::where('slug', $slug)->firstOrFail(); // 👈 sin with()

        $pdf = Pdf::loadView('pdf.cv', compact('cv'))
                  ->setPaper('A4', 'portrait');

                  return $pdf->stream('cv_'.$cv->nombre.'_'.$cv->apellido.'.pdf');

    }
}



