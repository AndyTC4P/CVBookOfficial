<x-app-layout> 
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
            ✏️ Editar CV
        </h2>
    </x-slot>

    <!-- Banner -->
    <div class="max-w-7xl mx-auto mt-4">
        <img src="{{ asset('images/bannercv.png') }}"
             alt="Banner de edición de CV"
             class="rounded-md object-cover w-full h-[140px]" />
    </div>

    <!-- Encabezado amigable -->
    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Actualiza tu CV en cualquier momento</h3>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
            Mantén tu información al día y mejora tus oportunidades laborales 🚀
        </p>
    </div>

    <!-- Componente Livewire -->
    <div class="pb-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @livewire('cv-form', ['cv' => $cv])
        </div>
    </div>
</x-app-layout>
