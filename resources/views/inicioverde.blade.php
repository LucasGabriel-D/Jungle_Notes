<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jungle Notes - Apuntes Universitarios</title>

    <link rel="icon" type="image/png" href="{{ asset('images/favicon2.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-green-50 via-white to-emerald-50 text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <nav
        class="flex justify-between items-center py-2 px-8 md:px-16 bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo2.png') }}" alt="Logo Jungle Notes"
                class="h-20 md:h-24 w-auto object-contain scale-150">
        </div>

            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-emerald-700 transition-all duration-200 shadow-sm shadow-emerald-200">Ir
                            al Panel</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-600 hover:text-emerald-700 font-semibold transition-colors">Iniciar Sesión</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-emerald-700 transition-all duration-200 shadow-md shadow-emerald-100">Registrarse</a>
                        @endif
                    @endauth
                @endif
            </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center text-center px-6 max-w-4xl mx-auto my-16 md:my-24">
        <span
            class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-base font-semibold bg-emerald-50 text-emerald-700 mb-6 border border-emerald-200/50">
            🌿 El espacio ideal para estudiantes
        </span>

        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 tracking-tight leading-none mb-6">
            Tus apuntes universitarios,<br>
            <span class="bg-gradient-to-r from-emerald-600 to-green-500 bg-clip-text text-transparent">organizados en un
                solo lugar.</span>
        </h1>

        <p class="text-base md:text-xl text-gray-600 max-w-2xl mb-10 leading-relaxed">
            Compartí, ordená y comentá el material de estudio con tus compañeros de cursada. Simplificá tu vida
            académica con este sistema de gestión de notas.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('register') }}"
                class="w-full sm:w-auto bg-emerald-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-emerald-700 transition-all duration-200 shadow-xl shadow-emerald-200 hover:scale-[1.02]">
                Crear una cuenta gratis
            </a>
        </div>
    </main>


</body>

</html>
