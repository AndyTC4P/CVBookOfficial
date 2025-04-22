<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CV;

class PdfCvController extends Controller
{
    public function export($slug)
    {
        $cv = CV::where('slug', $slug)->firstOrFail();

        // Usa la plantilla visual que tienes en resources/views/pdf/cv-template.blade.php
        $pdf = Pdf::loadView('pdf.cv-template', compact('cv'))
                  ->setPaper('A4', 'portrait');

        // Lo muestra directamente en el navegador
        return $pdf->stream('cv_' . $cv->nombre . '_' . $cv->apellido . '.pdf');
    }
}




