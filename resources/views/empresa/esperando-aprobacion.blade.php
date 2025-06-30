<x-guest-layout>
    <div class="max-w-lg mx-auto mt-20 bg-white dark:bg-gray-800 p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Cuenta en Revisión</h1>

        <p class="text-sm font-medium text-green-600 dark:text-green-400 mb-4">✅ Paso 2 de 2</p>

        <p class="text-gray-600 dark:text-gray-300">
            Gracias por registrarte en <strong>CV Book Empresarial</strong>.
            Tu cuenta está siendo revisada por nuestro equipo para verificar que pertenece a una empresa real.
        </p>
        <p class="text-gray-600 dark:text-gray-300 mt-4">
           Te notificaremos por correo cuando tu cuenta sea activada. Mientras tanto, puedes revisar el estado manualmente más adelante.
        </p>

        <form method="POST" action="{{ route('check.aprobacion') }}" class="mt-6">
            @csrf
            <x-primary-button>
                🔄 Revisar estado ahora
            </x-primary-button>
        </form>

        <p class="text-sm text-gray-500 mt-6 italic">Esto nos ayuda a mantener la calidad y seguridad del sistema.</p>
    </div>
</x-guest-layout>



