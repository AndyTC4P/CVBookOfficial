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

        <div class="mt-6">
            <button
                type="button"
                onclick="verificarEstado()"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-md shadow transition">
                🔄 Revisar estado ahora
            </button>
        </div>

        <!-- Mensaje visual integrado -->
        <div id="mensaje-estado" class="mt-4 text-sm font-medium text-yellow-600 dark:text-yellow-400 hidden">
            <!-- Aquí se mostrará el mensaje dinámico -->
        </div>

        <p class="text-sm text-gray-500 mt-6 italic">Esto nos ayuda a mantener la calidad y seguridad del sistema.</p>
    </div>

    <script>
        function verificarEstado() {
            fetch("{{ route('check.aprobacion') }}", {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                const mensaje = document.getElementById('mensaje-estado');

                if (data.aprobada) {
                    window.location.href = "{{ route('admin.busqueda-cvs') }}";
                } else {
                    mensaje.textContent = '⚠️ Tu cuenta aún no ha sido aprobada. Por favor, vuelve a intentarlo más tarde.';
                    mensaje.classList.remove('hidden');
                }
            });
        }
    </script>
</x-guest-layout>






