<x-layouts::app :title="$materia->nombre">
    <div class="p-6 max-w-5xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('materias.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-emerald-700 transition-colors no-underline mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Volver a materias
            </a>

            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">{{ $materia->nombre }}</h2>
                    @if ($materia->descripcion)
                        <p class="text-neutral-500 dark:text-neutral-400 mt-1">{{ $materia->descripcion }}</p>
                    @endif
                    <span class="inline-block mt-2 text-xs font-semibold text-neutral-400 dark:text-neutral-500 bg-neutral-100 dark:bg-zinc-700 px-2.5 py-1 rounded-full">{{ $materia->anio }}° año</span>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('materias.edit', $materia) }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-emerald-700 font-semibold transition-colors no-underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Editar
                    </a>
                    <form method="POST" action="{{ route('materias.destroy', $materia) }}" onsubmit="return confirm('¿Eliminar esta materia y todos sus apuntes?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1 text-sm text-red-500 hover:text-red-700 font-semibold transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm">
            <div class="px-6 py-4 border-b border-neutral-100 dark:border-zinc-700">
                <h3 class="font-bold text-neutral-900 dark:text-neutral-100">Apuntes ({{ $materia->apuntes->count() }})</h3>
            </div>

            <div class="divide-y divide-neutral-100 dark:divide-zinc-700">
                @forelse($materia->apuntes as $apunte)
                    <div class="px-6 py-4 flex items-center justify-between group">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="p-2 bg-emerald-50 dark:bg-violet-900/30 text-emerald-700 dark:text-violet-400 rounded-lg shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold text-sm text-neutral-900 dark:text-neutral-100 truncate">{{ $apunte->titulo }}</h4>
@if($apunte->descripcion)
    <p class="text-xs text-neutral-600 dark:text-neutral-300 mt-0.5">{{ $apunte->descripcion }}</p>
@endif
<p class="text-xs text-neutral-500 dark:text-neutral-400">por {{ $apunte->user->name }} · {{ $apunte->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-xs bg-emerald-50 dark:bg-violet-900/30 hover:bg-emerald-600 text-emerald-700 dark:text-violet-400 hover:text-white px-3 py-2 rounded-lg font-semibold transition-all duration-150 shrink-0">
                            Abrir
                        </a>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center">
                        <p class="text-neutral-500 dark:text-neutral-400">No hay apuntes para esta materia todavía.</p>
                        <a href="{{ route('apuntes.index') }}" class="inline-block mt-3 text-sm font-semibold text-emerald-600 dark:text-violet-400 hover:text-emerald-700 transition-colors">Subir apunte</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts::app>