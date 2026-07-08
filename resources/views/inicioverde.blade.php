<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jungle Notes - Apuntes Universitarios</title>

    <link rel="icon" type="image/png" href="{{ asset('images/iconverde.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 text-gray-800 dark:text-neutral-200 antialiased min-h-screen flex flex-col justify-between">

    <nav class="flex justify-between items-center py-2 px-8 md:px-16 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 dark:border-zinc-700">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logotipoverde.png') }}" alt="Logo Jungle Notes" class="h-20 md:h-24 w-auto object-contain scale-120 chameleon-logo">
        </div>

        <div class="flex items-center gap-6">
            <!-- Toggle dark mode -->
            <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-neutral-500 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-zinc-700 transition">
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>

            @if (Route::has('login'))
                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-gray-700 dark:text-neutral-300">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-emerald-600 dark:bg-violet-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-sm cursor-pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-neutral-400 hover:text-emerald-700 dark:hover:text-violet-400 font-semibold transition-colors">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-emerald-600 dark:bg-violet-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-md">
                            Registrarse
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center text-center px-6 max-w-4xl mx-auto my-16 md:my-24">
        

        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 dark:text-neutral-100 tracking-tight leading-none mb-6">
            Tus apuntes universitarios,<br>
            <span class="bg-gradient-to-r from-emerald-600 to-green-500 dark:from-violet-500 dark:to-violet-400 bg-clip-text text-transparent">organizados en un solo lugar.</span>
        </h1>

        <p class="text-base md:text-xl text-gray-600 dark:text-neutral-400 max-w-2xl mb-10 leading-relaxed">
            Compartí, ordená y comentá el material de estudio con tus compañeros de cursada. Simplificá tu vida académica con este sistema de gestión de notas.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto bg-emerald-600 dark:bg-violet-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-xl hover:scale-[1.02]">
                    Ir al Panel
                </a>
            @else
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-emerald-600 dark:bg-violet-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-xl hover:scale-[1.02]">
                    Crear una cuenta gratis
                </a>
            @endauth
        </div>
    </main>

</body>
</html>