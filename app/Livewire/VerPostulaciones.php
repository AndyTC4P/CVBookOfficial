<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vacante;

class VerPostulaciones extends Component
{
    public $vacante;

    public function mount($id)
    {
        $this->vacante = Vacante::with('postulaciones.cv', 'postulaciones.usuario')->findOrFail($id);
    }

   public function render()
{
    return view('livewire.ver-postulaciones', [
        'postulaciones' => $this->vacante->postulaciones
    ])->layout('layouts.app'); // ✅ Esto carga el layout correcto
}

}


