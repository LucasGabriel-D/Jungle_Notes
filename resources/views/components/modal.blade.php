@props(['show' => '', 'title' => '', 'maxWidth' => 'md'])

@php
$widths = ['sm' => 'max-w-sm', 'md' => 'max-w-md', 'lg' => 'max-w-lg', 'xl' => 'max-w-xl'];
$w = $widths[$maxWidth] ?? 'max-w-md';
@endphp

<div x-data="{ open: @entangle($show) }" x-show="open" x-cloak x-transition.opacity.duration.200ms
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
     x-on:keydown.escape.window="open = false">
    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full {{ $w }} p-6 dark:border dark:border-zinc-700"
         x-on:click.outside="open = false" x-show="open" x-transition.scale.origin.center.duration.200ms>
        @if($title)
        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-4">{{ $title }}</h3>
        @endif
        {{ $slot }}
    </div>
</div>
