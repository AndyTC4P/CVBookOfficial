<div class="space-y-6">
    <!-- Filtros -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-white">Categoría Profesional</label>
                <select wire:model="categoria_profesion" class="w-full mt-1 rounded border-gray-600 bg-gray-900 text-white">
                    <p class="text-white text-xs mt-2">Seleccionado: <span wire:poll.500ms>{{ $categoria_profesion }}</span></p>
                    <option value="">Seleccione una categoría</option>
                    @foreach($this->categorias as $categoria)
                        <option value="{{ $categoria }}">{{ $categoria }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

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

                    {{-- Decodificamos las habilidades (JSON) y mostramos un máximo de 3 --}}
                    <ul class="flex flex-wrap gap-2">
                        @foreach (array_slice(json_decode($cv->habilidades, true) ?? [], 0, 3) as $hab)
                            <li class="px-2 py-1 bg-blue-600 text-white text-xs rounded-full">
                                {{ $hab }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
{{-- Idiomas (combinados: predefinidos + texto libre) --}}
@if($cv->idiomas && is_string($cv->idiomas))
    @php
        $idiomas = json_decode($cv->idiomas, true);
    @endphp

    @if(is_array($idiomas) && count($idiomas))
        <div class="mt-2">
            <p class="text-xs text-gray-400 font-semibold mb-1">Idiomas:</p>

            {{-- Mostramos todos los idiomas como etiquetas (chips) --}}
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

            {{-- Breve descripción del perfil profesional (limitada a 100 caracteres) --}}
            <p class="text-sm mt-2 text-gray-300">
                {{ \Illuminate\Support\Str::limit($cv->descripcion, 100) }}
            </p>

            {{-- Enlace para ver el CV completo --}}
            <a href="{{ route('cv.show', ['slug' => $cv->slug]) }}"
               class="text-blue-400 hover:underline text-sm mt-3 inline-block">
                👁️ Ver CV
            </a>
        </div>

    {{-- Si no hay resultados con los filtros actuales --}}
    @empty
        <p class="text-white">No se encontraron CVs con los filtros aplicados.</p>
    @endforelse
</div>





