<?php

namespace App\Livewire;

use App\Models\CV;
use Livewire\Component;
use App\Models\Vacante;
use App\Models\Postulacion;
use Illuminate\Support\Facades\Auth;

class DetalleVacante extends Component
{
    public $vacante;
    public $cv_seleccionado = null;
    public $ya_postulado = false;
    public $mensaje = null;

    public function mount($id)
    {
        $this->vacante = Vacante::with('empresa')->findOrFail($id);

        if (auth()->check()) {
            $this->ya_postulado = Postulacion::where('vacante_id', $id)
                ->where('usuario_id', Auth::id())
                ->exists();
        }
    }

    public function postularse()
    {
        if (!$this->cv_seleccionado) {
            $this->mensaje = '⚠️ Debes seleccionar un CV para postularte.';
            return;
        }

        if ($this->ya_postulado) {
            $this->mensaje = '❌ Ya te has postulado a esta vacante.';
            return;
        }

        Postulacion::create([
            'vacante_id' => $this->vacante->id,
            'usuario_id' => Auth::id(),
            'cv_id' => $this->cv_seleccionado,
        ]);

        $this->ya_postulado = true;
        $this->mensaje = '✅ Postulación enviada con éxito.';
    }

   public function render()
{
    $cvs = auth()->check()
        ? CV::where('user_id', Auth::id())->latest()->get()
        : collect();

    return view('livewire.detalle-vacante', [
        'cvs_disponibles' => $cvs,
    ])->layout('layouts.app'); // ✅ esta línea soluciona el error
}

}

