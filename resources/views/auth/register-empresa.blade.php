<x-guest-layout>
    <form method="POST" action="{{ route('empresa.registrar') }}">
        @csrf

        <!-- Nombre de la Empresa -->
        <div>
            <x-input-label for="nombre_empresa" :value="__('Nombre de la Empresa')" />
            <x-text-input id="nombre_empresa" class="block mt-1 w-full" type="text" name="nombre_empresa" :value="old('nombre_empresa')" required autofocus autocomplete="organization" />
            <x-input-error :messages="$errors->get('nombre_empresa')" class="mt-2" />
        </div>

        <!-- Nombre del Contacto -->
        <div class="mt-4">
            <x-input-label for="nombre_contacto" :value="__('Nombre del Contacto')" />
            <x-text-input id="nombre_contacto" class="block mt-1 w-full" type="text" name="nombre_contacto" :value="old('nombre_contacto')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('nombre_contacto')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Política de privacidad -->
        <div class="mt-6">
            <label class="flex items-start gap-2">
                <input type="checkbox" name="politica_privacidad" required class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="text-sm text-gray-800 dark:text-white leading-snug">
                    Al registrarte, aceptas nuestra <a href="{{ route('politica.privacidad') }}" target="_blank" class="text-blue-600 underline hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-500">Política de Privacidad</a>.
                </span>
            </label>
            @error('politica_privacidad')
                <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- reCAPTCHA -->
        <div class="mt-4">
            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
            @error('g-recaptcha-response')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botón de registro -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" href="{{ route('login') }}">
                {{ __('¿Ya tienes una cuenta?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>




