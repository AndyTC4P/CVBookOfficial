<x-app-layout> 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🔐 Política de Privacidad – Asistente Sivi
        </h2>
    </x-slot>

    <!-- Banner ajustado -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="rounded-lg overflow-hidden">
            <img src="{{ asset('images/preguntascv.webp') }}" alt="Banner Privacidad"
                 class="w-full object-cover" style="max-height: 160px;">
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-lg p-8 text-gray-800 dark:text-gray-200 space-y-6">

                <p class="text-lg text-center leading-relaxed">
                    Esta política de privacidad describe cómo el asistente <span class="font-semibold text-blue-600 dark:text-blue-400">Sivi</span> utiliza la información en la plataforma <span class="font-semibold text-blue-600 dark:text-blue-400">cvbook.online</span>.
                </p>

                <div class="space-y-5">
                    <div>
                        <h3 class="font-semibold text-lg">📌 Qué datos utiliza Sivi</h3>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Solo accede a currículums públicos disponibles en <strong>cvbook.online</strong>.</li>
                            <li>No recolecta información personal del usuario que hace la consulta.</li>
                            <li>No almacena historiales ni utiliza cookies.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">🚫 Qué NO hace Sivi</h3>
                        <ul class="list-disc list-inside space-y-1">
                            <li>No accede a internet ni a redes sociales externas.</li>
                            <li>No procesa ni guarda información sensible.</li>
                            <li>No interactúa con sistemas privados ni cuentas de usuario.</li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">✅ Uso exclusivo de datos públicos</h3>
                        <p>
                            Sivi opera exclusivamente con datos que los usuarios han hecho públicos al crear y publicar su CV en la plataforma. No se accede a CVs marcados como privados o protegidos.
                        </p>
                    </div>

                    <div>
                        <h3 class="font-semibold text-lg">📧 Contacto</h3>
                        <p>
                            Para consultas o dudas relacionadas con esta política, puedes escribirnos a:  
                            <a href="mailto:contacto@cvbook.online" class="text-blue-500 hover:underline font-medium">tic@grupofazit.com</a>
                        </p>
                    </div>
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400 text-center mt-10">
                    Última actualización: {{ now()->format('d/m/Y') }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

