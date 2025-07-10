<div class="space-y-6">

    <!-- Detalle de Vacante -->
    <div class="bg-gray-800 p-6 rounded-lg shadow space-y-4">
        <h2 class="text-2xl font-bold text-white">📌 {{ $vacante->titulo }}</h2>

        <div class="text-sm text-gray-300 space-y-2">
            <p><span class="font-semibold text-white">Empresa:</span> {{ $vacante->empresa->name ?? 'No especificada' }}</p>
            <p><span class="font-semibold text-white">Ubicación:</span> {{ $vacante->ubicacion ?? 'No definida' }}</p>
            <p><span class="font-semibold text-white">Modalidad:</span> {{ $vacante->modalidad ?? 'No definida' }}</p>
            <p><span class="font-semibold text-white">Tipo de contratación:</span> {{ $vacante->tipo_contrato ?? 'No definido' }}</p>
            @if($vacante->categoria)
                <p><span class="font-semibold text-white">Categoría:</span> {{ $vacante->categoria }}</p>
            @endif
        </div>

        <div>
            <h3 class="text-lg font-semibold text-white mt-4 mb-1">📝 Descripción del Puesto</h3>
            <div class="text-sm text-gray-300 whitespace-pre-line">
                {!! nl2br(e($vacante->descripcion)) !!}
            </div>
        </div>
    </div>

    <!-- Sección para postularse -->
    @auth
        @if (!$ya_postulado)
            <div class="bg-gray-800 p-6 rounded-lg shadow space-y-4">
                <h3 class="text-lg font-bold text-white">📤 Postularse a esta vacante</h3>

                @if($cvs_disponibles->isEmpty())
                    <p class="text-sm text-red-400">⚠️ Debes crear un CV en tu cuenta antes de postularte.</p>
                @else
                    <div class="space-y-2">
                        <label for="cv" class="text-sm text-white font-semibold">Selecciona el CV que deseas enviar:</label>
                        <select id="cv" wire:model="cv_seleccionado" class="w-full rounded border border-gray-600 bg-gray-800 text-white px-3 py-2">
                            <option value="">Selecciona uno...</option>
                            @foreach ($cvs_disponibles as $cv)
                                <option value="{{ $cv->id }}">{{ $cv->titulo }} ({{ $cv->categoria_profesion }})</option>
                            @endforeach
                        </select>

                        <button wire:click="postularse"
                                class="mt-2 inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded-md shadow transition">
                            📩 Enviar Postulación
                        </button>
                    </div>
                @endif

                @if($mensaje)
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                         class="mt-4 text-sm text-white bg-gray-700 rounded px-4 py-2 shadow">
                        {{ $mensaje }}
                    </div>
                @endif
            </div>
        @else
            <div class="bg-gray-800 p-6 rounded-lg shadow">
                <p class="text-green-400 font-semibold">✅ Ya te has postulado a esta vacante.</p>
            </div>
        @endif
    @else
        <div class="bg-gray-800 p-6 rounded-lg shadow">
            <p class="text-yellow-400">🔒 Debes iniciar sesión como usuario para postularte.</p>
        </div>
    @endauth

</div>
