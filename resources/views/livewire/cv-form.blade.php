<div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md w-full max-w-3xl mx-auto">
    <!-- Mensaje de éxito -->
    <div x-data="{ show: false }" x-show="show" x-transition
         x-init="@this.on('cvSaved', () => { show = true; setTimeout(() => show = false, 3000); })"
         class="p-4 mb-4 text-green-800 bg-green-200 rounded-lg flex items-center">
        ✅ CV creado exitosamente. Asegurate que los campos Nombre,Apellido,Perfil sean obligatorios
    </div>

    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">✍️ Crear mi CV</h2>

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

        <!-- Título -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Título o Profesión</label>
            <input type="text" wire:model="titulo" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Perfil -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Perfil Profesional <span class="text-red-500">*</span></label>
            <textarea wire:model="perfil" rows="4" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm"></textarea>
            @error('perfil') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">📌 Recomendación: 400x400 px, JPEG o PNG, máx 2MB.</p>
            <div x-data="{ show: false }" x-show="show" x-transition
                 x-init="@this.on('imagenSubida', () => { show = true; setTimeout(() => show = false, 3000); })"
                 class="mt-2 text-green-600 dark:text-green-400 text-sm">
                ✅ Imagen subida correctamente.
            </div>
            @error('imagen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

        <!-- País -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">País</label>
            <input type="text" wire:model="pais" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('pais') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Ciudad -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ciudad</label>
            <input type="text" wire:model="ciudad" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm">
            @error('ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Habilidades -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Habilidades</label>
            @foreach($habilidades as $index => $habilidad)
                <div class="flex gap-2 mt-2">
                    <input type="text" wire:model="habilidades.{{ $index }}" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm" placeholder="Ej: Trabajo en equipo">
                    <button type="button" wire:click="removeSkill({{ $index }})" class="text-red-500">🗑</button>
                </div>
            @endforeach
            <button type="button" wire:click="addSkill" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">+ Agregar Habilidad</button>
        </div>

        <!-- Idiomas -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Idiomas</label>
            <div class="flex flex-wrap gap-4 mt-2">
                @php
                    $opciones = ['Español', 'Inglés', 'Francés', 'Alemán', 'Portugués', 'Italiano'];
                @endphp
                @foreach($opciones as $idioma)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="idiomas" value="{{ $idioma }}" class="text-blue-600">
                        <span class="text-gray-800 dark:text-gray-300">{{ $idioma }}</span>
                    </label>
                @endforeach
            </div>
            @error('idiomas') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Experiencia laboral -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Experiencia Laboral</label>
            @foreach($experiencia as $index => $exp)
                <div class="mt-2 flex flex-col gap-2">
                    <div class="flex flex-wrap gap-2">
                        <input type="text" wire:model="experiencia.{{ $index }}.empresa" placeholder="Empresa" class="w-full md:w-1/4">
                        <input type="text" wire:model="experiencia.{{ $index }}.puesto" placeholder="Puesto" class="w-full md:w-1/4">
                        <input type="date" wire:model="experiencia.{{ $index }}.inicio" class="w-full md:w-1/5">
                        <input type="date" wire:model="experiencia.{{ $index }}.fin" class="w-full md:w-1/5">
                        <button type="button" wire:click="removeExperience({{ $index }})" class="text-red-500">🗑</button>
                    </div>
                    <textarea wire:model="experiencia.{{ $index }}.tareas" placeholder="Tareas, responsabilidades y logros (máx. 500 caracteres)" maxlength="500" class="w-full dark:bg-gray-800 dark:text-white rounded-md shadow-sm" rows="3"></textarea>
                </div>
            @endforeach
            <button type="button" wire:click="addExperience" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">+ Agregar Experiencia</button>
        </div>

        <!-- Educación -->
        <div>
            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Estudios Superiores</label>
            @foreach($educacion as $index => $edu)
                <div class="mt-2 flex gap-2 flex-wrap">
                    <input type="text" wire:model="educacion.{{ $index }}.universidad" placeholder="Universidad" class="w-full md:w-1/3">
                    <input type="text" wire:model="educacion.{{ $index }}.carrera" placeholder="Carrera" class="w-full md:w-1/3">
                    <input type="date" wire:model="educacion.{{ $index }}.inicio" class="w-full md:w-1/6">
                    <input type="date" wire:model="educacion.{{ $index }}.fin" class="w-full md:w-1/6">
                    <button type="button" wire:click="removeEducation({{ $index }})" class="text-red-500">🗑</button>
                </div>
            @endforeach
            <button type="button" wire:click="addEducation" class="mt-2 px-4 py-2 bg-green-500 text-white rounded">+ Agregar Estudio</button>
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
                <li>El campo <strong>Nombre</strong> es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('apellido'))
                <li>El campo <strong>Apellido</strong> es obligatorio y debe tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('perfil'))
                <li>El campo <strong>Perfil Profesional</strong> es obligatorio y debe tener máximo 1000 caracteres.</li>
            @endif
            @if ($errors->has('titulo'))
                <li>El campo <strong>Título o Profesión</strong> debe ser texto y tener máximo 255 caracteres.</li>
            @endif
            @if ($errors->has('imagen'))
                <li>La <strong>Imagen de Perfil</strong> debe ser un archivo de imagen y no debe superar los 2MB.</li>
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
                <li>Cada <strong>Habilidad</strong> es obligatoria y debe tener máximo 100 caracteres.</li>
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
        <div x-data="{ show: false }"
             x-show="show"
             x-transition
             x-init="@this.on('cvSaved', () => { show = true; setTimeout(() => show = false, 4000); })"
             class="mt-4 p-3 bg-green-500 text-white font-semibold text-sm text-center rounded-md shadow">
            ✅ CV guardado correctamente.
        </div>

        <!-- Cargando -->
        <div wire:loading wire:target="save" class="mt-4 text-blue-500 font-semibold flex items-center">
            ⏳ Guardando CV, por favor espera...
        </div>
    </form>
</div>





