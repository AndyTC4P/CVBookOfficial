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
    public $favoritos_ids = [];
    public $mensaje = null;
    public $solo_favoritos = false;
    public $idiomas_disponibles = [];
public $idiomas_seleccionados = [];



    public function mount()
    {
        if (!auth()->check() || auth()->user()->isUsuario()) {
            abort(403);
        }

        $this->favoritos_ids = auth()->user()->favoritos->pluck('id')->toArray();
        $this->categoria_profesion = '';

        // Cargar categorías profesionales
        $this->categorias = DB::table('cvs')
            ->select('categoria_profesion')
            ->distinct()
            ->whereNotNull('categoria_profesion')
            ->pluck('categoria_profesion')
            ->toArray();

        // Cargar habilidades únicas
        $this->habilidades_disponibles = CV::whereNotNull('habilidades')->get()
            ->flatMap(function ($cv) {
                $habilidades = json_decode($cv->habilidades ?? '[]', true);
                return is_array($habilidades) ? $habilidades : [];
            })
            ->map(fn($h) => trim($h))
            ->unique()
            ->values()
            ->toArray();

            // Cargar idiomas disponibles desde los CVs
$this->idiomas_disponibles = CV::whereNotNull('idiomas')->get()
    ->flatMap(function ($cv) {
        $idiomas = json_decode($cv->idiomas ?? '[]', true);
        return is_array($idiomas) ? $idiomas : [];
    })
    ->map(fn($i) => trim($i))
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

        // Filtro por categoría
        if (!empty($this->categoria_profesion)) {
            $query->whereRaw('LOWER(TRIM(categoria_profesion)) = ?', [trim(strtolower($this->categoria_profesion))]);
        }

        // Solo públicos para empresa
        if (Auth::user()->role === 'empresa') {
            $query->where('publico', true);
        }

       $cvs = $query->get();

// Si está activo "solo favoritos", filtrar los que estén en favoritos_ids
if ($this->solo_favoritos && count($this->favoritos_ids)) {
    $cvs = $cvs->filter(fn($cv) => in_array($cv->id, $this->favoritos_ids))->values();
}


        // Filtro por habilidades
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
            })->values();
        }
        // Filtro por idiomas en PHP
if (!empty($this->idiomas_seleccionados)) {
    $cvs = $cvs->filter(function ($cv) {
        $idiomasCV = json_decode($cv->idiomas ?? '[]', true);

        if (!is_array($idiomasCV)) {
            return false;
        }

        $idiomasCVNormalizados = array_map(fn($i) => trim(strtolower($i)), $idiomasCV);

        // Retornar solo si TODOS los idiomas seleccionados están en el CV
        foreach ($this->idiomas_seleccionados as $idiomaBuscado) {
            if (!in_array(trim(strtolower($idiomaBuscado)), $idiomasCVNormalizados)) {
                return false; // Si falta uno, no pasa el filtro
            }
        }

        return true; // Todos los idiomas están presentes
    })->values();
}



        return view('livewire.buscar-c-vs', [
            'cvs' => $cvs,
        ]);
    }

    public function toggleFavorito($cvId)
    {
        $user = auth()->user();

        if (in_array($cvId, $this->favoritos_ids)) {
            $user->favoritos()->detach($cvId);
            $this->favoritos_ids = array_diff($this->favoritos_ids, [$cvId]);
            $this->mensaje = 'CV eliminado de favoritos.';
        } else {
            $user->favoritos()->attach($cvId);
            $this->favoritos_ids[] = $cvId;
            $this->mensaje = 'CV guardado como favorito.';
        }
    }
}





