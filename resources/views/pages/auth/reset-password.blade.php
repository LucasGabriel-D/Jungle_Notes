<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JungleNotes - Restablecer Contraseña</title>
    
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
                    <div class="flex items-center gap-2.5 mb-2">
                        <img src="{{ asset('images/iconverde.png') }}" class="w-18 h-18 object-contain" alt="Logo">
                        <h1 class="text-2xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">
                            <span class="text-emerald-600 dark:text-violet-400">Jungle</span>Notes
                        </h1>
                    </div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center lg:text-left">Ingresá tu nueva contraseña para restablecer tu cuenta.</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1.5">Correo electrónico</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ request('email') }}"
                               required
                               readonly
                               class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 text-neutral-500 dark:text-neutral-400 bg-neutral-50 dark:bg-zinc-700 text-sm cursor-not-allowed">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1.5">Nueva contraseña</label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autofocus
                               autocomplete="new-password"
                               class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                               placeholder="Mínimo 8 caracteres">
                        @if ($errors->has('password'))
                            <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1.5">Confirmar contraseña</label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                               placeholder="Repetí tu contraseña">
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm hover:shadow transition-all duration-150 flex items-center justify-center cursor-pointer">
                        Restablecer contraseña
                    </button>
                </form>

                <div class="mt-6 text-center border-t border-neutral-100 dark:border-zinc-700 pt-4">
                    <p class="text-xs text-neutral-500 dark:text-neutral-400">
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-violet-400 dark:hover:text-violet-400 transition">
                            Volver al inicio de sesión
                        </a>
                    </p>
                </div>
            </div>

        </div>

        <div class="hidden lg:flex lg:col-span-7 bg-gradient-to-br from-emerald-50 via-emerald-100/40 to-white dark:from-zinc-800 dark:via-zinc-700 dark:to-zinc-800 justify-center items-center p-12 relative overflow-hidden border-l border-neutral-100 dark:border-zinc-700">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-200/30 dark:bg-violet-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-emerald-300/20 dark:bg-violet-500/10 rounded-full blur-3xl"></div>

            <div class="max-w-md text-center z-10">
                <span class="inline-block px-3 py-1 bg-white dark:bg-zinc-800 border border-emerald-200/60 dark:border-violet-900 rounded-full text-xs font-semibold text-emerald-700 dark:text-violet-400 mb-4 shadow-sm">
                    🌿 El espacio ideal para estudiantes
                </span>
                <h2 class="text-3xl font-extrabold tracking-tight text-neutral-900 dark:text-neutral-100 mb-4">
                    Restablecé tu acceso, <span class="text-emerald-600 dark:text-violet-400">volvé a tus apuntes.</span>
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                    Una vez que cambies tu contraseña, podrás acceder de nuevo a todas tus materias, apuntes y comentarios.
                </p>
            </div>
        </div>

    </div>

</body>
</html>
