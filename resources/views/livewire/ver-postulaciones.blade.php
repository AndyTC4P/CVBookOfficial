<div class="space-y-6">
    <div class="bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-white">📥 Postulaciones a "{{ $vacante->titulo }}"</h2>
    </div>

    @forelse($postulaciones as $postulacion)
        <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 flex justify-between items-center hover:border-indigo-500 transition">
            <div>
                <p class="text-white font-semibold">{{ $postulacion->usuario->name }}</p>
              <p class="text-sm text-gray-400">Carrera / Profesión: {{ $postulacion->cv->titulo ?? 'Sin título' }}</p>
                <p class="text-sm text-gray-500">📅 Postulado el {{ \Carbon\Carbon::parse($postulacion->fecha_postulacion)->format('d/m/Y H:i') }}</p>
            </div>
            <a href="{{ route('cv.show', ['slug' => $postulacion->cv->slug]) }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
                👁 Ver CV
            </a>
        </div>
    @empty
        <p class="text-gray-400 text-sm">Aún no hay postulaciones para esta vacante.</p>
    @endforelse
</div>


