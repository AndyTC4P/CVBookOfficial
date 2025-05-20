<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuscarCVs extends Component
{
    public $categoria_profesion = '';
    public $categorias = [];
    public $habilidades_seleccionadas = [];
    public $habilidades_disponibles = [];

    public function mount()
    {
        if (!auth()->check() || auth()->user()->isUsuario()) {
            abort(403);
        }

        $this->categoria_profesion = '';

        // Cargar categorías profesionales disponibles
        $this->categorias = DB::table('cvs')
            ->select('categoria_profesion')
            ->distinct()
            ->whereNotNull('categoria_profesion')
            ->pluck('categoria_profesion')
            ->toArray();

        // Cargar habilidades disponibles desde los CVs
        $this->habilidades_disponibles = CV::whereNotNull('habilidades')->get()
            ->flatMap(function ($cv) {
                $habilidades = json_decode($cv->habilidades ?? '[]', true);
                return is_array($habilidades) ? $habilidades : [];
            })
            ->map(fn($h) => trim($h))
            ->unique()
            ->values()
            ->toArray();
    }

   public function render()
{
    logger('🎯 Filtros activos:', [
        'categoria_profesion' => $this->categoria_profesion,
        'habilidades_seleccionadas' => $this->habilidades_seleccionadas,
    ]);

    $query = CV::query();

    // Filtro por categoría profesional
    if (!empty($this->categoria_profesion)) {
        $query->whereRaw('LOWER(TRIM(categoria_profesion)) = ?', [trim(strtolower($this->categoria_profesion))]);
    }

    // Filtro para empresas: solo CVs públicos
    if (Auth::user()->role === 'empresa') {
        $query->where('publicado', true);
    }

    // Obtener los CVs base
    $cvs = $query->get();

    // Filtro por habilidades en PHP
    if (!empty($this->habilidades_seleccionadas)) {
        $cvs = $cvs->filter(function ($cv) {
            $habilidadesCV = json_decode($cv->habilidades ?? '[]', true);

            if (!is_array($habilidadesCV)) {
                return false;
            }

            foreach ($this->habilidades_seleccionadas as $habBuscada) {
                foreach ($habilidadesCV as $habCV) {
                    if (trim(strtolower($habBuscada)) === trim(strtolower($habCV))) {
                        return true;
                    }
                }
            }

            return false;
        })->values(); // importante para resetear índices
    }

    return view('livewire.buscar-c-vs', [
        'cvs' => $cvs,
    ]);
}

}




