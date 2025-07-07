<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vacante;

class ListaVacantes extends Component
{
    public $vacantes = [];

    public function mount()
    {
        // Cargamos todas las vacantes ordenadas por fecha descendente
        $this->vacantes = Vacante::with('empresa')->latest()->get();
    }

    public function render()
    {
        return view('livewire.lista-vacantes')
            ->layout('layouts.app');
    }
}



