<x-layouts::app :title="__('Equipo Iceberg')">
    <div class="flex-1 flex flex-col gap-6 w-full max-w-7xl mx-auto py-6">
        
        <div class="border-b border-neutral-200 dark:border-zinc-700 pb-5 mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 flex items-center gap-2">
                <span class="text-emerald-600">🧊</span> Equipo Iceberg
            </h2>
            <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Desarrolladores del proyecto Jungle Notes para Programación III.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            
            <div class="rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 shadow-sm text-center hover:border-emerald-300 dark:hover:border-emerald-600 transition-colors">
                <div class="w-20 h-20 mx-auto bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-full flex items-center justify-center text-2xl font-bold mb-4">
                    EC
                </div>
                <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100">Cardozo Benjamin Emanuel</h3>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 shadow-sm text-center hover:border-emerald-300 dark:hover:border-emerald-600 transition-colors">
                <div class="w-20 h-20 mx-auto bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-full flex items-center justify-center text-2xl font-bold mb-4">
                    MC
                </div>
                <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100">Cardozo Mauricio</h3>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 shadow-sm text-center hover:border-emerald-300 dark:hover:border-emerald-600 transition-colors">
                <div class="w-20 h-20 mx-auto bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-full flex items-center justify-center text-2xl font-bold mb-4">
                    LA
                </div>
                <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100">Antonelli Lucas</h3>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-6 shadow-sm text-center hover:border-emerald-300 dark:hover:border-emerald-600 transition-colors">
                <div class="w-20 h-20 mx-auto bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 rounded-full flex items-center justify-center text-2xl font-bold mb-4">
                    SB
                </div>
                <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100">Benitez Santiago</h3>
            </div>

        </div>

    </div>
</x-layouts::app>