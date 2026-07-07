<div class="mt-4">
    <h4 class="text-sm font-bold text-neutral-700 dark:text-neutral-300 mb-3 flex items-center gap-1.5">
        <svg class="w-4 h-4 text-emerald-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        Comentarios
    </h4>

    @if (session()->has('success'))
        <div class="text-emerald-600 dark:text-violet-400 text-sm font-medium mb-2">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="store" class="mb-4 flex gap-2">
        <textarea wire:model="contenido" rows="1" class="flex-1 px-3 py-2 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150" placeholder="Escribe un comentario..."></textarea>
        @error('contenido') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm transition cursor-pointer shrink-0">Enviar</button>
    </form>

    <div class="space-y-2">
        @foreach($comentarios as $comentario)
            <div class="bg-emerald-50/40 dark:bg-violet-950/20 p-3 rounded-xl border border-emerald-100/70 dark:border-violet-900/50">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-xs text-neutral-700 dark:text-neutral-300">{{ $comentario->user->name }}</span>
                    <span class="text-[10px] text-neutral-400 dark:text-neutral-500 font-medium">{{ $comentario->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-neutral-600 dark:text-neutral-400 mt-1 text-sm">{{ $comentario->contenido }}</p>

                @if($comentario->user_id === auth()->id())
                    <button wire:click="delete({{ $comentario->id }})" wire:confirm="¿Seguro que quieres eliminar este comentario?" class="text-red-400 hover:text-red-600 text-[10px] mt-1.5 font-semibold cursor-pointer transition">Eliminar</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
