<x-app-layout>  
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🔐 Política de Privacidad – CVBook
        </h2>
    </x-slot>

    <!-- Banner -->
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
                    Esta política de privacidad describe cómo CVBook recopila, utiliza y protege la información de los usuarios que utilizan la plataforma <span class="font-semibold text-blue-600 dark:text-blue-400">cvbook.online</span>.
                </p>

                <div class="space-y-5">

                    <!-- Datos recopilados -->
                    <div>
                        <h3 class="font-semibold text-lg">📌 Qué datos recopilamos</h3>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Información personal como nombre, correo, teléfono y país.</li>
                            <li>Datos profesionales ingresados voluntariamente en el CV (experiencia, educación, habilidades, etc.).</li>
                            <li>Preferencias de visibilidad del CV (público o privado).</li>
                        </ul>
                    </div>

                    <!-- Uso responsable y advertencias -->
                    <div>
                        <h3 class="font-semibold text-lg">⚠️ Responsabilidad del usuario</h3>
                        <ul class="list-disc list-inside space-y-1">
                            <li>No debes compartir tu contraseña con nadie. Es tu responsabilidad proteger el acceso a tu cuenta.</li>
                            <li>Todos los datos que ingreses en tu CV serán visibles públicamente si marcas tu perfil como "CV público".</li>
                            <li>CVBook no recomienda incluir datos sensibles como números de documentos, cuentas bancarias o contraseñas.</li>
                            <li>Recuerda compartir solo la información que estés de acuerdo en hacer pública.</li>
                        </ul>
                    </div>

                    <!-- Protección de la información -->
                    <div>
                        <h3 class="font-semibold text-lg">🔐 Cómo protegemos tu información</h3>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Usamos sistemas de autenticación, validación y almacenamiento seguro.</li>
                            <li>Los CVs marcados como privados solo son accesibles por su autor o el equipo administrativo.</li>
                            <li>No compartimos información personal con terceros sin tu consentimiento.</li>
                        </ul>
                    </div>

                    <!-- Limitación de responsabilidad -->
                    <div>
                        <h3 class="font-semibold text-lg">❗ Limitación de responsabilidad</h3>
                        <p>
                            CVBook implementa medidas de seguridad, sin embargo, no se hace responsable por accesos no autorizados, ataques externos, hackeos u otras pérdidas de información provocadas por eventos fuera de nuestro control.
                        </p>
                        <p class="mt-2">
                            El usuario es responsable de verificar qué información decide publicar. Si tu perfil es público, cualquier persona o empresa registrada puede acceder a esa información.
                        </p>
                    </div>

                    <!-- Contacto -->
                    <div>
                        <h3 class="font-semibold text-lg">📧 Contacto</h3>
                        <p>
                            Para dudas o solicitudes relacionadas con tus datos personales o esta política, puedes escribirnos a:  
                            <a href="mailto:tic@grupofazit.com" class="text-blue-500 hover:underline font-medium">tic@grupofazit.com</a>
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



