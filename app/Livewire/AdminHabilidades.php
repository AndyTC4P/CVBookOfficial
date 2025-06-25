<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Habilidad;

class AdminHabilidades extends Component
{
    public $habilidades;

    public function mount()
    {
        $this->habilidades = Habilidad::orderByDesc('restringida')->orderBy('nombre')->get();
    }

    public function toggleRestriccion($id)
    {
        $habilidad = Habilidad::find($id);
        if ($habilidad) {
            $habilidad->restringida = !$habilidad->restringida;
            $habilidad->save();
            $this->habilidades = Habilidad::orderByDesc('restringida')->orderBy('nombre')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin-habilidades');
    }
}




