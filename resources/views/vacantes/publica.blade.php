<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6 space-y-6">

     <div class="bg-gray-900 border border-gray-700 rounded-lg p-6 space-y-6 shadow-md mt-10">

    <h1 class="text-2xl font-bold text-white mb-2">📌 {{ $vacante->titulo }}</h1>

    <ul class="space-y-1 text-base text-white">
        <li><span class="font-semibold">Empresa:</span> {{ $vacante->empresa->nombre_empresa ?? $vacante->empresa->name ?? 'No especificada' }}</li>
        <li><span class="font-semibold">Ubicación:</span> {{ $vacante->ubicacion ?? 'No especificada' }}</li>
        <li><span class="font-semibold">Modalidad:</span> {{ $vacante->modalidad ?? 'No definida' }}</li>
        <li><span class="font-semibold">Tipo de contratación:</span> {{ $vacante->tipo_contrato ?? 'No definido' }}</li>
        <li><span class="font-semibold">Categoría:</span> {{ $vacante->categoria ?? 'No especificada' }}</li>
    </ul>

    <div>
        <h2 class="text-lg font-semibold text-white mb-1">📄 Descripción del puesto</h2>
        <p class="text-base text-gray-300 whitespace-pre-line">{{ $vacante->descripcion }}</p>
    </div>

    @auth
        @if (auth()->user()->isUsuario())
            <div class="pt-4">
                <a href="{{ route('vacantes.detalle', $vacante->id) }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-5 py-2 rounded shadow transition duration-150">
                    Postularme ahora
                </a>
            </div>
        @endif
   @else
    <div class="mt-4 text-center space-y-2">
        <p class="text-sm text-white">¿Te interesa esta vacante?</p>

        <a href="{{ route('register') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow text-sm font-semibold">
            Crea tu cuenta ahora y envía tu CV
        </a>
        <br>
<p class="text-sm text-white">ó</p>
        <a href="{{ route('login') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded shadow text-sm font-semibold">
            Iniciar sesión
        </a>
    </div>
@endauth


</div>



    </div>
</x-app-layout>

