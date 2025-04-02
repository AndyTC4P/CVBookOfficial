<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Nombre;

class FormularioNombre extends Component
{
    public $nombre;

    public function guardar()
    {
        $this->validate([
            'nombre' => 'required|min:3',
        ]);

        Nombre::create(['nombre' => $this->nombre]);

        session()->flash('mensaje', 'Nombre guardado correctamente.');

        $this->nombre = ''; // Limpia el input
    }

    public function render()
    {
        return view('livewire.formulario-nombre');
    }
}

