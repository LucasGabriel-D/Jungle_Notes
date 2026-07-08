<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JungleNotes - Iniciar Sesión</title>
    
    <script>
        const theme = localStorage.getItem('theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-zinc-900 antialiased">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-12">
        
        <div class="lg:col-span-5 flex flex-col justify-center items-center px-8 py-12 sm:px-12 xl:px-16 bg-white dark:bg-zinc-900">
            
            <div class="w-full max-w-md">
                <div class="flex flex-col items-center lg:items-start mb-8">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex items-center gap-1.5">
                            <img src="{{ asset('images/iconverde.svg') }}" class="w-18 h-18 object-contain chameleon-logo" alt="Logo">
                            <h1 class="text-2xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">
                                <span class="text-emerald-600 dark:text-violet-400">Jungle</span>Notes
                            </h1>
                        </div>
                    </div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center lg:text-left">Iniciá sesión para acceder a tus apuntes universitarios.</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1.5">Correo electrónico</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                               placeholder="ejemplo@correo.com">
                        @if ($errors->has('email'))
                            <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 dark:text-violet-400 dark:hover:text-violet-400 transition" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                               placeholder="••••••••">
                        @if ($errors->has('password'))
                            <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember" 
                                class="rounded border-neutral-300 text-emerald-600 dark:text-violet-400 shadow-sm focus:ring-emerald-500 dark:focus:ring-violet-500 cursor-pointer">
                        <label for="remember_me" class="ms-2 text-xs font-medium text-neutral-600 dark:text-neutral-400 select-none cursor-pointer">
                            Recordar mi sesión
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm hover:shadow transition-all duration-150 flex items-center justify-center cursor-pointer">
                            Ingresar al Panel
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center border-t border-neutral-100 dark:border-zinc-700 pt-4">
                    <p class="text-xs text-neutral-500 dark:text-neutral-400">
                        ¿No tenés una cuenta? 
                        <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-violet-400 dark:hover:text-violet-400 transition">
                            Registrate gratis
                        </a>
                    </p>
                </div>
            </div>

        </div>

        <div class="hidden lg:flex lg:col-span-7 bg-gradient-to-br from-emerald-50 via-emerald-100/40 to-white dark:from-zinc-800 dark:via-zinc-700 dark:to-zinc-800 justify-center items-center p-12 relative overflow-hidden border-l border-neutral-100 dark:border-zinc-700">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-200/30 dark:bg-violet-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-emerald-300/20 dark:bg-violet-500/10 rounded-full blur-3xl"></div>

            <div class="max-w-md text-center z-10">
               
                <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-neutral-100 mb-4">
                    Tus apuntes universitarios, <span class="text-emerald-600 dark:text-violet-400">organizados en un solo lugar.</span>
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                    Compartí, ordená y comentá el material de estudio con tus compañeros de cursada. Simplificá tu vida académica.
                </p>
            </div>
        </div>

    </div>

</body>
</html>