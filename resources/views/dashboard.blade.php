<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <!-- Stats -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-800">
                <h3 class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Apuntes</h3>
                <p class="mt-1 text-3xl font-bold text-neutral-900 dark:text-white">{{ $totalApuntes }}</p>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-800">
                <h3 class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Total Materias</h3>
                <p class="mt-1 text-3xl font-bold text-neutral-900 dark:text-white">{{ $totalMaterias }}</p>
            </div>
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-800">
                <h3 class="text-sm font-medium text-neutral-500 dark:text-neutral-400">Mis Aportes</h3>
                <p class="mt-1 text-3xl font-bold text-neutral-900 dark:text-white">{{ $misApuntes }}</p>
            </div>
        </div>

        <!-- Content -->
        <div class="grid auto-rows-min gap-4 lg:grid-cols-2">
            <!-- Latest Apuntes -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-800">
                <h3 class="text-lg font-semibold mb-4 text-neutral-900 dark:text-white">Últimos Apuntes de la Comunidad</h3>
                <div class="space-y-4">
                    @forelse($ultimosApuntes as $apunte)
                        <div class="border-b border-neutral-100 dark:border-neutral-700 pb-2 last:border-0">
                            <h4 class="font-medium text-neutral-900 dark:text-white">{{ $apunte->titulo }}</h4>
                            <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $apunte->materia->nombre }} — {{ $apunte->user->name }}</p>
                            <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 text-sm hover:underline">Descargar</a>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No hay apuntes aún.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Comments -->
            <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6 bg-white dark:bg-neutral-800">
                <h3 class="text-lg font-semibold mb-4 text-neutral-900 dark:text-white">Mis Comentarios Recientes</h3>
                <div class="space-y-4">
                    @forelse($misComentarios as $comentario)
                        <div class="bg-neutral-50 dark:bg-neutral-700/50 p-3 rounded-lg text-sm">
                            <p class="italic text-neutral-600 dark:text-neutral-300">"{{ $comentario->contenido }}"</p>
                            <p class="text-xs text-neutral-400 dark:text-neutral-500 mt-1">En: {{ $comentario->apunte->titulo }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No hay comentarios aún.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
