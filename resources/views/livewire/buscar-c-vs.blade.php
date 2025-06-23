<div class="space-y-6">
    <!-- Banner ajustado -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="rounded-lg overflow-hidden">
            <img src="{{ asset('images/buscarcv.webp') }}" alt="Banner CV" class="w-full object-cover" style="max-height: 160px;">
        </div>
    </div>

    <!-- Bloque general estilo filtros -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Cuadro 1 -->
            <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">🔍 Buscar Talento Profesional</h2>
                <p class="text-sm text-gray-300 mt-2">
                    Utiliza los filtros disponibles para explorar rápidamente los perfiles más relevantes.
                    Encuentra candidatos según su <span class="font-semibold text-white">categoría profesional</span>,
                    <span class="font-semibold text-white">habilidades</span> o <span class="font-semibold text-white">idiomas</span>.
                </p>
                <p class="text-sm text-gray-400 mt-2 italic">
                    Esta sección es exclusiva para cuentas de empresa o reclutadores.
                </p>
            </div>

            <!-- Cuadro 2 -->
            <div class="bg-gray-900 p-4 rounded-lg border border-gray-700 flex flex-col items-center text-center">
                <img src="{{ asset('images/sivigif.gif') }}" alt="Sivi saludando" class="w-20 h-20 rounded-full object-contain mb-3">
                <p class="text-sm text-gray-300 mb-2">¿Necesitas ayuda para encontrar el perfil ideal?</p>
                <a href="https://chat.openai.com/g/g-682e161092d08191bef1a1f6f879ae6f-sivi-asistente-cvbook"
                   target="_blank"
                   class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-1.5 rounded-md shadow transition">
                    💬 Habla con Sivi
                </a>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Categoría -->
            <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                <label class="block text-sm font-semibold text-white mb-1">Categoría Profesional</label>
                <p class="text-xs text-gray-400 mb-2">Filtra por sector profesional del candidato.</p>
                <select wire:model="categoria_profesion" class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Habilidades -->
            <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                <label class="block text-sm font-semibold text-white mb-1">Habilidades</label>
                <p class="text-xs text-gray-400 mb-2">Selecciona una o varias habilidades específicas.</p>
                <select wire:model="habilidades_seleccionadas" multiple size="6" class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                    @foreach($habilidades_disponibles as $hab)
                        <option value="{{ $hab }}">{{ $hab }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2 italic">Usa <kbd>Ctrl</kbd> o <kbd>Cmd</kbd> para selección múltiple.</p>
            </div>

            <!-- Idiomas -->
            <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
                <label class="block text-sm font-semibold text-white mb-1">Idiomas</label>
                <p class="text-xs text-gray-400 mb-2">Selecciona uno o varios idiomas que debe manejar el candidato.</p>
                <select wire:model="idiomas_seleccionados" multiple size="6" class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                    @foreach($idiomas_disponibles as $idioma)
                        <option value="{{ $idioma }}">{{ $idioma }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2 italic">Usa <kbd>Ctrl</kbd> o <kbd>Cmd</kbd> para selección múltiple.</p>
            </div>
        </div>

        <!-- Botones -->
        <div class="mt-4 flex flex-wrap gap-4">
            <button
                wire:click="aplicarFiltros"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md font-semibold shadow hover:bg-indigo-700 text-sm">
                🔍 Aplicar filtros
            </button>

            <button
                wire:click="$toggle('solo_favoritos')"
                class="px-4 py-2 rounded-md font-semibold shadow transition text-sm
                       {{ $solo_favoritos 
                            ? 'bg-yellow-400 text-gray-900 hover:bg-yellow-500 ring-1 ring-yellow-300' 
                            : 'bg-gray-700 text-white hover:bg-gray-600' }}">
                {{ $solo_favoritos ? '✓ Mostrando solo favoritos' : 'Mostrar solo favoritos' }}
            </button>
        </div>
    </div>

    <!-- Mensaje -->
    @if ($mensaje)
        <div 
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            class="bg-green-600 text-white px-4 py-2 rounded shadow text-sm mb-4">
            {{ $mensaje }}
        </div>
    @endif

    <!-- Resultados -->
    @if ($mostrarResultados || $solo_favoritos)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @forelse($cvs as $cv)
                <!-- Tarjeta individual -->
                <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md hover:shadow-lg transition flex flex-col h-full">
                    <div class="flex-grow space-y-2">
                        <h3 class="font-bold text-lg">{{ $cv->user->name }}</h3>
                        <p class="text-sm text-gray-400">{{ $cv->titulo }}</p>

                        @if($cv->categoria_profesion)
                            <p class="text-sm text-gray-500">
                                <span class="font-semibold">Categoría:</span> {{ $cv->categoria_profesion }}
                            </p>
                        @endif

                        @if($cv->habilidades)
                            <div>
                                <p class="text-xs text-gray-400 font-semibold mb-1">Habilidades:</p>
                                <ul class="flex flex-wrap gap-2">
                                    @foreach (array_slice(json_decode($cv->habilidades, true) ?? [], 0, 5) as $hab)
                                        <li class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">{{ $hab }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($cv->idiomas && is_string($cv->idiomas))
                            @php $idiomas = json_decode($cv->idiomas, true); @endphp
                            @if(is_array($idiomas) && count($idiomas))
                                <div>
                                    <p class="text-xs text-gray-400 font-semibold mb-1">Idiomas:</p>
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($idiomas as $idioma)
                                            <li class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">{{ $idioma }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endif

                        <p class="text-sm text-gray-300">
                            {{ \Illuminate\Support\Str::limit($cv->descripcion, 100) }}
                        </p>
                    </div>

                    <div class="mt-4 flex justify-between items-center gap-2 flex-wrap">
                        <a href="{{ route('cv.show', ['slug' => $cv->slug]) }}"
                           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-1.5 rounded-md shadow transition">
                            👁️ Ver CV
                        </a>

                        @if(in_array(auth()->user()->role, ['empresa', 'admin']))
                            <button wire:click="toggleFavorito({{ $cv->id }})"
                                    class="inline-flex items-center gap-2 px-4 py-1.5 text-sm font-medium rounded-md shadow transition
                                           {{ in_array($cv->id, $favoritos_ids) ? 'bg-yellow-500 text-white hover:bg-yellow-600' : 'bg-gray-700 text-yellow-400 hover:bg-yellow-500 hover:text-white' }}"
                                    title="{{ in_array($cv->id, $favoritos_ids) ? 'Quitar de favoritos' : 'Agregar a favoritos' }}">
                                {{ in_array($cv->id, $favoritos_ids) ? '★ Guardado' : '☆ Marcar como favorito' }}
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-white">No se encontraron CVs con los filtros aplicados.</p>
            @endforelse
        </div>
    @endif

    <!-- Mensaje Sivi -->
    <div class="flex items-center gap-3 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 mb-4 shadow w-fit">
        <img src="{{ asset('images/sivigif.gif') }}" alt="Sivi icono" class="w-10 h-10 rounded-full">
        <p class="text-sm text-gray-300 m-0">
            ¿Necesitas ayuda para encontrar el perfil ideal?
            <a href="https://chat.openai.com/g/g-682e161092d08191bef1a1f6f879ae6f-sivi-asistente-cvbook"
               target="_blank"
               class="text-indigo-400 font-semibold hover:underline">
                Habla con Sivi, nuestra asistente virtual.
            </a>
        </p>
    </div>
</div>













