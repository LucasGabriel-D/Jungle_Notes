<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-neutral-800">Gestionar Apuntes</h2>

    @if (session()->has('message'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-4 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm mb-8">
        <form wire:submit.prevent="store" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-1">Título</label>
                <input type="text" wire:model="titulo" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150">
                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-1">Descripción</label>
                <textarea wire:model="descripcion" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-1">Materia</label>
                <select wire:model="materia_id" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150">
                    <option value="">Seleccione una materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                @error('materia_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 mb-1">Archivo (PDF/Word, max 10MB)</label>
                <div class="mt-1 flex items-center gap-3">
                    <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 text-sm font-semibold hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Seleccionar archivo</span>
                        <input type="file" wire:model="archivo" class="hidden">
                    </label>
                    <span class="text-sm text-neutral-500">
                        {{ $archivo ? $archivo->getClientOriginalName() : 'Ningún archivo seleccionado' }}
                    </span>
                </div>
                @error('archivo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                Subir Apunte
            </button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-xl border border-neutral-200 shadow-sm">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar apuntes o materia..." class="mb-4 w-full px-4 py-2.5 rounded-xl border border-neutral-200 text-neutral-900 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150">

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-neutral-200">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Título</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Materia</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Autor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @foreach($apuntes as $apunte)
                        <tr class="hover:bg-emerald-50/40 transition">
                            <td class="px-4 py-3 text-sm font-medium text-neutral-900">{{ $apunte->titulo }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600"><span class="bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $apunte->materia->nombre }}</span></td>
                            <td class="px-4 py-3 text-sm text-neutral-500">{{ $apunte->user->name }}</td>
                            <td class="px-4 py-3 text-sm space-x-2">
                                <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-emerald-600 hover:text-emerald-800 font-semibold">Abrir</a>
                                @if($apunte->user_id === auth()->id())
                                    <button wire:click="delete({{ $apunte->id }})" wire:confirm="¿Seguro que deseas eliminar?" class="text-red-500 hover:text-red-700 font-semibold cursor-pointer">Eliminar</button>
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-neutral-50/50">
                            <td colspan="4" class="px-4 py-3">
                                <livewire:comentarios-apunte :apunte_id="$apunte->id" :key="'comentarios-' . $apunte->id" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
