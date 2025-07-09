<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ✍️ Panel Principal
        </h2>
    </x-slot>

    <!-- Banner ajustado -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="rounded-lg overflow-hidden">
            <img src="{{ asset('images/bannercv9.webp') }}" alt="Banner CV"
                 class="w-full object-cover" style="max-height: 160px;">
        </div>
    </div>

    <!-- Contenido del Dashboard -->
    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-lg shadow p-6">

            @php $user = auth()->user(); @endphp

            @if($user->isAdmin())
                <h3 class="text-3xl font-extrabold text-white mb-4">🎛️ Bienvenido {{ $user->name }}</h3>
                <p class="text-gray-400 text-sm mb-6">
                    Desde aquí puedes gestionar usuarios y revisar todos los currículums.
                </p>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded shadow font-semibold">
                    Ir al Panel de Administración
                </a>

            @elseif($user->isEmpresa())
                <h3 class="text-3xl font-extrabold text-white mb-2">Bienvenido {{ $user->nombre_empresa ?? $user->name }}</h3>
                <p class="text-gray-400 text-sm mb-6">
                    Encuentra candidatos ideales según las vacantes que deseas cubrir.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Buscar CVs -->
                    <div class="bg-gray-900 border border-gray-700 hover:border-yellow-400 rounded-lg p-6 shadow transition">
                        <h4 class="text-xl font-bold text-white mb-2">🔍 Buscar Currículums</h4>
                        <p class="text-gray-400 text-sm">Explora perfiles usando filtros como habilidades, idiomas o categoría profesional.</p>
                        <a href="{{ url('/admin/busqueda-cvs') }}"
                           class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
                            Ir a búsqueda
                        </a>
                    </div>

                    <!-- Vacantes publicadas -->
                    <div class="bg-gray-900 border border-gray-700 hover:border-indigo-400 rounded-lg p-6 shadow transition">
                        <h4 class="text-xl font-bold text-white mb-2">📄 Vacantes Publicadas</h4>
                        <p class="text-gray-400 text-sm">Administra las vacantes publicadas, revisa postulaciones o crea una nueva.</p>
                       <a href="{{ route('empresa.vacantes') }}"
   class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
    Ver mis vacantes
</a>
                    </div>
                </div>

           @else
    <!-- Usuario normal -->
    <h3 class="text-3xl font-extrabold text-white mb-2">👋 Bienvenido {{ $user->name }}</h3>
    <p class="text-gray-400 text-sm mb-6">
        Bienvenido a CV Book. Aquí puedes gestionar tu currículum, postularte a vacantes y acceder a recursos útiles.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Crear CV -->
        <div class="bg-gray-900 border border-gray-700 hover:border-blue-400 rounded-lg p-6 shadow transition">
            <h4 class="text-xl font-bold text-white mb-2">📝 Crear Nuevo CV</h4>
            <p class="text-gray-400 text-sm">Accede al formulario para crear tu currículum profesional.</p>
            <a href="{{ url('/cv/create') }}"
               class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
                Ir al formulario
            </a>
        </div>

        <!-- Ver CVs -->
        <div class="bg-gray-900 border border-gray-700 hover:border-indigo-400 rounded-lg p-6 shadow transition">
            <h4 class="text-xl font-bold text-white mb-2">📁 Ver Mis CVs</h4>
            <p class="text-gray-400 text-sm">Consulta, edita o descarga tus CVs existentes.</p>
            <a href="{{ url('/cv') }}"
               class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
                Ver currículums
            </a>
        </div>

        <!-- Buscar Vacantes -->
        <div class="bg-gray-900 border border-gray-700 hover:border-green-400 rounded-lg p-6 shadow transition">
            <h4 class="text-xl font-bold text-white mb-2">🔍 Buscar Vacantes</h4>
            <p class="text-gray-400 text-sm">Explora oportunidades laborales y postúlate fácilmente.</p>
            <a href="{{ route('vacantes.lista') }}"
               class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
                Ver vacantes
            </a>
        </div>

        <!-- Preguntas Frecuentes -->
        <div class="bg-gray-900 border border-gray-700 hover:border-yellow-400 rounded-lg p-6 shadow transition">
            <h4 class="text-xl font-bold text-white mb-2">📚 Preguntas Frecuentes</h4>
            <p class="text-gray-400 text-sm">Consulta respuestas sobre cómo usar CV Book y crear un buen CV.</p>
            <a href="{{ route('faq') }}"
               class="mt-4 inline-block bg-white hover:bg-gray-100 text-gray-900 font-semibold px-4 py-2 rounded shadow">
                Ver preguntas frecuentes
            </a>
        </div>
    </div>
@endif


        </div>
    </div>
</x-app-layout>







