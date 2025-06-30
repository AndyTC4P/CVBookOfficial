<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Habilidad;

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
    public $mostrarResultados = false;

    public function mount()
    {
        if (!auth()->check() || auth()->user()->isUsuario()) {
            abort(403);
        }

        $this->favoritos_ids = auth()->user()->favoritos->pluck('id')->toArray();
        $this->categoria_profesion = '';

        $this->categorias = DB::table('cvs')
            ->select('categoria_profesion')
            ->distinct()
            ->whereNotNull('categoria_profesion')
            ->pluck('categoria_profesion')
            ->toArray();

        $habilidadesRestringidas = Habilidad::where('restringida', true)
            ->pluck('nombre')
            ->map(fn($h) => strtolower(trim($h)))
            ->toArray();

        $this->habilidades_disponibles = CV::whereNotNull('habilidades')->get()
            ->flatMap(function ($cv) {
                $habilidades = json_decode($cv->habilidades ?? '[]', true);
                return is_array($habilidades) ? $habilidades : [];
            })
            ->map(fn($h) => trim($h))
            ->reject(fn($h) => in_array(strtolower($h), $habilidadesRestringidas))
            ->unique()
            ->values()
            ->toArray();

        $this->idiomas_disponibles = CV::whereNotNull('idiomas')->get()
            ->flatMap(function ($cv) {
                $idiomas = json_decode($cv->idiomas ?? '[]', true);
                return collect($idiomas)
                    ->pluck('nombre')
                    ->filter()
                    ->map(fn($nombre) => trim($nombre));
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();
    }

    public function aplicarFiltros()
    {
        $this->mostrarResultados = true;
    }
    public function reiniciarFiltros()
{
    $this->categoria_profesion = '';
    $this->habilidades_seleccionadas = [];
    $this->idiomas_seleccionados = [];
    $this->solo_favoritos = false;
    $this->mostrarResultados = false;
}


    public function render()
    {
        logger('🎯 Filtros activos:', [
            'categoria_profesion' => $this->categoria_profesion,
            'habilidades_seleccionadas' => $this->habilidades_seleccionadas,
        ]);

        $query = CV::query();

        if (Auth::user()->role === 'empresa') {
            $query->where('publico', true);
        }

        if (!empty($this->categoria_profesion)) {
            $query->whereRaw('LOWER(TRIM(categoria_profesion)) = ?', [trim(strtolower($this->categoria_profesion))]);
        }

        $cvs = $query->get();

        if ($this->solo_favoritos && count($this->favoritos_ids)) {
            $cvs = $cvs->filter(fn($cv) => in_array($cv->id, $this->favoritos_ids))->values();
        }

        if (!empty($this->habilidades_seleccionadas)) {
            $habilidadesRestringidas = Habilidad::where('restringida', true)
                ->pluck('nombre')
                ->map(fn($h) => strtolower(trim($h)))
                ->toArray();

            $habilidadesPermitidas = collect($this->habilidades_seleccionadas)
                ->filter(fn($h) => !in_array(strtolower(trim($h)), $habilidadesRestringidas))
                ->map(fn($h) => strtolower(trim($h)))
                ->toArray();

            $cvs = $cvs->filter(function ($cv) use ($habilidadesPermitidas) {
                $habilidadesCV = json_decode($cv->habilidades ?? '[]', true);
                if (!is_array($habilidadesCV)) return false;

                $habilidadesCVNormalizadas = array_map(fn($h) => strtolower(trim($h)), $habilidadesCV);

                return count(array_intersect($habilidadesPermitidas, $habilidadesCVNormalizadas)) === count($habilidadesPermitidas);
            })->values();
        }

        if (!empty($this->idiomas_seleccionados)) {
            $cvs = $cvs->filter(function ($cv) {
                $idiomasCV = json_decode($cv->idiomas ?? '[]', true);
                if (!is_array($idiomasCV)) return false;

                $idiomasCVNormalizados = collect($idiomasCV)
                    ->pluck('nombre')
                    ->filter()
                    ->map(fn($nombre) => trim(strtolower($nombre)))
                    ->toArray();

                foreach ($this->idiomas_seleccionados as $idiomaBuscado) {
                    if (!in_array(trim(strtolower($idiomaBuscado)), $idiomasCVNormalizados)) {
                        return false;
                    }
                }
                return true;
            })->values();
        }

        return view('livewire.buscar-c-vs', [
            'cvs' => ($this->mostrarResultados || $this->solo_favoritos) ? $cvs : collect(),
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
    public function getFiltrosActivosProperty()
{
    return $this->categoria_profesion 
        || !empty($this->habilidades_seleccionadas) 
        || !empty($this->idiomas_seleccionados);
}

}





