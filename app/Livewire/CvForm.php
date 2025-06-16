<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CvForm extends Component
{
    use WithFileUploads;

    public $cv_id;
    public $nombre;
    public $apellido;
    public string $categoria_profesion = '';
    public string $titulo_manual = '';
    public array $profesionesPorCategoria = [];
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
    public $idioma_otro = '';
    public $publico = false;
    public $modo = 'crear';

    public bool $cvGuardado = false;
    public bool $imagenSubida = false;

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'categoria_profesion' => 'required|string|max:255',
            'titulo_manual' => 'required|string|max:255',
            'perfil' => 'required|string|max:390',
            'imagen' => $this->modo === 'crear' ? 'required|image|max:2048' : 'nullable|image|max:2048',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'pais' => 'nullable|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'habilidades' => 'nullable|array|min:5',
            'habilidades.*' => 'required|string|max:35',
            'idiomas' => 'nullable|array',
            'idiomas.*' => 'required|string|max:100',
            'idioma_otro' => 'nullable|string|max:100',
            'experiencia' => 'nullable|array',
            'experiencia.*.empresa' => 'required|string|max:255',
            'experiencia.*.puesto' => 'required|string|max:255',
            'experiencia.*.inicio' => 'required|date',
            'experiencia.*.fin' => 'nullable|date|after_or_equal:experiencia.*.inicio',
            'experiencia.*.tareas' => 'nullable|array',
            'experiencia.*.tareas.*' => 'nullable|string|max:250',
            'educacion' => 'nullable|array',
            'educacion.*.universidad' => 'required|string|max:255',
            'educacion.*.carrera' => 'required|string|max:255',
            'educacion.*.inicio' => 'required|date',
            'educacion.*.fin' => 'nullable|date|after_or_equal:educacion.*.inicio',
            'publico' => 'boolean',
        ];
    }

    protected $messages = [
        'categoria_profesion.required' => 'Debe seleccionar una categoría profesional.',
        'titulo_manual.required' => 'Debe escribir su profesión o título.',
        'correo.required' => 'El campo Correo Electrónico es obligatorio.',
        'telefono.required' => 'El campo Número de Contacto es obligatorio.',
        'direccion.required' => 'El campo Dirección es obligatorio.',
        'ciudad.required' => 'El campo Ciudad es obligatorio.',
        'habilidades.min' => 'Debe ingresar al menos 5 habilidades.',
        'perfil.max' => 'El campo Perfil Profesional no debe superar los 390 caracteres.',
        'imagen.required' => 'Debe subir una imagen de perfil para continuar.',
        'imagen.image' => 'El archivo debe ser una imagen válida.',
        'imagen.max' => 'La imagen no debe superar los 2MB.',
    ];

    public function mount($cv = null)
    {
        $this->profesionesPorCategoria = [
            'Tecnología e Informática',
            'Salud',
            'Educación',
            'Ingenierías',
            'Administración y Negocios',
            'Derecho y Ciencias Jurídicas',
            'Ciencias Sociales',
            'Marketing y Ventas',
            'Arte y Creatividad',
            'Deportes y Recreación',
            'Comunicación y Medios',
            'Construcción y Mantenimiento',
            'Transporte y Logística',
            'Servicios Personales',
            'Agroindustria y Medio Ambiente',
            'Estudiante',
            'Otro'
        ];

        if ($cv) {
            $this->cv_id = $cv->id;
            $this->nombre = $cv->nombre;
            $this->apellido = $cv->apellido;
            $this->categoria_profesion = $cv->categoria_profesion ?? '';
            $this->titulo_manual = $cv->titulo ?? '';
            $this->perfil = $cv->perfil;
            $this->correo = $cv->correo;
            $this->telefono = $cv->telefono;
            $this->direccion = $cv->direccion;
            $this->pais = $cv->pais;
            $this->ciudad = $cv->ciudad;
            $this->habilidades = is_array($cv->habilidades) ? $cv->habilidades : json_decode($cv->habilidades, true) ?? [];

            $idiomasCargados = is_array($cv->idiomas) ? $cv->idiomas : json_decode($cv->idiomas, true) ?? [];
            $idiomasPredefinidos = ['Español', 'Inglés', 'Francés', 'Alemán', 'Portugués', 'Italiano'];

            $this->idiomas = array_filter($idiomasCargados, fn($i) => in_array($i, $idiomasPredefinidos));
            $this->idioma_otro = collect($idiomasCargados)->diff($idiomasPredefinidos)->first() ?? '';

            $this->publico = (bool) $cv->publico;

            $this->experiencia = is_array($cv->experiencia)
                ? $cv->experiencia
                : json_decode($cv->experiencia, true) ?? [];

            $this->educacion = is_array($cv->educacion)
                ? $cv->educacion
                : json_decode($cv->educacion, true) ?? [];

            $this->modo = 'editar';
        }

        logger('📌 CATEGORÍA precargada:', [$this->categoria_profesion]);
    }

    public function save()
    {
        $this->validate();
        $this->cvGuardado = true;

        $imagenPath = $this->imagen ? $this->imagen->store('imagenes_perfil', 'public') : null;

        $idiomas = $this->idiomas;
        if (!empty($this->idioma_otro)) {
            $idiomas[] = $this->idioma_otro;
        }

        $data = [
            'user_id' => Auth::id(),
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'titulo' => $this->titulo_manual,
            'categoria_profesion' => $this->categoria_profesion,
            'perfil' => $this->perfil,
            'imagen' => $imagenPath,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'pais' => $this->pais,
            'ciudad' => $this->ciudad,
            'habilidades' => json_encode($this->habilidades),
            'idiomas' => json_encode($idiomas),
            'experiencia' => json_encode($this->experiencia),
            'educacion' => json_encode($this->educacion),
            'publico' => $this->publico,
        ];

        if ($this->modo === 'crear') {
            $data['slug'] = Str::random(16);
            $cv = CV::create($data);
            return redirect()->route('cv.show', ['slug' => $cv->slug]);
        } else {
            $cv = CV::findOrFail($this->cv_id);
            $data['imagen'] = $imagenPath ?? $cv->imagen;
            $data['slug'] = $cv->slug;
            $cv->update($data);
            return redirect()->route('cv.index')->with('message', '✅ CV actualizado correctamente.');
        }
    }

    public function addExperience()
    {
        $this->experiencia[] = [
            'empresa' => '',
            'puesto' => '',
            'inicio' => '',
            'fin' => '',
            'tareas' => [''],
        ];
    }

    public function removeExperience($index)
    {
        unset($this->experiencia[$index]);
        $this->experiencia = array_values($this->experiencia);
    }

    public function agregarTarea($expIndex)
{
    // Asegura que 'tareas' sea un array antes de usar []
    if (!isset($this->experiencia[$expIndex]['tareas']) || !is_array($this->experiencia[$expIndex]['tareas'])) {
        $valorActual = $this->experiencia[$expIndex]['tareas'] ?? '';

        // Si había un string, lo convertimos en el primer elemento del array
        $this->experiencia[$expIndex]['tareas'] = $valorActual !== ''
            ? [$valorActual]
            : [];
    }

    // Ahora que es array, agregamos una nueva tarea
    $this->experiencia[$expIndex]['tareas'][] = '';
}


    public function eliminarTarea($expIndex, $tareaIndex)
    {
        unset($this->experiencia[$expIndex]['tareas'][$tareaIndex]);
        $this->experiencia[$expIndex]['tareas'] = array_values($this->experiencia[$expIndex]['tareas']);
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
        $this->imagenSubida = true;
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

    public function render()
    {
        return view('livewire.cv-form');
    }

    protected $listeners = ['actualizarTareas'];

    public function actualizarTareas($index, $contenido)
    {
        $this->experiencia[$index]['tareas'] = $contenido;
    }
}











