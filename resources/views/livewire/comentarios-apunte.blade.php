<div class="mt-4">
    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Comentarios</h3>

    @if (session()->has('success'))
        <div class="text-green-600 text-sm mb-2">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="store" class="mb-4">
        <textarea wire:model="contenido" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white" placeholder="Escribe un comentario..."></textarea>
        @error('contenido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        <button type="submit" class="mt-2 bg-indigo-600 text-white py-1 px-3 rounded text-sm hover:bg-indigo-700">Enviar</button>
    </form>

    <div class="space-y-4">
        @foreach($comentarios as $comentario)
            <div class="bg-gray-50 dark:bg-neutral-700 p-3 rounded-lg border dark:border-neutral-600">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-sm text-gray-700 dark:text-gray-200">{{ $comentario->user->name }}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comentario->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mt-1 text-sm">{{ $comentario->contenido }}</p>

                @if($comentario->user_id === auth()->id())
                    <button wire:click="delete({{ $comentario->id }})" wire:confirm="¿Seguro que quieres eliminar este comentario?" class="text-red-500 text-xs mt-2 hover:underline">Eliminar</button>
                @endif
            </div>
        @endforeach
    </div>
</div>
