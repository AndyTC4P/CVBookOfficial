<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class AsistenteEmpresa extends Component
{
    public $mensaje = '';
    public $resultados = [];
    public $cargando = false;

    public function buscar()
    {
        $this->cargando = true;

        // Simulador simple: si el mensaje contiene Laravel, busca eso
        $categoria = '';
        $habilidades = [];

        if (str_contains(strtolower($this->mensaje), 'diseñador')) {
            $categoria = 'Diseño gráfico';
        }
        if (str_contains(strtolower($this->mensaje), 'laravel')) {
            $habilidades[] = 'Laravel';
        }
        if (str_contains(strtolower($this->mensaje), 'canva')) {
            $habilidades[] = 'Canva';
        }

        // Llama a la API
        $response = Http::get('http://127.0.0.1:8000/api/cvs/demo', [
            'categoria' => $categoria,
            'habilidades' => implode(',', $habilidades)
        ]);

        $this->resultados = $response->json();
        $this->cargando = false;
    }

    public function render()
    {
        return view('livewire.asistente-empresa');
    }
}

