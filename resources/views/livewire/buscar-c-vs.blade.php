
<div x-data x-cloak>
    <!-- Pantalla de carga -->
    <div x-show="@entangle('cargando').defer" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-90 flex items-center justify-center">
        <div class="text-white text-xl font-semibold animate-pulse">
            🔄 Cargando información...
        </div>
    </div>

    <!-- Contenido principal solo visible cuando termina de cargar -->
    <div x-show="!@entangle('cargando').defer" x-cloak>
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
    <button disabled
        class="inline-flex items-center gap-2 bg-gray-500 text-white text-sm font-medium px-4 py-1.5 rounded-md shadow opacity-70 cursor-not-allowed">
        💬 Próximamente
    </button>
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

          <!-- Filtro: Habilidades -->
<div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
    <label class="block text-sm font-semibold text-white mb-1">
        Habilidades
        <span class="text-gray-400 font-normal text-xs">(Puedes escribir y/o seleccionar de la lista de habilidades. Usa Ctrl (en Windows) o Cmd (en Mac) para selección múltiple.)</span>
    </label>

    <div 
        x-data="{
            texto: '',
            sugerencias: @entangle('habilidades_disponibles'),
            seleccionadas: @entangle('habilidades_seleccionadas'),
            get filtradas() {
                return this.texto.length > 0 
                    ? this.sugerencias.filter(h => h.toLowerCase().includes(this.texto.toLowerCase()) && !this.seleccionadas.includes(h)) 
                    : [];
            },
            agregar(hab) {
                if (!this.seleccionadas.includes(hab)) {
                    this.seleccionadas.push(hab);
                }
                this.texto = '';
            },
            eliminar(hab) {
                this.seleccionadas = this.seleccionadas.filter(h => h !== hab);
            }
        }" class="relative">

        <!-- Input con autocompletado -->
        <input type="text"
               x-model="texto"
               placeholder="Escribe una habilidad..."
               class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2 mb-2"
               @keydown.enter.prevent="if (filtradas.length) agregar(filtradas[0])">

        <!-- Lista de sugerencias -->
        <ul x-show="filtradas.length" class="absolute bg-gray-700 z-10 w-full rounded shadow max-h-40 overflow-auto border border-gray-600">
            <template x-for="hab in filtradas" :key="hab">
                <li @click="agregar(hab)" class="px-4 py-2 hover:bg-gray-600 text-sm text-white cursor-pointer" x-text="hab"></li>
            </template>
        </ul>

        <!-- Select múltiple clásico -->
        <select multiple
                size="5"
                wire:model="habilidades_seleccionadas"
                class="w-full mt-2 rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
            @foreach($habilidades_disponibles as $hab)
                <option value="{{ $hab }}">{{ $hab }}</option>
            @endforeach
        </select>

        <!-- Etiquetas visuales -->
        <div class="flex flex-wrap gap-2 mt-3">
            <template x-for="hab in seleccionadas" :key="hab">
                <span class="bg-blue-600 text-white px-2 py-1 text-xs rounded-full flex items-center gap-1">
                    <span x-text="hab"></span>
                    <button @click="eliminar(hab)" class="hover:text-red-400 text-white">×</button>
                </span>
            </template>
        </div>
    </div>
</div>



           <!-- Filtro: Idiomas -->
