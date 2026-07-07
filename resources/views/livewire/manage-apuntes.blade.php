<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-neutral-800 dark:text-neutral-100">Gestionar Apuntes</h2>

    @if (session()->has('error'))
        <div class="bg-red-100 dark:bg-red-900/30 border-l-4 border-red-500 text-red-700 dark:text-red-400 p-4 mb-4 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('message'))
        <div class="bg-emerald-100 dark:bg-violet-900/30 border-l-4 border-emerald-500 text-emerald-700 dark:text-violet-400 p-4 mb-4 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm mb-8">
        <form wire:submit.prevent="store" class="space-y-4">
            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Título</label>
                <input type="text" wire:model="titulo" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150">
                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Descripción</label>
                <textarea wire:model="descripcion" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Materia</label>
                <select wire:model="materia_id" class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150">
                    <option value="">Seleccione una materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                @error('materia_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Archivo (PDF/Word, max 10MB)</label>
                <div class="mt-1 flex items-center gap-3">
                    <button type="button" onclick="document.getElementById('archivo-input').click()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-sm font-semibold shadow-sm transition-all duration-150 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Seleccionar archivo</span>
                    </button>
                    <input id="archivo-input" type="file" wire:model="archivo" class="hidden">
                    <span class="text-sm text-neutral-500 dark:text-neutral-400">
                        {{ $archivo ? $archivo->getClientOriginalName() : 'Ningún archivo seleccionado' }}
                    </span>
                </div>
                @error('archivo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                Subir Apunte
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar apuntes o materia..." class="mb-4 w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150">

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-neutral-200 dark:border-zinc-700">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Título</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Materia</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Autor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100 dark:divide-zinc-700">
                    @foreach($apuntes as $apunte)
    <tr class="hover:bg-emerald-50/40 dark:hover:bg-violet-900/20 transition" id="apunte-{{ $apunte->id }}">
                            <td class="px-4 py-3 text-sm font-medium text-neutral-900 dark:text-neutral-100">{{ $apunte->titulo }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400"><span class="bg-emerald-50 dark:bg-violet-900/30 text-emerald-700 dark:text-violet-400 px-2 py-0.5 rounded-full text-xs font-semibold">{{ $apunte->materia->nombre }}</span></td>
                            <td class="px-4 py-3 text-sm text-neutral-500 dark:text-neutral-400">{{ $apunte->user->name }}</td>
                            <td class="px-4 py-3 text-sm space-x-2">
                                <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-emerald-600 dark:text-violet-400 hover:text-emerald-800 dark:hover:text-violet-300 font-semibold">Abrir</a>
                                @if($apunte->user_id === auth()->id())
                                    <button wire:click="delete({{ $apunte->id }})" wire:confirm="¿Seguro que deseas eliminar?" class="text-red-500 hover:text-red-700 font-semibold cursor-pointer">Eliminar</button>
                                @endif
                            </td>
                        </tr>
                        <tr class="bg-neutral-50/50 dark:bg-zinc-900/30">
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
