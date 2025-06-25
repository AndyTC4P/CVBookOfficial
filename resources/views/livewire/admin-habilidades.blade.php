<div class="space-y-2">
    @forelse($habilidades as $habilidad)
        <div class="flex justify-between items-center px-4 py-2 rounded 
                    @if($habilidad->restringida) bg-red-800 @else bg-gray-800 @endif">
            <span>{{ $habilidad->nombre }}</span>
            <label class="flex items-center gap-2">
                <input type="checkbox" wire:click="toggleRestriccion({{ $habilidad->id }})" 
                       @if($habilidad->restringida) checked @endif>
                <span class="text-sm">Restringida</span>
            </label>
        </div>
    @empty
        <p class="text-sm text-gray-400 italic">No hay habilidades registradas aún.</p>
    @endforelse
</div>

