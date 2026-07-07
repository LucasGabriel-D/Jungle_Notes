<x-layouts::app :title="'Nueva Materia'">
    <div class="p-6 max-w-2xl mx-auto">
        <a href="{{ route('materias.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-emerald-700 dark:hover:text-violet-400 transition-colors no-underline mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Volver a materias
        </a>

        <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm">
            <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100 mb-6">Nueva Materia</h2>

            <form method="POST" action="{{ route('materias.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150" required>
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150">{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Año</label>
                    <select name="anio" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150" required>
                        <option value="">Seleccionar año</option>
                        @foreach (range(1, 5) as $anio)
                            <option value="{{ $anio }}" {{ old('anio') == $anio ? 'selected' : '' }}>{{ $anio }}°</option>
                        @endforeach
                    </select>
                    @error('anio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                    Crear Materia
                </button>
            </form>
        </div>
    </div>
</x-layouts::app>
