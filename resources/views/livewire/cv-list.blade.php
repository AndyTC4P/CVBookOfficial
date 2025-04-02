<div>
    @if(session('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-200 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if (session('message'))
        <div class="p-4 mb-4 text-green-800 bg-green-200 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    @if ($cvs->isEmpty())
        <p class="text-gray-500 dark:text-gray-400">Aún no has creado ningún CV.</p>
    @else
    <ul class="space-y-4">
    @foreach ($cvs as $cv)
        <li class="p-4 bg-gray-100 dark:bg-gray-700 rounded-md shadow-md flex justify-between items-center">
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">
                    {{ $cv->nombre }} {{ $cv->apellido }}
                </h4>
                <p class="text-sm text-gray-300">{{ $cv->titulo ?? 'Sin título' }}</p>
                <p class="text-xs text-gray-400">Actualizado: {{ $cv->updated_at->format('d/m/Y H:i') }}</p>
                <span class="text-sm {{ $cv->publico ? 'text-green-500' : 'text-red-500' }}">
                    {{ $cv->publico ? 'Público' : 'Privado' }}
                </span>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('cv.show', $cv->id) }}"
                   class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600">
                    👀 Ver CV
                </a>

                @if($cv->publico)
    <div x-data="{ show: false }" class="relative">
        <button
            @click="
                navigator.clipboard.writeText('{{ route('cv.show', $cv->id) }}');
                show = true;
                setTimeout(() => show = false, 3000);
            "
            class="px-4 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600"
        >
            📋 Copiar Enlace
        </button>

        <span
            x-show="show"
            x-transition
            class="absolute left-1/2 -translate-x-1/2 mt-2 bg-green-600 text-white text-xs rounded px-2 py-1 shadow"
        >
            Enlace copiado
        </span>
    </div>
@endif

                <a href="{{ route('cv.edit', $cv->id) }}"
                   class="px-4 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">
                    ✏️ Editar CV
                </a>
                <button onclick="if(confirm('¿Estás seguro de que deseas eliminar este CV?')) @this.call('eliminarCv', {{ $cv->id }})"
                        class="px-4 py-2 bg-red-500 text-white rounded-md shadow hover:bg-red-600">
                    🗑 Eliminar
                </button>
            </div>
        </li>
    @endforeach
</ul>

    @endif
</div>




