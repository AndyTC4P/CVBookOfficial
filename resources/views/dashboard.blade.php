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

    <!-- Contenido según el rol -->
    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

            @php $user = auth()->user(); @endphp

            @if($user->isAdmin())
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">🎛️ Bienvenido {{ $user->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                        Desde aquí puedes gestionar usuarios y revisar todos los currículums.
                    </p>
                    <a href="{{ route('admin.dashboard') }}"
                       class="mt-6 inline-block bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-700 transition">
                        Ir al Panel de Administración
                    </a>
                </div>

            @elseif($user->isEmpresa())
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">🏢 Bienvenido {{ $user->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                        Puedes buscar candidatos filtrando por categoría profesional, habilidades e idiomas.
                    </p>
                    <a href="{{ url('/admin/busqueda-cvs') }}"
                       class="mt-6 inline-block bg-yellow-500 text-white px-5 py-2 rounded-md hover:bg-yellow-600 transition">
                        Buscar Currículums
                    </a>
                </div>

            @else
                <!-- Usuario normal -->
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">👋 Bienvenido {{ $user->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                        Bienvenido a CV Book. Puedes crear o ver tus CVs existentes.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-4">
                        <a href="{{ url('/cv/create') }}"
                           class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                            Crear Nuevo CV
                        </a>
                        <a href="{{ url('/cv') }}"
                           class="bg-blue-300 text-white px-5 py-2 rounded-md hover:bg-blue-400 transition">
                            Ver Mis CVs
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>







