<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CV Book | Tu acceso empresarial o profesional</title>
<link rel="icon" type="image/svg+xml" href="{{ asset('images/logo_sivi.png') }}">

<!-- SEO Básico -->
<meta name="title" content="CV Book | Plataforma de currículums moderna">
<meta name="description" content="Inicia sesión en CV Book y accede a herramientas inteligentes para crear, buscar y gestionar currículums de forma efectiva.">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="CV Book | Plataforma de currículums moderna">
<meta property="og:description" content="Accede como empresa o profesional y sácale provecho al sistema inteligente de CV Book.">
<meta property="og:image" content="{{ url('images/logo_sivi.png') }}">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="CV Book | Plataforma de currículums moderna">
<meta name="twitter:description" content="Inicia sesión como reclutador o candidato y gestiona tus CVs de forma profesional.">
<meta name="twitter:image" content="{{ url('images/logo_sivi.png') }}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/" wire:navigate>
                    <img src="{{ asset('images/logo_sivi.png') }}" alt="CV Book Logo" class="w-20 h-20">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        @stack('scripts') {{-- NECESARIO para el reCAPTCHA --}}
    </body>
</html>

