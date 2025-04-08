<x-app-layout>
    <div class="relative bg-gray-900 text-white min-h-screen flex flex-col items-center justify-center">
        <!-- Sección Principal -->
        <div class="text-center px-6">
            <h1 class="text-4xl font-bold mb-4">🚀 Impulsa tu carrera con un CV profesional</h1>
            <p class="text-lg text-gray-300">Crea y comparte tu CV en segundos.</p>
            
           <!-- Botones de Registro e Inicio de Sesión -->
<div class="mt-6 flex flex-col sm:flex-row gap-4 justify-center">
    <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transition-all text-center">
        ✨ Crear cuenta
    </a>
    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg shadow-lg hover:bg-blue-600 transition-all text-center">
        🔑 Iniciar sesión
    </a>
</div>


        <!-- Sección de Beneficios -->
        <div class="mt-16 max-w-5xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">🌍 Comparte con un enlace</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Tu CV está disponible en línea para que lo compartas fácilmente con empresas.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">🛠️ Fácil de actualizar</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Modifica tu información en cualquier momento, sin necesidad de enviar documentos.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">🔒 Control de privacidad</h3>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Decide si tu CV es público o privado con un solo clic.</p>
            </div>
        </div>
    </div>
    {{-- Enlace a preguntas frecuentes --}}
<div class="mt-6 text-center">
    <p class="text-sm text-gray-400">
        ¿Tienes preguntas? 
        <a href="{{ route('faq') }}" class="text-blue-400 hover:text-blue-200 font-semibold underline">
            Consulta nuestra página de Preguntas Frecuentes
        </a>
    </p>
</div>

</x-app-layout>