<div class="bg-gray-900 p-4 rounded-lg border border-gray-700">
    <label class="block text-sm font-semibold text-white mb-1">
        Idiomas
        <span class="text-gray-400 font-normal text-xs">(Puedes escribir, seleccionar de la lista o ambas. Usa Ctrl o Cmd para selección múltiple.)</span>
    </label>

    <div 
        x-data="{
            texto: '',
            sugerencias: @entangle('idiomas_disponibles'),
            seleccionadas: @entangle('idiomas_seleccionados'),
            get filtradas() {
                return this.texto.length > 0 
                    ? this.sugerencias.filter(i => i.toLowerCase().includes(this.texto.toLowerCase()) && !this.seleccionadas.includes(i)) 
                    : [];
            },
            agregar(idioma) {
                if (!this.seleccionadas.includes(idioma)) {
                    this.seleccionadas.push(idioma);
                }
                this.texto = '';
            },
            eliminar(idioma) {
                this.seleccionadas = this.seleccionadas.filter(i => i !== idioma);
            }
        }" class="relative">

        <!-- Input con autocompletado -->
        <input type="text"
               x-model="texto"
               placeholder="Escribe un idioma..."
               class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2 mb-2"
               @keydown.enter.prevent="if (filtradas.length) agregar(filtradas[0])">

        <!-- Lista de sugerencias -->
        <ul x-show="filtradas.length" class="absolute bg-gray-700 z-10 w-full rounded shadow max-h-40 overflow-auto border border-gray-600">
            <template x-for="idioma in filtradas" :key="idioma">
                <li @click="agregar(idioma)" class="px-4 py-2 hover:bg-gray-600 text-sm text-white cursor-pointer" x-text="idioma"></li>
            </template>
        </ul>

        <!-- Select múltiple clásico -->
        <select multiple
                size="5"
                wire:model="idiomas_seleccionados"
                class="w-full mt-2 rounded border-gray-600 bg-gray-800 text-white px-3 py-2">
            @foreach($idiomas_disponibles as $idioma)
                <option value="{{ $idioma }}">{{ $idioma }}</option>
            @endforeach
        </select>

        <!-- Etiquetas visuales -->
        <div class="flex flex-wrap gap-2 mt-3">
            <template x-for="idioma in seleccionadas" :key="idioma">
                <span class="bg-green-600 text-white px-2 py-1 text-xs rounded-full flex items-center gap-1">
                    <span x-text="idioma"></span>
                    <button @click="eliminar(idioma)" class="hover:text-red-400 text-white">×</button>
                </span>
            </template>
        </div>
    </div>
</div>

<!-- Botones y mensaje -->
<div class="mt-4 flex flex-col gap-2">
    <div class="flex gap-4 items-center flex-nowrap overflow-x-auto">
        <button
    wire:click="aplicarFiltros"
    class="px-4 py-2 bg-green-600 text-white rounded-md font-semibold shadow hover:bg-green-700 text-sm">
    🔍 Iniciar búsqueda
</button>


        <button
            wire:click="$toggle('solo_favoritos')"
            class="px-4 py-2 rounded-md font-semibold shadow transition text-sm
                   {{ $solo_favoritos 
                        ? 'bg-yellow-400 text-gray-900 hover:bg-yellow-500 ring-1 ring-yellow-300' 
                        : 'bg-gray-700 text-white hover:bg-gray-600' }}">
            {{ $solo_favoritos ? '✓ Mostrando solo favoritos' : 'Mostrar solo favoritos' }}
        </button>

        <button
            wire:click="reiniciarFiltros"
            class="px-4 py-2 bg-red-600 text-white rounded-md font-semibold shadow hover:bg-red-700 text-sm">
            🔄 Reiniciar filtros
        </button>
    </div>

    <p class="text-xs text-gray-400 italic -mt-1 ms-1">
        También puedes ver todos los CVs disponibles sin usar filtros usando el boton "Iniciar busqueda".
    </p>
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

    </div> <!-- ← Este cierra el div contenedor de filtros -->

<!-- Resultados FUERA del contenedor principal -->
@if ($mostrarResultados || $solo_favoritos)
<div class="bg-gray-900 mt-10 p-6 rounded-lg shadow-lg border border-gray-700">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <p class="text-lg text-white font-semibold mb-4">
            📄 Se encontraron {{ $cvs->count() }} {{ Str::plural('CV', $cvs->count()) }} con los filtros aplicados.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($cvs as $cv)
            <div class="bg-gray-800 text-white rounded-xl border border-gray-700 hover:border-indigo-500 p-4 shadow-md hover:shadow-xl transition duration-300 flex flex-col justify-between h-[330px]">
                <div class="flex-grow space-y-2">
                    <h3 class="font-bold text-lg">{{ $cv->user->name }}</h3>
                    <p class="text-sm text-gray-400">{{ $cv->titulo }}</p>

                    @if($cv->categoria_profesion)
                    <p class="text-sm text-gray-400">
                        <span class="font-semibold text-white">Categoría:</span> {{ $cv->categoria_profesion }}
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
                            @if(is_array($idioma) && isset($idioma['nombre']))
                            <li class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">
                                {{ $idioma['nombre'] }}{{ isset($idioma['nivel']) ? ' – ' . ucfirst($idioma['nivel']) : '' }}
                            </li>
                            @elseif(is_string($idioma))
                            <li class="px-2 py-1 bg-green-600 text-white text-xs rounded-full">
                                {{ $idioma }}
                            </li>
                            @endif
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
    </div>
</div>
    </div> <!-- Cierre del contenido visible -->
</div> <!-- Cierre de x-data -->
@endif














