<x-app-layout>
    <!-- Hero Section with Video Background -->
    <div class="relative h-screen overflow-hidden bg-gray-800 text-white flex items-center justify-center">
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-70 dark:opacity-40">
            <source src="{{ asset('videos/bg-cvbook.mp4') }}" type="video/mp4">
        </video>
        <div class="relative z-10 text-center px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Impulsa tu carrera con CV Book</h1>
            <p class="text-lg md:text-xl text-gray-100 max-w-2xl mx-auto mb-8">Construye un currículum atractivo, compártelo al instante y abre la puerta a nuevas oportunidades.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-semibold shadow-md">Crear cuenta</a>
                <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-700 hover:bg-gray-800 rounded-lg font-semibold shadow-md">Iniciar sesión</a>
            </div>
        </div>
    </div>

    <!-- Getting Started Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-10">¿No sabes por dónde empezar?</h2>
            <div class="grid gap-8 md:grid-cols-2">
                <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Soy candidato</h3>
                    <p class="text-gray-600 dark:text-gray-300">Regístrate para crear, actualizar y compartir tu CV desde cualquier lugar.</p>
                </div>
                <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Soy empresa</h3>
                    <p class="text-gray-600 dark:text-gray-300">Busca candidatos, administra tus favoritos y contacta al talento ideal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Beneficios de usar CV Book</h2>
            <ul class="space-y-4 text-lg">
                <li class="flex items-start"><span class="text-green-500 mr-2">✔️</span><span class="text-gray-700 dark:text-gray-300">Accede a tu CV desde cualquier dispositivo.</span></li>
                <li class="flex items-start"><span class="text-green-500 mr-2">✔️</span><span class="text-gray-700 dark:text-gray-300">Comparte tu perfil con un enlace único.</span></li>
                <li class="flex items-start"><span class="text-green-500 mr-2">✔️</span><span class="text-gray-700 dark:text-gray-300">Actualiza tu información en tiempo real.</span></li>
                <li class="flex items-start"><span class="text-green-500 mr-2">✔️</span><span class="text-gray-700 dark:text-gray-300">Controla quién puede ver tu CV.</span></li>
                <li class="flex items-start"><span class="text-green-500 mr-2">✔️</span><span class="text-gray-700 dark:text-gray-300">Recibe notificaciones de interés laboral.</span></li>
            </ul>
        </div>
    </section>

    <!-- Final Call to Action -->
    <section class="py-16 bg-white dark:bg-gray-900 text-center">
        <h2 class="text-3xl font-bold mb-6">Da el siguiente paso en tu carrera</h2>
        <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-lg font-semibold shadow-lg">¡Inicia ya!</a>
    </section>
</x-app-layout>

