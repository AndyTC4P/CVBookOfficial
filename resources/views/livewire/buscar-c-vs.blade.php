<div class="space-y-6">
    <!-- Banner ajustado -->
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="rounded-lg overflow-hidden">
            <img src="{{ asset('images/buscarcv.webp') }}" alt="Banner CV"
                 class="w-full object-cover" style="max-height: 160px;">
        </div>
    </div>
    <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 shadow">
    <h2 class="text-2xl font-bold text-white flex items-center gap-2">
        🔍 Buscar Talento Profesional
    </h2>
    <p class="text-sm text-gray-300 mt-2">
        Utiliza los filtros disponibles para explorar rápidamente los perfiles más relevantes. 
        Encuentra candidatos según su <span class="font-semibold text-white">categoría profesional</span>, 
        <span class="font-semibold text-white">habilidades</span> o <span class="font-semibold text-white">idiomas</span>.
    </p>
    <p class="text-sm text-gray-400 mt-1 italic">
        Esta sección es exclusiva para cuentas de empresa o reclutadores.
    </p>
</div>
<!-- Filtros (mejorados visualmente) -->
<div class="bg-gray-800 p-6 rounded-lg shadow space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Filtro: Categoría Profesional -->
        <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
            <label class="block text-sm font-semibold text-white mb-1">Categoría Profesional</label>
            <p class="text-xs text-gray-400 mb-2">
                Filtra por sector profesional del candidato.
            </p>
            <select wire:model="categoria_profesion" wire:change="$refresh"
                    class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria }}">{{ $categoria }}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro: Habilidades -->
        <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
            <label class="block text-sm font-semibold text-white mb-1">Habilidades</label>
            <p class="text-xs text-gray-400 mb-2">
                Selecciona una o varias habilidades específicas.
            </p>
            <select wire:model="habilidades_seleccionadas"
                    wire:change="$refresh"
                    multiple
                    size="6"
                    class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                @foreach($habilidades_disponibles as $hab)
                    <option value="{{ $hab }}">{{ $hab }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-2 italic">
                Usa <kbd>Ctrl</kbd> o <kbd>Cmd</kbd> para selección múltiple.
            </p>
        </div>

        <!-- Filtro: Idiomas -->
        <div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
            <label class="block text-sm font-semibold text-white mb-1">Idiomas</label>
            <p class="text-xs text-gray-400 mb-2">
                Selecciona uno o varios idiomas que debe manejar el candidato.
            </p>
            <select wire:model="idiomas_seleccionados"
                    wire:change="$refresh"
                    multiple
                    size="6"
                    class="w-full rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
                @foreach($idiomas_disponibles as $idioma)
                    <option value="{{ $idioma }}">{{ $idioma }}</option>
                @endforeach
            </select>
            <p class="text-xs text-gray-500 mt-2 italic">
                Usa <kbd>Ctrl</kbd> o <kbd>Cmd</kbd> para selección múltiple.
            </p>
        </div>

    </div>

    <!-- Filtro: Solo favoritos -->
    <div class="mt-4">
        <label class="inline-flex items-center text-white">
            <input type="checkbox" wire:model="solo_favoritos" wire:change="$refresh" class="form-checkbox text-blue-500 bg-gray-800 border-gray-600 rounded">
            <span class="ml-2 text-sm">Mostrar solo favoritos</span>
        </label>
    </div>
</div>


@if ($mensaje)
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="bg-green-600 text-white px-4 py-2 rounded shadow text-sm mb-4"
    >
        {{ $mensaje }}
    </div>
@endif

 <!-- Contenedor general de resultados de búsqueda -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    {{-- Recorremos los CVs obtenidos según el filtro aplicado --}}
    @forelse($cvs as $cv)

       <!-- Tarjeta individual del CV -->
        <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md hover:shadow-lg transition space-y-2">

            {{-- Título o profesión principal del CV --}}
            <h3 class="font-bold text-lg">{{ $cv->titulo }}</h3>

            {{-- Nombre del usuario propietario del CV --}}
            <p class="text-sm text-gray-400">{{ $cv->user->name }}</p>

            {{-- Categoría profesional (si existe) --}}
            @if($cv->categoria_profesion)
                <p class="text-sm text-gray-500">
                    <span class="font-semibold">Categoría:</span> {{ $cv->categoria_profesion }}
                </p>
            @endif

            {{-- Habilidades principales (hasta 3 como badges) --}}
            @if($cv->habilidades)
                <div class="mt-2">
                    <p class="text-xs text-gray-400 font-semibold mb-1">Habilidades:</p>
                    <ul class="flex flex-wrap gap-2">
                        @foreach (array_slice(json_decode($cv->habilidades, true) ?? [], 0, 5) as $hab)
                            <li class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">
                                {{ $hab }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Idiomas --}}
            @if($cv->idiomas && is_string($cv->idiomas))
                @php
                    $idiomas = json_decode($cv->idiomas, true);
                @endphp
                @if(is_array($idiomas) && count($idiomas))
                    <div class="mt-2">
                        <p class="text-xs text-gray-400 font-semibold mb-1">Idiomas:</p>
                        <ul class="flex flex-wrap gap-2">
                            @foreach ($idiomas as $idioma)
                                <li class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">
                                    {{ $idioma }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endif

            {{-- Breve descripción del perfil profesional --}}
            <p class="text-sm mt-2 text-gray-300">
                {{ \Illuminate\Support\Str::limit($cv->descripcion, 100) }}
            </p>

           <div class="flex justify-between items-center mt-4">
    <a href="{{ route('cv.show', ['slug' => $cv->slug]) }}"
       class="text-blue-400 hover:underline text-sm inline-flex items-center gap-1">
        👁️ Ver CV
    </a>

    @if(in_array(auth()->user()->role, ['empresa', 'admin']))
        <button wire:click="toggleFavorito({{ $cv->id }})"
                class="flex items-center gap-1 px-2 py-1 text-yellow-400 text-base bg-gray-700 hover:bg-yellow-500 hover:text-white transition rounded-full"
                title="{{ in_array($cv->id, $favoritos_ids) ? 'Quitar de favoritos' : 'Agregar a favoritos' }}">
            <span class="text-xl">
                {{ in_array($cv->id, $favoritos_ids) ? '★' : '☆' }}
            </span>
            <span class="text-sm hidden sm:inline">
                {{ in_array($cv->id, $favoritos_ids) ? 'Guardado' : 'Favorito' }}
            </span>
        </button>
    @endif
</div>

        </div>

    {{-- Si no hay resultados con los filtros actuales --}}
    @empty
        <p class="text-white">No se encontraron CVs con los filtros aplicados.</p>
    @endforelse
</div>

<!-- Botón flotante de Sivi -->
<a href="https://chat.openai.com/g/g-682e161092d08191bef1a1f6f879ae6f-sivi-asistente-cvbook"
   target="_blank"
   style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; background: #4f46e5; color: white; padding: 12px 18px; border-radius: 9999px; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.25); text-decoration: none;">
    🧠 Habla con Sivi
</a>






