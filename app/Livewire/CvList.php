<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;

class CvList extends Component
{
    public $cvs;

    protected $listeners = [
        'cvCreated' => 'reloadCvs',
        'eliminarCv' => 'eliminarCv',
        'confirmarEliminacion' => 'confirmarEliminacion', 
    ];

    public function mount()
    {
        $this->cvs = CV::where('user_id', Auth::id())->latest()->get();
    }

    public function reloadCvs()
    {
        $this->cvs = CV::where('user_id', Auth::id())->latest()->get();
    }

    public function copiarEnlace($id)
    {
        $cv = CV::findOrFail($id);

        if (!$cv->publico) {
            session()->flash('error', 'Este CV es privado y no se puede compartir.');
            return;
        }

        $link = route('cv.show', $cv->id);
        $this->dispatch('copiar-enlace', $link);
    }

    public function eliminarCv($id)
    {
        $cv = CV::where('user_id', auth()->id())->findOrFail($id);
        $cv->delete();
    
        // Actualiza la lista
        $this->reloadCvs();
    
        session()->flash('message', '✅ CV eliminado correctamente.');
    }
    public function confirmarEliminacion($id)
{
    $this->dispatch('confirmarEliminacion', $id);
}

    public function render()
    {
        return view('livewire.cv-list');
    }
}







