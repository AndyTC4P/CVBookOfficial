<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;

class CvForm extends Component
{
    use WithFileUploads;

    public $cv_id;
    public $nombre;
    public $apellido;
    public $titulo;
    public $perfil;
    public $imagen;
    public $correo;
    public $telefono;
    public $direccion;
    public $pais;
    public $ciudad;
    public $experiencia = [];
    public $educacion = [];
    public $habilidades = [];
    public $idiomas = [];
    public $publico = false;
    public $modo = 'crear'; // 'crear' o 'editar'

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'titulo' => 'nullable|string|max:255',
        'perfil' => 'nullable|string',
        'imagen' => 'nullable|image|max:2048',
        'correo' => 'nullable|email|max:255',
        'telefono' => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
        'pais' => 'nullable|string|max:100',
        'ciudad' => 'nullable|string|max:100',
        'habilidades' => 'nullable|array',
        'habilidades.*' => 'required|string|max:100',
        'idiomas' => 'nullable|array',
        'idiomas.*' => 'required|string|max:100',
        'experiencia' => 'nullable|array',
        'experiencia.*.empresa' => 'required|string|max:255',
        'experiencia.*.puesto' => 'required|string|max:255',
        'experiencia.*.inicio' => 'required|date',
        'experiencia.*.fin' => 'nullable|date|after_or_equal:experiencia.*.inicio',
        'educacion' => 'nullable|array',
        'educacion.*.universidad' => 'required|string|max:255',
        'educacion.*.carrera' => 'required|string|max:255',
        'educacion.*.inicio' => 'required|date',
        'educacion.*.fin' => 'nullable|date|after_or_equal:educacion.*.inicio',
        'publico' => 'boolean',
    ];

    public function mount($cv = null)
    {
        if ($cv) {
            $this->cv_id = $cv->id;
            $this->nombre = $cv->nombre;
            $this->apellido = $cv->apellido;
            $this->titulo = $cv->titulo;
            $this->perfil = $cv->perfil;
            $this->correo = $cv->correo;
            $this->telefono = $cv->telefono;
            $this->direccion = $cv->direccion;
            $this->pais = $cv->pais;
            $this->ciudad = $cv->ciudad;
            $this->habilidades = is_array($cv->habilidades) ? $cv->habilidades : json_decode($cv->habilidades, true) ?? [];
            $this->idiomas = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas, true) ?? [];
            $this->publico = (bool) $cv->publico;

            $this->experiencia = is_array($cv->experiencia)
                ? $cv->experiencia
                : json_decode($cv->experiencia, true) ?? [];

            $this->educacion = is_array($cv->educacion)
                ? $cv->educacion
                : json_decode($cv->educacion, true) ?? [];

            $this->modo = 'editar';
        }
    }

    public function save()
    {
        $this->validate();

        $imagenPath = $this->imagen ? $this->imagen->store('imagenes_perfil', 'public') : null;

        $data = [
            'user_id' => Auth::id(),
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'titulo' => $this->titulo,
            'perfil' => $this->perfil,
            'imagen' => $imagenPath,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'pais' => $this->pais,
            'ciudad' => $this->ciudad,
            'habilidades' => json_encode($this->habilidades),
            'idiomas' => json_encode($this->idiomas),
            'experiencia' => json_encode($this->experiencia),
            'educacion' => json_encode($this->educacion),
            'publico' => $this->publico,
        ];

        if ($this->modo === 'crear') {
            CV::create($data);
            return redirect()->route('cv.index')->with('message', '✅ CV creado correctamente.');
        } else {
            $cv = CV::findOrFail($this->cv_id);
            $data['imagen'] = $imagenPath ?? $cv->imagen;
            $cv->update($data);
            return redirect()->route('cv.index')->with('message', '✅ CV actualizado correctamente.');
        }
    }

    public function addExperience()
    {
        $this->experiencia[] = ['empresa' => '', 'puesto' => '', 'inicio' => '', 'fin' => '', 'tareas' => ''];
    }

    public function removeExperience($index)
    {
        unset($this->experiencia[$index]);
        $this->experiencia = array_values($this->experiencia);
    }

    public function addEducation()
    {
        $this->educacion[] = ['universidad' => '', 'carrera' => '', 'inicio' => '', 'fin' => ''];
    }

    public function removeEducation($index)
    {
        unset($this->educacion[$index]);
        $this->educacion = array_values($this->educacion);
    }

    public function updatedImagen()
    {
        $this->dispatch('imagenSubida');
    }

    public function render()
    {
        return view('livewire.cv-form');
    }
    public function addSkill()
{
    $this->habilidades[] = '';
}
public function removeSkill($index)
{
    unset($this->habilidades[$index]);
    $this->habilidades = array_values($this->habilidades);
}
}








