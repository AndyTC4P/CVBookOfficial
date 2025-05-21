<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto space-y-4">
    <h2 class="text-xl font-bold">🧠 Asistente de Búsqueda de Talento</h2>

    <input type="text" wire:model="mensaje" placeholder="Describe lo que necesitas..."
           class="w-full border rounded px-4 py-2" />

    <button wire:click="buscar"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Buscar CVs
    </button>

    @if ($cargando)
        <p class="text-gray-600">Buscando perfiles relevantes...</p>
    @endif

    @if ($resultados)
        <div class="mt-4">
            <h3 class="font-semibold mb-2">Resultados:</h3>
            @forelse ($resultados as $cv)
                <div class="border border-gray-300 p-3 rounded mb-2">
                    <strong>{{ $cv['nombre'] }} {{ $cv['apellido'] }}</strong><br>
                    {{ $cv['titulo'] }}<br>
                    <small>Habilidades: {{ implode(', ', json_decode($cv['habilidades'], true) ?? []) }}</small>
                </div>
            @empty
                <p>No se encontraron coincidencias.</p>
            @endforelse
        </div>
    @endif
</div>
