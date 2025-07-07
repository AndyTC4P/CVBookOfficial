   <div class="space-y-6">
        <!-- Encabezado -->
        <div class="bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-2xl font-bold text-white">📌 Vacantes Disponibles</h2>
            <p class="text-sm text-gray-300 mt-1">Explora las oportunidades laborales publicadas por empresas registradas.</p>
        </div>

        <!-- Listado de vacantes -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($vacantes as $vacante)
                <div class="bg-gray-900 border border-gray-700 hover:border-indigo-500 rounded-lg p-4 shadow-md transition duration-300 flex flex-col justify-between h-full">
                    <div class="space-y-2">
                        <h3 class="text-lg font-bold text-indigo-400">{{ $vacante->titulo }}</h3>

                        @if($vacante->empresa && $vacante->empresa->name)
                            <p class="text-sm text-gray-400 italic">Empresa: {{ $vacante->empresa->name }}</p>
                        @endif

                        @if($vacante->ubicacion || $vacante->modalidad || $vacante->tipo_contrato)
                            <p class="text-sm text-gray-300">
                                {{ $vacante->ubicacion ?? 'Ubicación no especificada' }} ·
                                {{ $vacante->modalidad ?? 'Modalidad desconocida' }} ·
                                {{ $vacante->tipo_contrato ?? 'Tipo no definido' }}
                            </p>
                        @endif

                        @if($vacante->categoria)
                            <p class="text-sm text-gray-300">Categoría: {{ $vacante->categoria }}</p>
                        @endif

                        <p class="text-sm text-gray-300">
                            {{ \Illuminate\Support\Str::limit(strip_tags($vacante->descripcion), 100) }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('vacantes.detalle', ['id' => $vacante->id]) }}"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-1.5 rounded-md shadow transition">
                            👁️ Ver Vacante
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 col-span-full">No hay vacantes publicadas actualmente.</p>
            @endforelse
        </div>
    </div>


