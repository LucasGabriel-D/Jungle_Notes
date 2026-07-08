<x-layouts::app :title="__('Equipo Iceberg')">
    <div class="flex-1 flex flex-col gap-6 w-full max-w-7xl mx-auto py-6">
        
        <div class="border-b border-neutral-200 dark:border-zinc-700 pb-5 mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 flex items-center gap-2">
                <svg class="w-7 h-7 text-emerald-600 dark:text-violet-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v20M2 12h20M12 9l3-3M12 15l3 3M12 9l-3-3M12 15l-3 3M9 12l-3-3M15 12l3-3M9 12l-3 3M15 12l3 3" />
                </svg>
             Equipo Iceberg
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Desarrolladores del proyecto Jungle Notes para Programación III.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">

            @foreach($equipo as $slug => $miembro)
                <a href="{{ route('equipo.show', $slug) }}" class="block group h-full">
                    <div class="h-full rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 shadow-sm text-center transition-all duration-300 group-hover:border-emerald-400 dark:group-hover:border-violet-500 group-hover:-translate-y-1 group-hover:shadow-md relative overflow-hidden">
                        
                        <div class="w-20 h-20 mx-auto bg-emerald-100 dark:bg-violet-950/30 text-emerald-600 dark:text-violet-400 rounded-full flex items-center justify-center text-2xl font-bold mb-4 transition-colors group-hover:bg-emerald-200 dark:group-hover:bg-violet-900/50">
                            {{ $miembro['iniciales'] }}
                        </div>
                        
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100 group-hover:text-emerald-600 dark:group-hover:text-violet-400 transition-colors">
                            {{ $miembro['nombre'] }}
                        </h3>
                        
                        <p class="text-xs text-emerald-600 dark:text-violet-400 mt-3 font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            Ver perfil completo &rarr;
                        </p>
                    </div>
                </a>
            @endforeach

        </div>

    </div>
</x-layouts::app>