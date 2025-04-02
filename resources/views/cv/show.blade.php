<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">📄 Perfil Profesional</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg p-6">

            {{-- Imagen y nombre --}}
            <div class="flex flex-col sm:flex-row items-center gap-6">
                @if ($cv->imagen)
                    <img src="{{ asset('storage/' . $cv->imagen) }}" alt="Foto de perfil"
                         class="w-40 h-52 object-cover rounded-md shadow-md border border-gray-300">
                @else
                    <div class="w-40 h-52 bg-gray-200 rounded-md flex items-center justify-center text-gray-500">
                        Sin imagen
                    </div>
                @endif

                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $cv->nombre }} {{ $cv->apellido }}
                    </h1>
                    <p class="text-lg text-gray-500 dark:text-gray-300">{{ $cv->titulo }}</p>
                    <span class="inline-block mt-2 px-3 py-1 text-sm font-medium 
                        {{ $cv->publico ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} rounded-md">
                        {{ $cv->publico ? 'CV Público' : 'CV Privado' }}
                    </span>
                </div>
            </div>

            {{-- Perfil profesional --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Perfil Profesional</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ $cv->perfil }}</p>
            </div>

            {{-- Experiencia Laboral --}}
            @if ($cv->experiencia)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Experiencia Laboral</h3>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300">
                        @foreach (json_decode($cv->experiencia, true) as $exp)
                            <li>
                                <strong>{{ $exp['empresa'] }}</strong> - {{ $exp['puesto'] }}
                                <br>
                                <small class="text-sm text-gray-500">
                                    {{ $exp['inicio'] }} al {{ $exp['fin'] ?? 'Actualidad' }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Educación --}}
            @if ($cv->educacion)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Estudios Superiores</h3>
                    <ul class="list-disc pl-6 text-gray-700 dark:text-gray-300">
                        @foreach (json_decode($cv->educacion, true) as $edu)
                            <li>
                                <strong>{{ $edu['universidad'] }}</strong> - {{ $edu['carrera'] }}
                                <br>
                                <small class="text-sm text-gray-500">
                                    {{ $edu['inicio'] }} al {{ $edu['fin'] ?? 'Actualidad' }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Botón volver --}}
            <div class="mt-6">
                <a href="{{ route('cv.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600">
                    🔙 Volver
                </a>
            </div>
        </div>
    </div>
</x-app-layout>



