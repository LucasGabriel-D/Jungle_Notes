@props([
    'show' => '',
    'title' => 'Confirmar acción',
    'message' => '¿Estás seguro?',
    'confirmText' => 'Sí, confirmar',
    'confirmEvent' => '',
])

<div x-data="{ open: @entangle($show) }" x-show="open" x-cloak x-transition.opacity.duration.200ms
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
     x-on:keydown.escape.window="open = false">
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-sm p-6 dark:border dark:border-zinc-700"
         x-on:click.outside="open = false" x-show="open" x-transition.scale.origin.center.duration.200ms>
        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2">{{ $title }}</h3>
        <p class="text-neutral-700 dark:text-neutral-300 mb-6">{{ $message }}</p>
        <div class="flex justify-end gap-2">
            <button type="button" x-on:click="open = false"
                class="px-4 py-2 text-sm font-medium rounded-lg bg-neutral-100 dark:bg-zinc-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-zinc-600 transition-colors cursor-pointer">
                Cancelar
            </button>
            <button type="button" x-on:click="open = false; $wire.{{ $confirmEvent }}"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors cursor-pointer">
                {{ $confirmText }}
            </button>
        </div>
    </div>
</div>
