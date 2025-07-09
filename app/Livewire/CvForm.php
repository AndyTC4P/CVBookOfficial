<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use App\Models\Habilidad;

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
    public array $idiomas = [];
    public $publico = false;
    public $modo = 'crear';

    public bool $cvGuardado = false;
    public bool $imagenSubida = false;
    public array $idiomasDisponibles = [
    'Español', 'Inglés', 'Francés', 'Alemán', 'Italiano', 'Portugués',
    'Japonés', 'Chino', 'Coreano', 'Árabe', 'Ruso', 'Hindi',
    'Turco', 'Sueco', 'Noruego', 'Danés', 'Finés', 'Griego',
    'Hebreo', 'Polaco', 'Checo', 'Húngaro', 'Rumano', 'Búlgaro',
    'Tailandés', 'Vietnamita', 'Indonesio', 'Neerlandés', 'Ucraniano', 'Swahili'
];


    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'categoria_profesion' => 'required|string|max:255',
            'titulo_manual' => 'required|string|max:255',
            'perfil' => 'required|string|min:50|max:390',
           'imagen' => 'nullable|image|max:6144',
            'correo' => 'required|email|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'pais' => 'nullable|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'habilidades' => 'nullable|array',
            'habilidades.*' => 'required|string|max:35',
            'idiomas' => 'nullable|array',
            'idiomas.*.nombre' => 'required|string|max:100',
           'idiomas.*.nivel' => 'required|in:básico,intermedio,avanzado,fluido,business,nativo',
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
            'educacion.*.estado' => 'nullable|string|in:finalizado,en_progreso',
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
        'perfil.max' => 'El campo Perfil Profesional no debe superar los 390 caracteres.',
        'imagen.required' => 'Debe subir una imagen de perfil para continuar.',
        'imagen.image' => 'El archivo debe ser una imagen válida.',
        'imagen.max' => 'La imagen no debe superar los 6MB.',
        'perfil.min' => 'El campo Perfil Profesional debe tener al menos 50 caracteres.',
        'idiomas.*.nombre.required' => 'Debes seleccionar un idioma.',
    'idiomas.*.nombre.max' => 'El nombre del idioma no debe superar los 100 caracteres.',
    'idiomas.*.nivel.required' => 'Debes seleccionar el nivel para cada idioma.',
    'idiomas.*.nivel.in' => 'El nivel seleccionado no es válido.',

    ];

    public function mount($cv = null)
    {
       $this->profesionesPorCategoria = [
    'Administración y Finanzas',
    'Agroindustria y Veterinaria',
    'Artes Escénicas y Visuales',
    'Ciencia de Datos e Inteligencia Artificial',
    'Ciencias Ambientales',
    'Ciencias Sociales y Humanidades',
    'Cocina y Preparación de Alimentos',
    'Comunicaciones y Medios',
    'Construcción y Obras Civiles',
    'Contabilidad y Auditoría',
    'Derecho y Asistencia Legal',
    'Diseño Gráfico y Multimedios',
    'Diseño UX/UI',
    'Docencia Técnica y Capacitación',
    'Educación Inicial y Básica',
    'Educación Media y Universitaria',
    'Electricidad y Electrónica',
    'Estudiantes y Primer Empleo',
    'Fotografía y Producción Audiovisual',
    'Freelancers y Servicios Independientes',
    'Hospitalidad y Turismo',
    'Ingeniería',
    'Ingeniería en Sistemas',
    'Logística y Distribución',
    'Mantenimiento Industrial y Mecánica',
    'Marketing Digital',
    'Operaciones y Call Center',
    'Personas con Discapacidad o Reincorporación',
    'Producción y Manufactura',
    'Publicidad y Comunicación Visual',
    'Recursos Humanos',
    'Salud - Enfermería',
    'Salud - Medicina General',
    'Salud - Odontología',
    'Salud - Psicología',
    'Seguridad y Vigilancia',
    'Servicios Personales',
    'Soporte Técnico y Redes',
    'Tecnología y Desarrollo Web',
    'Transporte y Conducción',
    'Ventas y Atención al Cliente',
    'Otro',
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
            $this->idiomas = collect($idiomasCargados)
                ->filter(fn($i) => is_array($i) && isset($i['nombre'], $i['nivel']))
                ->values()
                ->toArray();

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

       $idiomasValidos = array_filter($this->idiomas, function ($idioma) {
    return !empty($idioma['nombre']) && !empty($idioma['nivel']);
});

$tieneLenguaMaterna = collect($idiomasValidos)->contains(function ($idioma) {
    return $idioma['nivel'] === 'nativo';
});

if (!$tieneLenguaMaterna) {
    $this->addError('idiomas', 'Debes seleccionar al menos un idioma con nivel "Lengua materna".');
    return;
}


        $habilidadesRestringidas = Habilidad::whereIn('nombre', $this->habilidades)
            ->where('restringida', true)
            ->pluck('nombre')
            ->toArray();

        if (!empty($habilidadesRestringidas)) {
            $nombres = implode(', ', $habilidadesRestringidas);
            $this->addError('habilidades', "Las siguientes habilidades no están permitidas: $nombres");
            return;
        }

        foreach ($this->habilidades as $nombre) {
            if (!empty($nombre)) {
                Habilidad::firstOrCreate(['nombre' => trim($nombre)]);
            }
        }

        $this->cvGuardado = true;
        $imagenPath = null;

        if ($this->imagen) {
            $imageName = Str::uuid() . '.' . $this->imagen->getClientOriginalExtension();
            $manager = new ImageManager(new GdDriver());
            $image = $manager->read($this->imagen->getRealPath())
                ->cover(300, 400)
                ->toJpeg(80);
            $rutaFinal = 'imagenes_perfil/' . $imageName;
            \Storage::disk('public')->put($rutaFinal, (string) $image);
            $imagenPath = $rutaFinal;

            if ($this->modo === 'editar') {
                $cv = CV::find($this->cv_id);
                if ($cv && $cv->imagen && \Storage::disk('public')->exists($cv->imagen)) {
                    \Storage::disk('public')->delete($cv->imagen);
                }
            }
        }

        $idiomas = array_values(array_filter($this->idiomas, function ($item) {
            return !empty($item['nombre']) && !empty($item['nivel']);
        }));

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
        $this->experiencia[] = ['empresa' => '', 'puesto' => '', 'inicio' => '', 'fin' => '', 'tareas' => ['']];
    }

    public function removeExperience($index)
    {
        unset($this->experiencia[$index]);
        $this->experiencia = array_values($this->experiencia);
    }

    public function agregarTarea($expIndex)
    {
        if (!isset($this->experiencia[$expIndex]['tareas']) || !is_array($this->experiencia[$expIndex]['tareas'])) {
            $valorActual = $this->experiencia[$expIndex]['tareas'] ?? '';
            $this->experiencia[$expIndex]['tareas'] = $valorActual !== '' ? [$valorActual] : [];
        }

        $this->experiencia[$expIndex]['tareas'][] = '';
    }

    public function eliminarTarea($expIndex, $tareaIndex)
    {
        unset($this->experiencia[$expIndex]['tareas'][$tareaIndex]);
        $this->experiencia[$expIndex]['tareas'] = array_values($this->experiencia[$expIndex]['tareas']);
    }

    public function addEducation()
    {
        $this->educacion[] = ['universidad' => '', 'carrera' => '', 'inicio' => '', 'fin' => '',  'estado' => '',];
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
public function addLanguage()
{
    $this->idiomas[] = [
        'nombre' => '',
        'nivel' => count($this->idiomas) === 0 ? 'nativo' : '',
    ];
}

public function removeLanguage()
{
    array_pop($this->idiomas);
}


}











