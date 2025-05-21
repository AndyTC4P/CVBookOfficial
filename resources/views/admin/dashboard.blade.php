<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🛠️ Panel de Administración
        </h2>
    </x-slot>

    <div class="py-12 px-4 sm:px-6 lg:px-8 space-y-10">
        {{-- USUARIOS --}}
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                👥 Usuarios Registrados ({{ count($users) }})
            </h3>

            {{-- Alerta de éxito --}}
            @if(session('success'))
                <div class="bg-green-600 text-white px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($users as $user)
                    <div class="p-4 bg-gray-800 rounded-lg shadow text-white space-y-2">
                        <h4 class="font-semibold text-lg">
                            {{ $user->name }}
                        </h4>
                        <p class="text-sm text-gray-300">{{ $user->email }}</p>

                        {{-- Etiqueta de rol actual --}}
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium 
                            {{ $user->role === 'admin' ? 'bg-red-600' : ($user->role === 'empresa' ? 'bg-yellow-500' : 'bg-blue-600') }}">
                            {{ ucfirst($user->role) }}
                        </span>

                        {{-- Formulario de cambio de rol (no se permite cambiarse a uno mismo si es admin) --}}
                       @if(auth()->id() !== $user->id)
    <form method="POST" action="{{ route('admin.cambiarRol', $user->id) }}" class="mt-2">
        @csrf
        <div class="flex items-center gap-2">
            <select name="nuevo_rol" class="bg-gray-900 border border-gray-600 text-white text-sm rounded px-2 py-1">
                <option value="usuario" @selected($user->role === 'usuario')>Usuario</option>
                <option value="empresa" @selected($user->role === 'empresa')>Empresa</option>
                <option value="admin" @selected($user->role === 'admin')>Admin</option>
            </select>
            <button type="submit" class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 rounded text-white">
                Cambiar
            </button>
        </div>
    </form>
@else
    <p class="text-xs text-gray-400 italic mt-2">No puedes editar tu propio rol</p>
@endif

                    </div>
                @endforeach
            </div>
        </div>

        {{-- CVS --}}
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
                📄 CVs Creados ({{ count($cvs) }})
            </h3>

            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($cvs as $cv)
                    <div class="bg-gray-800 text-white rounded-lg p-4 shadow-md flex flex-col justify-between h-full">
                        <div>
                            <h4 class="text-md font-bold text-white">{{ $cv->nombre }} {{ $cv->apellido }}</h4>
                            <p class="text-sm text-gray-300">{{ $cv->titulo ?? 'Sin título' }}</p>
                            <p class="text-xs text-gray-400 mt-1">Actualizado: {{ $cv->updated_at->format('d/m/Y H:i') }}</p>
                            <p class="text-xs text-gray-400">Usuario: {{ $cv->user->name }} ({{ $cv->user->email }})</p>
                            <span class="text-sm mt-1 {{ $cv->publico ? 'text-green-400' : 'text-red-400' }}">
                                {{ $cv->publico ? 'Público' : 'Privado' }}
                            </span>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <a href="{{ route('cv.show', $cv->slug) }}"
                               class="text-sm px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md text-white shadow">
                                👀 Ver CV
                            </a>

                            @if($cv->publico)
                                <button
                                    x-data="{ copied: false }"
                                    @click="
                                        navigator.clipboard.writeText('{{ route('cv.show', $cv->slug) }}');
                                        copied = true;
                                        setTimeout(() => copied = false, 2500);
                                    "
                                    class="text-sm px-4 py-2 bg-green-600 hover:bg-green-700 rounded-md text-white shadow relative"
                                >
                                    📋 Copiar Enlace
                                    <span x-show="copied"
                                          x-transition
                                          class="absolute left-1/2 -translate-x-1/2 top-full mt-1 text-xs bg-green-700 text-white rounded px-2 py-1 shadow">
                                        Copiado
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</x-app-layout>




