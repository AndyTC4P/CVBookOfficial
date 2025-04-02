<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('mensaje'))
        <div class="mensaje">
            {{ session('mensaje') }}
        </div>
    @endif

    <!-- Mensaje de error en caso de validación -->
    @error('nombre')
        <div class="error">
            {{ $message }}
        </div>
    @enderror

    <!-- Formulario -->
    <form wire:submit.prevent="guardar">
        <input type="text" wire:model="nombre" placeholder="Escribe tu nombre" id="nombre">

        <button type="submit">Guardar</button>
    </form>
</div>

