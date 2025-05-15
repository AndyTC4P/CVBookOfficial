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

    public function mount()
    {
         
        if (!auth()->check() || auth()->user()->isUsuario()) {
            abort(403);
        }
  $this->categoria_profesion = ''; // ← Limpia cualquier valor previo
        $this->categorias = DB::table('cvs')
            ->select('categoria_profesion')
            ->distinct()
            ->whereNotNull('categoria_profesion')
            ->pluck('categoria_profesion')
            ->toArray();
             // Si ya hay una categoría cargada (por volver atrás), disparar consulta al renderizar
   
    }

public function render()
{
    logger('🎯 Filtro activo:', ['categoria_profesion' => $this->categoria_profesion]);

    if (!empty($this->categoria_profesion)) {
        $query = CV::query();

        $query->whereRaw('LOWER(categoria_profesion) = ?', [strtolower($this->categoria_profesion)]);

        if (Auth::user()->role === 'empresa') {
            $query->where('publicado', true);
        }

        $cvs = $query->get();
    } else {
        $cvs = collect();
    }

    return view('livewire.buscar-c-vs', [
        'cvs' => $cvs,
    ]);
}


}



