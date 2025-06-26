<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">📄 Perfil Profesional</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white text-black overflow-hidden shadow-md rounded-lg p-6">
            {{-- Imagen y nombre --}}
            <div class="flex flex-col sm:flex-row items-center gap-6">
               @php
    $imagenPerfil = $cv->imagen && file_exists(public_path('storage/' . $cv->imagen))
        ? asset('storage/' . $cv->imagen)
        : asset('images/avatar.png');
@endphp

<img src="{{ $imagenPerfil }}" alt="Foto de perfil"
     class="w-40 h-52 object-cover rounded-md shadow-md border border-gray-300">


                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        {{ $cv->nombre }} {{ $cv->apellido }}
                    </h1>
                    <p class="text-lg text-gray-600">{{ $cv->titulo }}</p>

                    @if($cv->correo)
                        <p class="text-base text-gray-600 mt-1">📧 {{ $cv->correo }}</p>
                    @endif
                    @if($cv->telefono)
                        <p class="text-base text-gray-600">📱 {{ $cv->telefono }}</p>
                    @endif
                    @if($cv->direccion || $cv->ciudad || $cv->pais)
                        <p class="text-base text-gray-600 mt-1">
                            📍 {{ $cv->direccion }}
                            {{ $cv->ciudad ? ', ' . $cv->ciudad : '' }}
                            {{ $cv->pais ? ', ' . $cv->pais : '' }}
                        </p>
                    @endif

                    <span class="inline-block mt-2 px-3 py-1 text-sm font-medium 
                        {{ $cv->publico ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} rounded-md">
                        {{ $cv->publico ? 'CV Público' : 'CV Privado' }}
                    </span>

                    {{-- ⭐ Botón para marcar como favorito (solo para empresa/admin que no sean el dueño) --}}
                    @auth
                        @if(in_array(auth()->user()->role, ['admin', 'empresa']) && auth()->id() !== $cv->user_id)
                            <form method="POST" action="{{ route('cv.favorito.toggle', $cv->id) }}" class="mt-4">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-4 py-1.5 text-sm font-semibold rounded-md shadow transition
                                        {{ auth()->user()->favoritos->contains($cv->id) 
                                            ? 'bg-yellow-500 text-white hover:bg-yellow-600' 
                                            : 'bg-yellow-200 text-yellow-900 hover:bg-yellow-300' }}">
                                    {{ auth()->user()->favoritos->contains($cv->id) ? '★ Guardado' : '☆ Marcar como favorito' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Perfil profesional --}}
            @if ($cv->perfil)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">Perfil Profesional</h3>
                    <p class="text-gray-700">{{ $cv->perfil }}</p>
                </div>
            @endif

        {{-- Experiencia Laboral --}}
{{-- Experiencia Laboral --}}
@if ($cv->experiencia)
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-900">Experiencia Laboral</h3>

        @foreach (json_decode($cv->experiencia, true) as $exp)
            <div class="mb-5 pb-4 border-b border-gray-200">
                <p class="text-base font-semibold text-gray-800">
                    {{ $exp['empresa'] }} — {{ $exp['puesto'] }}
                </p>
                <p class="text-sm text-gray-600 mb-2">
                    {{ $exp['inicio'] }} al {{ $exp['fin'] ?? 'Actualidad' }}
                </p>

                @if (!empty($exp['tareas']) && is_array($exp['tareas']))
                    <ul class="list-disc ml-6 text-sm text-gray-800">
                        @foreach ($exp['tareas'] as $t)
                            @if ($t)
                                <li>{{ $t }}</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
@endif




            {{-- Educación --}}
            @if ($cv->educacion)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">Estudios Superiores</h3>
                    <ul class="space-y-2 text-gray-700">
                        @foreach (json_decode($cv->educacion, true) as $edu)
                            <li>
                                <strong>{{ $edu['universidad'] }}</strong> - {{ $edu['carrera'] }}
                                <br>
                                <small class="text-sm text-gray-600">
                                    {{ $edu['inicio'] }} al {{ $edu['fin'] ?? 'Actualidad' }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Habilidades --}}
            @if ($cv->habilidades)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800">Habilidades</h3>
                    <ul class="flex flex-wrap gap-2 text-sm mt-2">
                        @foreach (json_decode($cv->habilidades, true) as $hab)
                            <li class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                                {{ $hab }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Idiomas --}}
@if ($cv->idiomas)
    <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800">Idiomas</h3>
        <ul class="list-disc list-inside text-sm text-gray-700 mt-2">
            @foreach (json_decode($cv->idiomas, true) as $idioma)
                @if (is_array($idioma) && isset($idioma['nombre'], $idioma['nivel']))
                    <li>{{ $idioma['nombre'] }} – {{ ucfirst($idioma['nivel']) }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif


{{-- Botón volver --}}
@auth
    <div class="mt-8">
        <a href="{{ url()->previous() !== url()->current()
                    ? url()->previous()
                    : (auth()->user()->role === 'empresa'
                        ? route('admin.busqueda-cvs')
                        : route('cv.index')) }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600">
            🔙 Volver
        </a>
    </div>
@endauth
        </div>
    </div>
</x-app-layout>





