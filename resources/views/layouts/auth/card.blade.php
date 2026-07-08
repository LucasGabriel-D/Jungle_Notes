<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-green-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 antialiased">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex items-center gap-2">
                        <img src="{{ asset('images/iconverde.png') }}" class="w-10 h-10 object-contain" alt="Logo">
                        <span class="text-xl font-bold text-emerald-600 dark:text-violet-400">JungleNotes</span>
                    </span>
                </a>

                <div class="flex flex-col gap-6">
                    <div class="rounded-xl border border-emerald-100 dark:border-violet-900 bg-white dark:bg-zinc-800 shadow-sm">
                        <div class="px-10 py-8">{{ $slot }}</div>
                    </div>
                </div>
            </div>
        </div>

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
