<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Género -->
        <div class="mt-4">
            <x-input-label for="genero" :value="__('Género')" />
            <select id="genero" name="genero" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="no_especificado">Prefiero no decirlo</option>
            </select>
            <x-input-error :messages="$errors->get('genero')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
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
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
        {{ __('Already registered?') }}
    </a>

    <x-primary-button class="ml-4">
        {{ __('Register') }}
    </x-primary-button>
</div>

    </form>
</x-guest-layout>


