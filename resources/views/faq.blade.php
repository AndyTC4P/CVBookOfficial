<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
            <span>🚀</span> <span>¿Cómo funciona CV Book?</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-8 text-gray-800 dark:text-gray-200 space-y-8">

                <p class="text-lg leading-relaxed">
                    <span class="font-medium text-blue-600 dark:text-blue-400">CV Book</span> es una herramienta moderna para crear, gestionar y compartir tu currículum profesional en línea.
                    Sigue estos sencillos pasos para comenzar:
                </p>

                <div class="space-y-6" x-data x-init="$el.querySelectorAll('.paso').forEach((el, i) => {
                    el.classList.add('opacity-0', 'translate-y-4');
                    setTimeout(() => el.classList.remove('opacity-0', 'translate-y-4'), i * 150);
                })">
                    <div class="paso transition-all duration-500 ease-out flex items-start gap-4">
                        <div class="text-blue-500 text-xl">1️⃣</div>
                        <div>
                            <h3 class="font-semibold text-lg">Regístrate o inicia sesión</h3>
                            <p>Crea tu cuenta con correo electrónico o accede fácilmente mediante Google.</p>
                        </div>
                    </div>

                    <div class="paso transition-all duration-500 ease-out flex items-start gap-4">
                        <div class="text-blue-500 text-xl">2️⃣</div>
                        <div>
                            <h3 class="font-semibold text-lg">Completa tu CV</h3>
                            <p>Ve a <strong>Crear CV</strong> desde el menú y completa tus datos: perfil, experiencia, estudios, habilidades e idiomas.</p>
                        </div>
                    </div>

                    <div class="paso transition-all duration-500 ease-out flex items-start gap-4">
                        <div class="text-blue-500 text-xl">3️⃣</div>
                        <div>
                            <h3 class="font-semibold text-lg">Comparte tu CV con un clic</h3>
                            <p>Obtén un enlace único para compartir tu CV en tu portafolio, redes o directamente con reclutadores.</p>
                        </div>
                    </div>

                    <div class="paso transition-all duration-500 ease-out flex items-start gap-4">
                        <div class="text-blue-500 text-xl">4️⃣</div>
                        <div>
                            <h3 class="font-semibold text-lg">Edita tu CV en cualquier momento</h3>
                            <p>¿Cambiaste de empleo o aprendiste una nueva habilidad? En CV Book puedes actualizar tu currículum de forma rápida y sencilla, siempre que lo necesites.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 border-t border-gray-300 dark:border-gray-700 pt-8 text-center">
                    <h3 class="text-xl font-semibold mb-4">¿Listo para comenzar?</h3>
                    <p class="mb-6">Crea tu cuenta ahora y comienza a construir tu presencia profesional en línea.</p>
                    <a href="{{ route('register') }}"
                       class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-md transition hover:bg-blue-700 hover:scale-105 active:scale-95 duration-200">
                        Crear cuenta
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>





