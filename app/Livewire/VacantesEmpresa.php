<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vacante;
use Illuminate\Support\Facades\Auth;

class VacantesEmpresa extends Component
{
    public $vacantes;
    public $titulo, $descripcion, $categoria, $ubicacion, $modalidad, $tipo_contrato;
    public $modo_edicion = false;
    public $vacante_id;

    public function mount()
    {
        if (!auth()->check() || auth()->user()->role !== 'empresa') {
            abort(403);
        }

        $this->vacantes = Vacante::where('empresa_id', Auth::id())->latest()->get();
    }

    public function save()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|min:10',
        ]);

        Vacante::create([
            'empresa_id' => Auth::id(),
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'ubicacion' => $this->ubicacion,
            'modalidad' => $this->modalidad,
            'tipo_contrato' => $this->tipo_contrato,
        ]);

        $this->resetFields();
        $this->vacantes = Vacante::where('empresa_id', Auth::id())->latest()->get();
    }

    public function edit($id)
    {
        $vacante = Vacante::findOrFail($id);
        $this->vacante_id = $id;
        $this->titulo = $vacante->titulo;
        $this->descripcion = $vacante->descripcion;
        $this->categoria = $vacante->categoria;
        $this->ubicacion = $vacante->ubicacion;
        $this->modalidad = $vacante->modalidad;
        $this->tipo_contrato = $vacante->tipo_contrato;
        $this->modo_edicion = true;
    }

    public function update()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|min:10',
        ]);

        $vacante = Vacante::findOrFail($this->vacante_id);
        $vacante->update([
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'ubicacion' => $this->ubicacion,
            'modalidad' => $this->modalidad,
            'tipo_contrato' => $this->tipo_contrato,
        ]);

        $this->resetFields();
        $this->vacantes = Vacante::where('empresa_id', Auth::id())->latest()->get();
        $this->modo_edicion = false;
    }

    public function delete($id)
    {
        Vacante::findOrFail($id)->delete();
        $this->vacantes = Vacante::where('empresa_id', Auth::id())->latest()->get();
    }

    public function resetFields()
    {
        $this->titulo = '';
        $this->descripcion = '';
        $this->categoria = '';
        $this->ubicacion = '';
        $this->modalidad = '';
        $this->tipo_contrato = '';
        $this->vacante_id = null;
        $this->modo_edicion = false;
    }

public function render()
{
    return view('livewire.vacantes-empresa', [
        'vacantes' => $this->vacantes
    ])->layout('layouts.app');
}


}

