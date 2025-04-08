<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            ❌ Contenido No Disponible
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-8 text-center text-gray-800 dark:text-gray-200 space-y-6">

            <!-- Ícono de advertencia -->
            <div class="flex justify-center">
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M4.93 19h14.14a2 2 0 001.73-3L13.73 4a2 2 0 00-3.46 0L3.2 16a2 2 0 001.73 3z" />
                </svg>
            </div>

            <h3 class="text-xl font-semibold">
                Este currículum no está disponible
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400 max-w-xl mx-auto leading-relaxed">
                El enlace que intentas visitar corresponde a un CV que ha sido marcado como <strong>privado</strong> por su creador, o bien no existe en nuestra base de datos.
            </p>

            <p class="text-sm text-gray-600 dark:text-gray-400 max-w-xl mx-auto leading-relaxed">
                Si conoces a la persona propietaria del CV, te recomendamos contactarla directamente para solicitar acceso o confirmar el enlace.
            </p>

            <div class="mt-6">
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:shadow-lg hover:bg-blue-700 hover:scale-105 active:scale-95 transition duration-200 ease-in-out">
                    🔙 Regresar al Menú Principal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

