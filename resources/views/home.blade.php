@extends('layouts.app')

@section('content')
    <div class="text-center text-white">
        <h1 class="text-5xl font-bold">CV BOOK</h1>
        <p class="text-lg mt-4">Bienvenido a CV Book, crea tu CV en minutos</p>

        <div class="mt-6">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg shadow-lg">
                Iniciar Sesión
            </a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow-lg">
                Crear Cuenta
            </a>
        </div>
    </div>
@endsection
