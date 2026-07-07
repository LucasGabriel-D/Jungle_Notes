<x-layouts::auth :title="__('Recuperar Contraseña')">
    <div class="fixed inset-0 flex h-screen w-screen overflow-hidden bg-white antialiased">
        
        <!-- COLUMNA IZQUIERDA: Formulario -->
        <div class="flex w-full flex-col justify-center px-6 py-12 md:w-1/2 lg:px-16 xl:px-24 bg-white z-10">
            <div class="mx-auto w-full max-w-md">
                
                <!-- Logotipo de JungleNotes -->
                <div class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('images/iconverde.png') }}" class="w-18 h-18 object-contain" alt="Logo">
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900 dark:text-neutral-100">
                        <span class="text-emerald-600 dark:text-violet-400">Jungle</span>Notes
                    </h1>
                </div>

                <!-- Título y Descripción Orientativa -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100">¿Olvidaste tu contraseña?</h2>
                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400">
                        No hay problema. Ingresá tu correo electrónico y te enviaremos un enlace para que puedas restablecerla y volver a tus apuntes.
                    </p>
                </div>

                <!-- Estado de la Sesión (Mensaje de éxito al enviar el mail) -->
                @if (session('status'))
                    <div class="mb-4 rounded-xl bg-emerald-50 dark:bg-violet-950/30 p-4 text-sm font-medium text-emerald-700 dark:text-violet-400 border border-emerald-100 dark:border-violet-900 shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Formulario -->
                <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
                    @csrf

                    <!-- Correo Electrónico usando Flux UI -->
                    <div>
                        <flux:input
                            name="email"
                            :label="__('Correo electrónico')"
                            type="email"
                            required
                            autofocus
                            placeholder="ejemplo@correo.com"
                            class="focus:border-emerald-600 focus:ring-emerald-600"
                        />
                    </div>

                    <!-- Botón Principal con el verde de JungleNotes -->
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-sm font-semibold py-2.5 rounded-xl shadow-sm transition duration-150 flex items-center justify-center gap-2">
                        Enviar enlace de recuperación
                    </button>
                </form>

                <!-- Retorno al Login -->
                <div class="mt-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                    <span>¿Te acordaste?</span>
                    <a href="{{ route('login') }}" wire:navigate class="font-semibold text-emerald-600 hover:text-emerald-700 dark:text-violet-400 dark:hover:text-violet-400 ml-1 transition-colors">
                        Iniciar sesión
                    </a>
                </div>
            </div>
        </div>

        <!-- COLUMNA DERECHA: Panel estético idéntico al Login -->
        <div class="relative hidden w-1/2 md:flex items-center justify-center bg-gradient-to-tr from-emerald-50 via-teal-50/30 to-green-100/50 dark:from-zinc-800 dark:via-zinc-700 dark:to-zinc-800 p-12">
            <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] opacity-40"></div>
            
            <div class="relative max-w-lg text-center space-y-4">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white dark:bg-zinc-800 px-3 py-1 text-xs font-medium text-emerald-800 dark:text-violet-400 shadow-sm border border-emerald-100/60 dark:border-violet-900">
                    🌿 El espacio ideal para estudiantes
                </span>
                <h1 class="text-4xl font-extrabold tracking-tight text-neutral-900 dark:text-neutral-100 leading-tight">
                    Recuperá el acceso a <br>
                    <span class="text-emerald-600 dark:text-violet-400">tus apuntes organizados.</span>
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 max-w-md mx-auto leading-relaxed">
                    Tu material de estudio, tus materias y tus compañeros de equipo te están esperando. Asegurá tu cuenta en unos pocos segundos.
                </p>
            </div>
        </div>

    </div>
</x-layouts::auth>