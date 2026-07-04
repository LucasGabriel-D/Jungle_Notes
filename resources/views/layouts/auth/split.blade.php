<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white antialiased">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <div class="relative hidden h-full flex-col p-10 text-white lg:flex bg-gradient-to-br from-emerald-600 to-emerald-800">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/90 to-emerald-900/90"></div>
                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-2 text-lg font-medium" wire:navigate>
                    <img src="{{ asset('images/iconverde.png') }}" class="h-8 w-8 object-contain" alt="Logo">
                    <span class="font-bold">Jungle<span class="text-emerald-200">Notes</span></span>
                </a>

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-2">
                        <flux:heading size="lg" class="text-white/90">&ldquo;Compartí, ordená y comentá el material de estudio con tus compañeros.&rdquo;</flux:heading>
                        <footer><flux:heading class="text-emerald-200">Equipo Iceberg — UTN FRRE</flux:heading></footer>
                    </blockquote>
                </div>
            </div>
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex items-center gap-2">
                            <img src="{{ asset('images/iconverde.png') }}" class="w-9 h-9 object-contain" alt="Logo">
                            <span class="text-lg font-bold text-emerald-600">JungleNotes</span>
                        </span>
                    </a>
                    {{ $slot }}
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
