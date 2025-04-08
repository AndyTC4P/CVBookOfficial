<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🚀 ¿Cómo funciona CV Book?
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-8 text-gray-800 dark:text-gray-200 space-y-10">

                <p class="text-lg leading-relaxed text-center">
                    <span class="font-medium text-blue-600 dark:text-blue-400">CV Book</span> es una herramienta moderna para crear, gestionar y compartir tu currículum profesional en línea.  
                    Sigue estos sencillos pasos para comenzar:
                </p>

                <div class="space-y-6">
                    <div>
                        <h3 class="font-semibold text-lg">1. Regístrate o inicia sesión</h3>
                        <p>Crea tu cuenta con correo electrónico o accede fácilmente mediante Google.</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">2. Completa tu CV</h3>
                        <p>Ve a <strong>Crear CV</strong> desde el menú y completa tus datos: perfil, experiencia, estudios, habilidades e idiomas.</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">3. Comparte tu CV con un clic</h3>
                        <p>Obtén un enlace único para compartir tu CV en tu portafolio, redes o directamente con reclutadores.</p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">4. Edita tu CV en cualquier momento</h3>
                        <p>¿Cambiaste de empleo o aprendiste una nueva habilidad? En CV Book puedes actualizar tu currículum de forma rápida y sencilla, siempre que lo necesites.</p>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="mt-12 border-t border-gray-300 dark:border-gray-700 pt-8 text-center space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold mb-2">¿Listo para comenzar?</h3>
                        <p class="text-gray-600 dark:text-gray-400">Crea tu cuenta ahora y comienza a construir tu presencia profesional en línea.</p>
                    </div>
                    <a href="{{ route('register') }}"
                       class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:shadow-lg hover:bg-blue-700 hover:scale-105 active:scale-95 transition duration-200 ease-in-out">
                        Crear cuenta
                    </a>
                </div>

                {{-- Contacto --}}
                <div class="text-center mt-12 border-t border-gray-300 dark:border-gray-700 pt-6">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        ¿Tienes preguntas o sugerencias?  
                        <a href="mailto:tic@grupofazit.com" class="text-blue-500 hover:underline font-medium">
                            Contáctanos a tic@grupofazit.com
                        </a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
