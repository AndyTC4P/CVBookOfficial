<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $genero = 'no_especificado';
    public ?string $nombre_empresa = null;
    public ?string $telefono = null;

    public function mount(): void
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->genero = $user->genero ?? 'no_especificado';
        $this->nombre_empresa = $user->nombre_empresa;
        $this->telefono = $user->telefono;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'genero' => ['required', Rule::in(['masculino', 'femenino', 'no_especificado'])],
        ];

        if ($user->role === 'empresa') {
            $rules['nombre_empresa'] = ['required', 'string', 'max:255'];
            $rules['telefono'] = ['nullable', 'string', 'max:25'];
        }

        $validated = $this->validate($rules);
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
};
?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        @if (auth()->user()->isEmpresa())
            <div>
                <x-input-label for="nombre_empresa" :value="'Nombre de la Empresa'" />
                <x-text-input wire:model="nombre_empresa" id="nombre_empresa" name="nombre_empresa" type="text" class="mt-1 block w-full" required />
                <x-input-error class="mt-2" :messages="$errors->get('nombre_empresa')" />
            </div>
        @endif

        <div>
            <x-input-label for="name" :value="auth()->user()->isEmpresa() ? 'Nombre del Contacto' : __('Name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        @if (auth()->user()->isEmpresa())
            <div>
                <x-input-label for="telefono" :value="'Número de Contacto'" />
                <x-text-input wire:model="telefono" id="telefono" name="telefono" type="text" class="mt-1 block w-full" />
                <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
            </div>
        @endif

        <div>
            <x-input-label for="genero" :value="__('Género')" />
            <select wire:model="genero" id="genero" name="genero" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="no_especificado">Prefiero no decirlo</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('genero')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>

