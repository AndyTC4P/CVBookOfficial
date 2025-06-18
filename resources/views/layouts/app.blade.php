<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Estilos de Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Estilos de Livewire -->
        @livewireStyles

        <!-- Trix Editor -->
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.3.1/dist/trix.css">
        <script type="text/javascript" src="https://unpkg.com/trix@1.3.1/dist/trix.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- Barra de navegación Livewire --}}
            <livewire:layout.navigation />

            <!-- Encabezado de página -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Contenido principal -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-100 dark:bg-gray-900 text-center py-4 mt-16 border-t border-gray-200 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">
                © {{ date('Y') }} CVBook. Todos los derechos reservados. <br>
                Lomas de San Francisco, Calles 2, Pje. 6, #64<br>
                San Salvador, El Salvador, Central America
            </footer>
        </div>

        <!-- Scripts de Livewire -->
        @livewireScripts
        @stack('scripts')
    </body>
</html>

