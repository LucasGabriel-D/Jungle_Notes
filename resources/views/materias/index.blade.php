<x-layouts::app :title="'Mis Materias'">
    <div class="p-6 max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-neutral-800 dark:text-neutral-100">Mis Materias</h2>
            <a href="{{ route('materias.create') }}" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition-all duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nueva Materia
            </a>
        </div>

        @if (session('message'))
            <div class="bg-emerald-100 dark:bg-violet-950/30 border-l-4 border-emerald-500 text-emerald-700 dark:text-violet-400 p-4 mb-4 rounded-lg" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($materias as $materia)
                <a href="{{ route('materias.show', $materia) }}" class="block bg-white dark:bg-zinc-800 p-5 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm hover:shadow-md hover:border-emerald-200 dark:hover:border-violet-700 transition-all duration-150 group no-underline">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="font-bold text-neutral-900 dark:text-neutral-100 group-hover:text-emerald-700 dark:group-hover:text-violet-400 transition-colors">{{ $materia->nombre }}</h3>
                        <span class="text-xs font-semibold text-neutral-400 dark:text-neutral-500 bg-neutral-100 dark:bg-zinc-700 px-2 py-0.5 rounded-full">{{ $materia->anio }}° año</span>
                    </div>
                    @if ($materia->descripcion)
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-3 line-clamp-2">{{ $materia->descripcion }}</p>
                    @endif
                    <div class="flex items-center gap-1.5 text-xs text-emerald-600 dark:text-violet-400 font-semibold">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        {{ $materia->apuntes_count }} apunte{{ $materia->apuntes_count !== 1 ? 's' : '' }}
                    </div>
                </a>
            @empty
                <div class="col-span-full flex items-center justify-center min-h-[50vh] bg-white dark:bg-zinc-800 rounded-xl border border-dashed border-neutral-300 dark:border-zinc-600">
                    <div class="text-center py-20">
                        <svg class="w-10 h-10 text-neutral-300 dark:text-zinc-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>
                        <p class="text-neutral-500 dark:text-neutral-400 mb-6">No hay materias cargadas todavía.</p>
                        <a href="{{ route('materias.create') }}" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl shadow-sm transition-all duration-150">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Crear primera materia
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts::app>