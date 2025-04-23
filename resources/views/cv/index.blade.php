<x-app-layout>
    <!-- Encabezado superior de la página -->
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">📄 Mis CVs</h2>
    </x-slot>

    <!-- Contenedor principal que engloba todo -->
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Banner -->
        <div class="mb-6">
            <img src="{{ asset('images/bannerlistcv.webp') }}"
                 alt="Banner de edición de CV"
                 class="rounded-md object-cover w-full h-[140px] shadow" />
        </div>

        <!-- Tarjeta principal -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            <!-- Título de sección -->
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Lista de CVs</h3>

            <!-- Mensajes de éxito -->
            @if(session('message'))
                <div class="p-4 mb-4 bg-green-200 text-green-800 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Mensajes de error -->
            @if(session('error'))
                <div class="p-4 mb-4 text-red-800 bg-red-200 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Estado: sin CVs -->
            @if($cvs->isEmpty())
                <p class="text-gray-500 dark:text-gray-400">Aún no has creado ningún CV.</p>
            @else
                <!-- Lista de CVs -->
                <ul class="space-y-4">
                    @foreach($cvs as $cv)
                    <li class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md shadow-sm flex flex-col sm:flex-row sm:justify-between sm:items-center">

                        <!-- Información del CV -->
                        <div class="mb-4 sm:mb-0">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">
                                {{ $cv->nombre }} {{ $cv->apellido }}
                            </h4>
                            <p class="text-sm text-gray-300 mb-1">{{ $cv->titulo ?? 'Sin título' }}</p>
                            <p class="text-xs text-gray-400 mb-1">Actualizado: {{ $cv->updated_at->format('d/m/Y H:i') }}</p>
                            <span class="text-sm {{ $cv->publico ? 'text-green-500' : 'text-red-500' }}">
                                {{ $cv->publico ? 'Público' : 'Privado' }}
                            </span>
                        </div>

                        <!-- Botones de acción -->
                        <div class="grid grid-cols-2 gap-2 w-full sm:flex sm:flex-wrap sm:justify-start sm:w-auto">

                            <!-- Botón: Ver CV -->
                            <a href="{{ route('cv.show', ['slug' => $cv->slug]) }}"
                               class="flex justify-center items-center w-36 px-3 py-1.5 bg-blue-500 hover:bg-blue-400 text-white text-sm rounded-md shadow-sm">
                                👀 Ver CV
                            </a>
<!-- Botón: Descargar PDF -->
<a href="{{ route('cv.pdf', ['slug' => $cv->slug]) }}"
   target="_blank"
   class="flex justify-center items-center w-36 px-3 py-1.5 text-white text-sm rounded-md shadow-sm"
   style="background-color: #7c3aed;">
   📄 PDF
</a>

                            <!-- Botón: Copiar enlace público -->
                            @if($cv->publico)
                                <div x-data="{ show: false }" class="relative w-36">
                                    <button
                                        @click="
                                            navigator.clipboard.writeText('{{ route('cv.show', ['slug' => $cv->slug]) }}');
                                            show = true;
                                            setTimeout(() => show = false, 3000);
                                        "
                                        class="flex justify-center items-center w-full px-3 py-1.5 bg-green-500 hover:bg-green-400 text-white text-sm rounded-md shadow-sm"
                                    >
                                        📋 Copiar Enlace
                                    </button>
                                    <span
                                        x-show="show"
                                        x-transition
                                        class="absolute left-1/2 -translate-x-1/2 mt-2 bg-green-600 text-white text-xs rounded px-2 py-1 shadow z-50"
                                        x-cloak
                                    >
                                        Enlace copiado
                                    </span>
                                </div>
                            @endif

                            <!-- Botón: Editar -->
                            <a href="{{ route('cv.edit', ['slug' => $cv->slug]) }}"
                               class="flex justify-center items-center w-36 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-400 text-white text-sm rounded-md shadow-sm">
                                ✏️ Editar CV
                            </a>

                            <!-- Botón: Eliminar con confirmación -->
                            <div x-data="{ showModal: false }" class="w-36" x-cloak>
                                <button
                                    @click="showModal = true"
                                    class="flex justify-center items-center w-full px-3 py-1.5 bg-red-500 hover:bg-red-400 text-white text-sm rounded-md shadow-sm"
                                >
                                    🗑 Eliminar
                                </button>

                                <!-- Modal de confirmación -->
                                <div
                                    x-show="showModal"
                                    x-transition
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                >
                                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md">
                                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">¿Eliminar CV?</h2>
                                        <p class="text-gray-600 dark:text-gray-300 mb-6">¿Estás seguro de que deseas eliminar este CV? Esta acción no se puede deshacer.</p>
                                        <div class="flex justify-end gap-3">
                                            <button
                                                @click="showModal = false"
                                                class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-500"
                                            >
                                                Cancelar
                                            </button>
                                            <form method="POST" action="{{ route('cv.destroy', ['slug' => $cv->slug]) }}" x-ref="deleteForm">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                                >
                                                    Sí, eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>

