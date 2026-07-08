<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jungle Notes - Apuntes Universitarios</title>

    <link rel="icon" type="image/png" href="{{ asset('images/iconverde.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .floating-card-1 {
            animation: float 6s ease-in-out infinite;
        }

        .floating-card-2 {
            animation: float 8s ease-in-out infinite 1s;
        }

        .floating-card-3 {
            animation: float 7s ease-in-out infinite 2s;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-15px) rotate(2deg);
            }

            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 text-gray-800 dark:text-neutral-200 antialiased min-h-screen flex flex-col overflow-x-hidden">

    <nav class="flex justify-between items-center py-4 px-6 md:px-12 bg-transparent w-full z-50 absolute top-0">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logotipoverde.png') }}" alt="Logo Jungle Notes"
                class="h-20 md:h-28 w-auto object-contain chameleon-logo">
        </div>

        <div class="flex items-center gap-4 md:gap-6">
            <button onclick="toggleDarkMode()"
                class="p-2 rounded-lg text-emerald-700 dark:text-neutral-400 hover:bg-emerald-100/50 dark:hover:bg-zinc-700 transition">
                <svg class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                    </path>
                </svg>
                <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
            </button>

            @if (Route::has('login'))
                @auth
                    <div class="flex items-center gap-3">
                        <span
                            class="text-sm font-semibold text-gray-700 dark:text-neutral-300 hidden sm:block">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="bg-emerald-600 dark:bg-violet-600 text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-sm cursor-pointer">
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-600 dark:text-neutral-300 hover:text-emerald-700 dark:hover:text-violet-400 font-semibold transition-colors text-sm md:text-base">
                        Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="bg-emerald-600 dark:bg-violet-600 text-white px-5 py-2.5 rounded-xl font-semibold text-sm md:text-base hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                            Registrarse
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center pt-24 pb-12 px-6 lg:px-16 w-full max-w-7xl mx-auto">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center w-full">

            <!-- Columna Izquierda: Texto alineado -->
            <div class="flex flex-col items-start text-left space-y-8 z-10">

                <h1
                    class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-gray-900 dark:text-neutral-100 tracking-tight leading-[1.05]">
                    Tus apuntes,<br>
                    <span
                        class="bg-gradient-to-r from-emerald-600 to-green-500 dark:from-violet-500 dark:to-violet-400 bg-clip-text text-transparent">donde
                        deben estar.</span>
                </h1>

                <p class="text-lg md:text-xl text-gray-600 dark:text-neutral-400 max-w-lg leading-relaxed">
                    Organizá y descargá el material de
                    estudio en un ecosistema pensado para estudiantes.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto pt-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="w-full sm:w-auto bg-emerald-600 dark:bg-violet-600 text-white text-center px-8 py-4 rounded-2xl text-lg font-bold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-300 shadow-xl shadow-emerald-600/20 dark:shadow-violet-600/20 hover:-translate-y-1">
                            Ir al Panel
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="w-full sm:w-auto bg-emerald-600 dark:bg-violet-600 text-white text-center px-8 py-4 rounded-2xl text-lg font-bold hover:bg-emerald-700 dark:hover:bg-violet-700 transition-all duration-300 shadow-xl shadow-emerald-600/20 dark:shadow-violet-600/20 hover:-translate-y-1">
                            Comenzar ahora
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Columna Derecha: Composición asimétrica -->
            <div class="relative h-[400px] lg:h-[550px] w-full hidden md:block">
                <!-- Blob de fondo para dar color -->
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-emerald-300/40 dark:bg-violet-600/20 rounded-full blur-3xl">
                </div>

                <!-- Tarjeta 1 (Física) -->
                <div
                    class="floating-card-1 absolute top-[10%] right-[10%] w-64 bg-white dark:bg-zinc-800 p-5 rounded-2xl shadow-2xl border border-gray-100 dark:border-zinc-700 rotate-3 z-20">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="p-2 bg-emerald-100 dark:bg-violet-900/50 rounded-lg text-emerald-600 dark:text-violet-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Resumen Final.pdf</p>
                            <p class="text-xs text-gray-500">Física II • 2.4 MB</p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2 (Álgebra) -->
                <div
                    class="floating-card-2 absolute top-[40%] left-[5%] w-72 bg-white dark:bg-zinc-800 p-5 rounded-2xl shadow-2xl border border-gray-100 dark:border-zinc-700 -rotate-3 z-30">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg text-blue-600 dark:text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 dark:text-white">Ejercicios Resueltos.docx</p>
                            <p class="text-xs text-gray-500">Álgebra Lineal • Hace 2h</p>
                        </div>
                    </div>
                    <div class="w-full h-2 bg-gray-100 dark:bg-zinc-700 rounded-full overflow-hidden mt-2">
                        <div class="h-full bg-blue-500 w-3/4 rounded-full"></div>
                    </div>
                </div>

                <!-- Tarjeta 3 (Comentario/Notificación) -->
                <div
                    class="floating-card-3 absolute bottom-[15%] right-[20%] w-60 bg-white dark:bg-zinc-800 p-4 rounded-2xl shadow-xl border border-gray-100 dark:border-zinc-700 rotate-6 z-10">
                    <div class="flex gap-3">
                        <div class="p-2 bg-green-100 dark:bg-green-900/50 rounded-lg text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">Verbo TO BE.docx</p>
                        <p class="text-xs text-gray-500">Ingles • Hace 2h</p>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </main>

</body>

</html>
