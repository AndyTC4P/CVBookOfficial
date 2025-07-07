<div class="space-y-6">

    <!-- Sección: Crear / Editar Vacante -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <h2 class="text-2xl font-bold text-white">📄 {{ $modo_edicion ? 'Editar Vacante' : 'Nueva Vacante' }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Título -->
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Título del Puesto</label>
                <input type="text" wire:model.defer="titulo" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
                @error('titulo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Categoría</label>
                <input type="text" wire:model.defer="categoria" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
            </div>

            <!-- Ubicación -->
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Ubicación</label>
                <input type="text" wire:model.defer="ubicacion" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
            </div>

            <!-- Modalidad -->
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Modalidad</label>
                <select wire:model.defer="modalidad" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
                    <option value="">Selecciona una opción</option>
                    <option value="Presencial">Presencial</option>
                    <option value="Remoto">Remoto</option>
                    <option value="Híbrido">Híbrido</option>
                </select>
            </div>

            <!-- Tipo de contrato -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-white mb-1">Tipo de Contrato</label>
                <input type="text" wire:model.defer="tipo_contrato" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
            </div>

            <!-- Descripción -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-white mb-1">Descripción</label>
                <textarea wire:model.defer="descripcion" rows="4" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2"></textarea>
                @error('descripcion') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-2">
            @if ($modo_edicion)
                <button wire:click="update" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow text-sm">💾 Actualizar</button>
                <button wire:click="resetFields" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md shadow text-sm">❌ Cancelar</button>
            @else
                <button wire:click="save" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md shadow text-sm">💾 Guardar Vacante</button>
            @endif
        </div>
    </div>

    <!-- Lista de Vacantes Publicadas -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-6">
        <h2 class="text-2xl font-bold text-white">📋 Vacantes Publicadas</h2>

        @forelse ($vacantes as $vacante)
            <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-indigo-500 transition">
                <div class="space-y-1">
                    <h3 class="text-lg text-indigo-400 font-semibold">{{ $vacante->titulo }}</h3>
                    <p class="text-sm text-gray-300">{{ $vacante->ubicacion }} • {{ $vacante->modalidad }} • {{ $vacante->tipo_contrato }}</p>
                    @if ($vacante->categoria)
                        <p class="text-sm text-gray-400 italic">Categoría: {{ $vacante->categoria }}</p>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2 items-center">
                    <button wire:click="edit({{ $vacante->id }})"
                        class="px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-gray-900 text-sm font-semibold rounded-md shadow">
                        ✏️ Editar
                    </button>

                    <button wire:click="delete({{ $vacante->id }})"
                        class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-md shadow">
                        🗑️ Eliminar
                    </button>

                    @if ($vacante->postulaciones->count())
                        <a href="{{ route('empresa.vacantes.postulaciones', ['id' => $vacante->id]) }}"
                           class="px-3 py-1.5 bg-indigo-500 hover:bg-indigo-600 text-white text-sm font-semibold rounded-md shadow">
                            📥 {{ $vacante->postulaciones->count() }} Postulantes
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-400">Aún no has publicado vacantes.</p>
        @endforelse
    </div>
</div>


