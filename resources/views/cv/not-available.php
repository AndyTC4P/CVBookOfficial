<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">❌ Contenido No Disponible</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
            <div class="flex flex-col items-center">
                <!-- Ícono de advertencia -->
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2" 
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M12 9v2m0 4h.01M4.93 19h14.14a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.2 16a2 2 0 001.73 3z">
                    </path>
                </svg>

                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mt-4">
                    Este contenido no está disponible
                </h3>

                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    El CV que intentas ver es privado o no existe.
                </p>

                <a href="{{ route('dashboard') }}"
                   class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600">
                    🔙 Regresar al Menú
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
