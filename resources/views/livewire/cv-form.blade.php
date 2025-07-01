<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md w-full max-w-3xl mx-auto">
   <!-- Mensaje de éxito -->
@if ($cvGuardado)
    <div class="p-4 mb-4 text-green-800 bg-green-200 rounded-lg flex items-center">
        ✅ CV creado exitosamente. 
    </div>
@endif


    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">✍️ CV</h2>

<form wire:submit.prevent="save" class="space-y-4">

        <!-- Nombre -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nombre <span class="text-red-500">*</span></label>
            <input type="text" wire:model="nombre" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Apellido -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Apellido <span class="text-red-500">*</span></label>
            <input type="text" wire:model="apellido" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('apellido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

     <!-- Categoría de Profesión -->
<div>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        Categoría Profesional <span class="text-red-500">*</span>
    </label>
    
    <select wire:model="categoria_profesion" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
        <option value="">Selecciona una categoría</option>
        @foreach($profesionesPorCategoria as $categoria)
            <option value="{{ $categoria }}">{{ $categoria }}</option>
        @endforeach
    </select>

    <!-- Texto informativo -->
    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
        📌 Esto ayudará a que las empresas y reclutadores encuentren tu CV. Asegúrate de seleccionar la más apropiada.
    </p>

    @error('categoria_profesion') 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div>


<!-- Profesión libre -->
<div class="mt-4">
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Profesión o Título <span class="text-red-500">*</span></label>
    <input type="text" wire:model="titulo_manual" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm" placeholder="Ejemplo: Abogado, Desarrollador, Diseñador UX...">
    @error('titulo_manual') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>



      <!-- Perfil Profesional -->
<div x-data="{ count: 0 }" x-init="count = $refs.perfil.value.length">
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        Perfil Profesional <span class="text-red-500">*</span>
    </label>

    <textarea
        x-ref="perfil"
        wire:model="perfil"
        x-on:input="count = $refs.perfil.value.length"
        rows="4"
        maxlength="390"
        class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm"
    ></textarea>

    <div class="text-sm mt-1 text-right text-gray-500 dark:text-gray-400">
        <span x-text="count"></span> / 390 caracteres
    </div>

    @error('perfil')
        <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
</div>


<!-- Imagen -->
<div>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Imagen de Perfil</label>
    <div class="flex items-center gap-3">
        <label for="imagen" class="cursor-pointer px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">
            📷 Seleccionar Imagen
        </label>
        <input type="file" id="imagen" wire:model="imagen" class="hidden">
    </div>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">📌 Recomendación: 300x400 px, JPEG o PNG. 
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
    📌 La imagen se ajustará automáticamente a 300x400 px. Formato JPEG o PNG, máx. 1MB.
</p>
</p>

    @if ($imagenSubida)
        <div class="mt-2 text-green-600 dark:text-green-400 text-sm">
            ✅ Imagen subida correctamente.
        </div>

        {{-- Preview --}}
        <div class="mt-2">
            <img src="{{ $imagen->temporaryUrl() }}" alt="Vista previa"
                 class="w-40 h-52 object-cover rounded-md border border-gray-300 shadow-sm">
        </div>
    @endif

    @error('imagen') 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div>


        <!-- Correo -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Correo Electrónico</label>
            <input type="email" wire:model="correo" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('correo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Teléfono -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Número de Contacto</label>
            <input type="text" wire:model="telefono" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Dirección -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Dirección</label>
            <input type="text" wire:model="direccion" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('direccion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
 <!-- Ciudad -->
 <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ciudad</label>
            <input type="text" wire:model="ciudad" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <!-- País -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">País</label>
            <input type="text" wire:model="pais" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('pais') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Habilidades -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Habilidades</label>
            @foreach($habilidades as $index => $habilidad)
                <div class="flex gap-2 mt-2">
                <input type="text" wire:model="habilidades.{{ $index }}" maxlength="50" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm" placeholder="Ej: Trabajo en equipo. Max 50 caracteres">
                    <button type="button" wire:click="removeSkill({{ $index }})" class="text-red-500">🗑</button>
                </div>
            @endforeach
            <button type="button" wire:click="addSkill" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">+ Agregar Habilidad</button>
        </div>

<!-- Idiomas -->
<div>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Idiomas</label>

    @foreach ($idiomas as $index => $idioma)
        <div class="flex flex-col sm:flex-row gap-2 mt-2">
            <!-- Idioma -->
            <div class="w-full sm:w-1/2">
                <select wire:model="idiomas.{{ $index }}.nombre" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
                    <option value="">Selecciona un idioma</option>
                    @foreach ($idiomasDisponibles as $lang)
                        <option value="{{ $lang }}">{{ $lang }}</option>
                    @endforeach
                </select>
                @error("idiomas.$index.nombre") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

           <!-- Nivel -->
<div class="w-full sm:w-1/2">
    <select wire:model="idiomas.{{ $index }}.nivel" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
        <option value="">Selecciona nivel</option>
        <option value="básico">Básico</option>
        <option value="intermedio">Intermedio</option>
        <option value="avanzado">Avanzado</option>
        <option value="fluido">Fluido</option>
        <option value="business">Business</option>
        <option value="nativo">Lengua materna</option>
    </select>
    @error("idiomas.$index.nivel") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

        </div>
    @endforeach

    <!-- Botones -->
    <div class="flex gap-3 mt-3">
        <button type="button" wire:click="addLanguage"
        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
    + Agregar idioma
</button>


        @if (count($idiomas) > 0)
    <button type="button" wire:click="removeLanguage"
            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
        🗑 Quitar último
    </button>
@endif

    </div>
</div>



   <!-- Experiencia laboral -->
<div>
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Experiencia Laboral</label>
    @foreach($experiencia as $index => $exp)
        <div class="mt-2 flex flex-col gap-2">
            <div class="flex flex-wrap items-end gap-2">
                <div class="flex flex-col md:w-1/4">
                    <label class="text-sm text-gray-700 dark:text-gray-300 mb-1">Empresa</label>
                    <input type="text"
                           wire:model="experiencia.{{ $index }}.empresa"
                           class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
                </div>

                <div class="flex flex-col md:w-1/4">
                    <label class="text-sm text-gray-700 dark:text-gray-300 mb-1">Puesto/Cargo</label>
                    <input type="text"
                           wire:model="experiencia.{{ $index }}.puesto"
                           class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
                </div>

                <div class="flex flex-col md:w-1/5">
                    <label class="text-sm text-gray-700 dark:text-gray-300 mb-1">Ingreso</label>
                    <input type="date"
                           wire:model="experiencia.{{ $index }}.inicio"
                           class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
                </div>

                <div class="flex flex-col md:w-1/5">
                    <label class="text-sm text-gray-700 dark:text-gray-300 mb-1">Egreso</label>
                    <input type="date"
                           wire:model="experiencia.{{ $index }}.fin"
                           class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
                </div>

                <button type="button"
                        wire:click="removeExperience({{ $index }})"
                        class="text-red-500 text-xl hover:text-red-700">
                    🗑
                </button>
            </div>

            {{-- Tareas dinámicas --}}
            <div class="mt-2">
                <label class="text-sm text-gray-700 dark:text-gray-300">Tareas, responsabilidades y logros</label>
                
   @if (is_array($experiencia[$index]['tareas']))
    @foreach ($experiencia[$index]['tareas'] as $tIndex => $tarea)
        <div class="flex items-center gap-2 mt-1">
            <input type="text"
                   wire:model="experiencia.{{ $index }}.tareas.{{ $tIndex }}"
                   class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm"
                   maxlength="200"
                   placeholder="Ej. Desarrollo de sitios web">
            <button type="button"
                    wire:click="eliminarTarea({{ $index }}, {{ $tIndex }})"
                    class="text-red-500 hover:text-red-700 text-lg font-bold">
                🗑️
            </button>
        </div>
    @endforeach
@endif

x

                <button type="button"
                        wire:click="agregarTarea({{ $index }})"
                        class="mt-2 px-3 py-1 text-sm font-semibold bg-green-500 text-white rounded-md hover:bg-green-600">
                    + Agregar tarea
                </button>
            </div>
        </div>
    @endforeach

    <button type="button" wire:click="addExperience" class="mt-4 px-4 py-2 bg-green-500 text-white rounded">+ Agregar Experiencia</button>
</div>


<!-- Educación -->
<div class="mt-6">
    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Formación Profesional</label>

@foreach($educacion as $index => $edu)
    <div class="mt-3 border border-gray-700 rounded-md p-4 space-y-3 bg-gray-900">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Universidad -->
            <div class="flex flex-col">
                <label class="text-sm text-gray-300 mb-1">Universidad / Escuela / Instituto</label>
                <input type="text" wire:model="educacion.{{ $index }}.universidad"
                       class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm text-sm">
            </div>

            <!-- Título -->
            <div class="flex flex-col">
                <label class="text-sm text-gray-300 mb-1">Título obtenido / a obtener</label>
                <input type="text" wire:model="educacion.{{ $index }}.carrera"
                       class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm text-sm">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <!-- Ingreso -->
            <div class="flex flex-col">
                <label class="text-sm text-gray-300 mb-1">Ingreso</label>
                <input type="date" wire:model="educacion.{{ $index }}.inicio"
                       class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm text-sm">
            </div>

            <!-- Egreso -->
            <div class="flex flex-col">
                <label class="text-sm text-gray-300 mb-1">Egreso</label>
                <input type="date" wire:model="educacion.{{ $index }}.fin"
                       class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm text-sm">
            </div>

            <!-- Estado -->
            <div class="flex flex-col">
                <label class="text-sm text-gray-300 mb-1">Estado</label>
                <select wire:model="educacion.{{ $index }}.estado"
                        class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm text-sm">
                    <option value="">Seleccione una opción</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="en_progreso">En progreso</option>
                </select>
            </div>

            <!-- Botón eliminar -->
            <div class="mt-2 md:mt-0 flex justify-start md:justify-end">
                <button type="button" wire:click="removeEducation({{ $index }})"
                        class="text-red-500 text-xl hover:text-red-700">
                    🗑
                </button>
            </div>
        </div>
    </div>
@endforeach


    <button type="button" wire:click="addEducation" class="mt-4 px-4 py-2 bg-green-500 text-white rounded shadow hover:bg-green-600 transition">
        + Agregar Estudio
    </button>
</div>

      <!-- Público -->
<div class="flex items-center">
    <input type="checkbox" wire:model="publico" class="text-blue-600">
    <label class="ml-2 text-gray-700 dark:text-gray-300">Hacer CV público</label>
</div>

@if ($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-200 rounded-lg rounded-md space-y-2">
        <strong class="block">❌ Por favor corrige los siguientes errores:</strong>
        <ul class="list-disc list-inside text-sm">
            @if ($errors->has('nombre'))
                <li>El campo <strong>Nombre</strong> es obligatorio y debe tener máximo 100 caracteres.</li>
            @endif
            @if ($errors->has('apellido'))
                <li>El campo <strong>Apellido</strong> es obligatorio y debe tener máximo 100 caracteres.</li>
            @endif
            @if ($errors->has('perfil'))
    <li>El campo <strong>Perfil Profesional</strong> es obligatorio y debe tener entre 50 y 390 caracteres.</li>
@endif
            @if ($errors->has('categoria_profesion'))
    <li>Debe seleccionar una <strong>categoría profesional</strong>.</li>
@endif

@if ($errors->has('titulo_manual'))
    <li>Debe escribir su <strong>profesión o título</strong> para mostrar en el CV.</li>
@endif

           @if ($errors->has('imagen'))
    <li>La <strong>Imagen de Perfil</strong> debe ser un archivo de imagen y no debe superar los 6MB.</li>
@endif

            @if ($errors->has('correo'))
                <li>El campo <strong>Correo Electrónico</strong> debe contener una dirección válida y tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('telefono'))
                <li>El campo <strong>Número de Contacto</strong> debe ser texto y tener máximo 20 caracteres.</li>
            @endif
            @if ($errors->has('direccion'))
                <li>El campo <strong>Dirección</strong> debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('pais'))
                <li>El campo <strong>País</strong> debe tener máximo 100 caracteres.</li>
            @endif
            @if ($errors->has('ciudad'))
                <li>El campo <strong>Ciudad</strong> debe tener máximo 100 caracteres.</li>
            @endif
            @if ($errors->has('habilidades.*'))
                <li>Cada <strong>Habilidad</strong> es obligatoria y debe tener máximo 35 caracteres.</li>
            @endif
            @if ($errors->has('idiomas.*'))
                <li>Cada <strong>Idioma</strong> es obligatorio y debe tener máximo 100 caracteres.</li>
            @endif
            @if ($errors->has('experiencia.*.empresa'))
                <li>El campo <strong>Empresa</strong> en la sección de experiencia es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('experiencia.*.puesto'))
                <li>El campo <strong>Puesto</strong> en la sección de experiencia es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('experiencia.*.inicio'))
                <li>El campo <strong>Fecha de Inicio</strong> en experiencia laboral es obligatorio y debe ser una fecha válida.</li>
            @endif
            @if ($errors->has('experiencia.*.fin'))
                <li>La <strong>Fecha de Fin</strong> en experiencia laboral debe ser posterior o igual a la fecha de inicio.</li>
            @endif
            @if ($errors->has('educacion.*.universidad'))
                <li>El campo <strong>Universidad</strong> en la sección de estudios es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('educacion.*.carrera'))
                <li>El campo <strong>Carrera</strong> en la sección de estudios es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('educacion.*.inicio'))
                <li>El campo <strong>Fecha de Inicio</strong> en estudios es obligatorio y debe ser una fecha válida.</li>
            @endif
            @if ($errors->has('educacion.*.fin'))
                <li>La <strong>Fecha de Fin</strong> en estudios debe ser posterior o igual a la fecha de inicio.</li>
            @endif
            @if ($errors->has('habilidades'))
    <li>Debe ingresar al menos <strong>5 habilidades</strong> para completar el CV.</li>
@endif

        </ul>
    </div>
@endif



<!-- Botón Guardar -->
<div class="flex justify-end">
    <button type="submit"
            class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-6 py-2 rounded-md font-semibold shadow-md flex items-center justify-center"
            wire:target="save"
            wire:loading.attr="disabled">
        🚀 Guardar CV
    </button>
</div>


       <!-- Confirmación -->
@if ($cvGuardado)
    <div class="mt-4 p-3 bg-green-500 text-white font-semibold text-sm text-center rounded-md shadow">
        ✅ CV guardado correctamente.
    </div>
@endif


        <!-- Cargando -->
        <div wire:loading wire:target="save" class="mt-4 text-blue-500 font-semibold flex items-center">
            ⏳ Guardando CV, por favor espera...
        </div>
    </form>
</div>





