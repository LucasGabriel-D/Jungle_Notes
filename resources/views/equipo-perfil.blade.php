<x-layouts::app :title="$miembro['nombre'] . ' - Equipo Iceberg'">
    <div class="flex-1 flex flex-col gap-6 w-full max-w-3xl mx-auto py-10 px-4">
        
        <div>
            <a href="{{ route('equipo.index') }}" class="text-sm font-medium text-emerald-600 dark:text-violet-400 hover:underline flex items-center gap-1 transition-colors">
                &larr; Volver al Equipo Iceberg
            </a>
        </div>

        <div class="rounded-2xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-8 sm:p-12 shadow-sm text-center mt-2 relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-emerald-50 to-white dark:from-violet-900/20 dark:to-zinc-800"></div>

            <div class="relative w-32 h-32 mx-auto bg-white dark:bg-zinc-800 border-4 border-white dark:border-zinc-800 rounded-full flex items-center justify-center shadow-md mb-6 z-10">
                <div class="w-full h-full bg-emerald-100 dark:bg-violet-950/40 text-emerald-600 dark:text-violet-400 rounded-full flex items-center justify-center text-4xl font-bold">
                    {{ $miembro['iniciales'] }}
                </div>
            </div>

            <div class="relative z-10">
                <h2 class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-neutral-100">{{ $miembro['nombre'] }}</h2>
                <p class="text-emerald-600 dark:text-violet-400 font-medium mt-2 mb-8 tracking-wide">Desarrollador Full-Stack</p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    
                    <a href="{{ $miembro['github'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 px-6 py-3 bg-neutral-900 dark:bg-neutral-100 text-white dark:text-neutral-900 rounded-lg hover:bg-neutral-800 dark:hover:bg-white transition-colors font-medium text-sm shadow-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"></path></svg>
                        GitHub
                    </a>

                    <a href="mailto:{{ $miembro['email'] }}" class="flex items-center justify-center gap-2 px-6 py-3 border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-neutral-700 dark:text-neutral-200 rounded-lg hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors font-medium text-sm shadow-sm">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Email
                    </a>

                    <a href="{{ $miembro['instagram'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 px-6 py-3 border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-neutral-700 dark:text-neutral-200 rounded-lg hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors font-medium text-sm shadow-sm">
                        <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        Instagram
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</x-layouts::app>