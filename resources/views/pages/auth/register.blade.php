<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JungleNotes - Crear Cuenta</title>
    
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
                <div class="flex flex-col items-center lg:items-start mb-6">
                    <div class="flex items-center gap-2.5 mb-2">
                        <img src="{{ asset('images/iconverde.svg') }}" class="w-18 h-18 object-contain chameleon-logo" alt="Logo">
                        <h1 class="text-2xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">
                            <span class="text-emerald-600">Jungle</span>Notes
                        </h1>
                    </div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 text-center lg:text-left">Registrate para empezar a organizar tus apuntes de la facultad.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1">Nombre completo</label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               class="w-full px-4 py-2 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                               placeholder="Tu nombre y apellido">
                        @if ($errors->has('name'))
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1">Correo electrónico</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               class="w-full px-4 py-2 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                               placeholder="ejemplo@correo.com">
                        @if ($errors->has('email'))
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1">Contraseña</label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               class="w-full px-4 py-2 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                               placeholder="Mínimo 8 caracteres">
                        @if ($errors->has('password'))
                            <p class="text-xs text-red-600 mt-1 font-medium">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-neutral-800 dark:text-neutral-300 mb-1">Confirmar contraseña</label>
                        <input id="password_confirmation" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               class="w-full px-4 py-2 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                               placeholder="Repetí tu contraseña">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm hover:shadow transition-all duration-150 flex items-center justify-center cursor-pointer">
                            Crear cuenta gratis
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center border-t border-neutral-100 dark:border-zinc-700 pt-4">
                    <p class="text-xs text-neutral-500 dark:text-neutral-400">
                        ¿Ya tenés una cuenta? 
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">
                            Iniciá sesión
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
                    Tus apuntes universitarios, <span class="text-emerald-600">organizados en un solo lugar.</span>
                </h2>
                <p class="text-neutral-600 dark:text-neutral-400 text-sm leading-relaxed">
                    Compartí, ordená y comentá el material de estudio con tus compañeros de cursada. Simplificá tu vida académica.
                </p>
            </div>
        </div>

    </div>

</body>
</html>