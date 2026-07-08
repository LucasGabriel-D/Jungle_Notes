<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
     <body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 antialiased">
        <flux:sidebar sticky collapsible="mobile" class="border-e border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-900 shadow-sm">
            <flux:sidebar.header class="flex items-center justify-between w-full">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-2 py-1 min-w-0 no-underline">
                    <img src="{{ asset('images/iconverde.svg') }}" class="w-14 h-14 shrink-0 object-contain chameleon-logo" alt="Logo">
<div class="min-w-0">
    <h1 class="text-base font-bold text-neutral-900 leading-tight">
        <span class="block text-emerald-600 dark:text-violet-400">Jungle</span>
        <span class="block dark:text-white">Notes</span>
    </h1>
    <p class="text-[10px] text-neutral-400 font-medium">UTN FRRE</p>
</div>
                </a>
                <flux:sidebar.collapse class="lg:hidden shrink-0 ml-2" />
            </flux:sidebar.header>

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Navegación')" class="grid">
                    <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Panel General') }}
                    </flux:sidebar.item>
                    <flux:sidebar.item icon="book-open" :href="route('materias.index')" :current="request()->routeIs('materias.*')" wire:navigate>
                        {{ __('Mis Materias') }}
                    </flux:sidebar.item>
                    
                    <flux:sidebar.item icon="calendar-days" href="{{ route('calendario') }}" :current="request()->routeIs('calendario*')" wire:navigate>
                        {{ __('Calendario') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav>
                <flux:sidebar.group :heading="__('Equipo')" class="grid">
                    <flux:sidebar.item icon="users" :href="route('equipo')" :current="request()->routeIs('equipo')" wire:navigate>
                        {{ __('Equipo Iceberg') }}
                    </flux:sidebar.item>
                </flux:sidebar.group>
            </flux:sidebar.nav>

            <x-desktop-user-menu class="hidden lg:block" />
            
                  </flux:sidebar>

        <!-- Mobile Header with User Menu -->
        <flux:header class="lg:hidden bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md border-b border-neutral-100 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <div class="flex items-center gap-2">
                <span class="text-sm font-bold text-emerald-600 dark:text-violet-400">JungleNotes</span>
            </div>

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Ajustes') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Cerrar sesión') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @persist('toast')
            <flux:toast.group>
                <flux:toast />
            </flux:toast.group>
        @endpersist

        @fluxScripts
    </body>
</html>
