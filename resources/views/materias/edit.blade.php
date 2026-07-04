<x-layouts::app :title="'Editar Materia'">
    <div class="p-6 max-w-2xl mx-auto">
        <a href="{{ route('materias.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 hover:text-emerald-700 transition-colors no-underline mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Volver a materias
        </a>

        <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm">
            <h2 class="text-xl font-bold text-neutral-900 mb-6">Editar Materia</h2>

            <form method="POST" action="{{ route('materias.update', $materia) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $materia->nombre) }}" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150" required>
                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 mb-1">Descripción</label>
                    <textarea name="descripcion" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150">{{ old('descripcion', $materia->descripcion) }}</textarea>
                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-neutral-700 mb-1">Año</label>
                    <select name="anio" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150" required>
                        @foreach (range(1, 5) as $anio)
                            <option value="{{ $anio }}" {{ old('anio', $materia->anio) == $anio ? 'selected' : '' }}>{{ $anio }}°</option>
                        @endforeach
                    </select>
                    @error('anio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                    Guardar Cambios
                </button>
            </form>
        </div>
    </div>
</x-layouts::app>
