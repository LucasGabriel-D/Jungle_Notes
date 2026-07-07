<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="flex items-center gap-2 px-2 py-1.5 rounded-xl hover:bg-neutral-100 dark:hover:bg-zinc-700 transition w-full" data-test="sidebar-menu-button">
        <div class="w-8 h-8 rounded-full bg-emerald-600 dark:bg-violet-600 text-white flex items-center justify-center text-xs font-bold shrink-0">
            {{ auth()->user()->initials() }}
        </div>
        <div class="flex-1 text-left min-w-0">
            <p class="text-sm font-semibold text-neutral-900 dark:text-neutral-100 truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 truncate">{{ auth()->user()->email }}</p>
        </div>
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/>
        </svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition
        class="absolute bottom-full left-0 mb-2 w-full bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-lg overflow-hidden z-50">
        
        <div class="px-3 py-2.5 border-b border-neutral-100 dark:border-zinc-700">
            <p class="text-sm font-semibold text-neutral-900 dark:text-neutral-100 truncate">{{ auth()->user()->name }}</p>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 truncate">{{ auth()->user()->email }}</p>
        </div>

        <div class="py-1">
            <a href="{{ route('profile.edit') }}" wire:navigate class="flex items-center gap-2 px-3 py-2 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-emerald-50 dark:hover:bg-zinc-700 hover:text-emerald-700 dark:hover:text-emerald-400 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ajustes
            </a>
        </div>

        <div class="border-t border-neutral-100 dark:border-zinc-700 py-1">
            <button onclick="toggleDarkMode()" class="flex items-center gap-2 px-3 py-2 text-sm text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-zinc-700 transition w-full">
                <svg class="w-4 h-4 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                </svg>
                <svg class="w-4 h-4 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="dark:hidden">Modo Oscuro</span>
                <span class="hidden dark:block">Modo Claro</span>
            </button>
        </div>

        <div class="border-t border-neutral-100 dark:border-zinc-700 py-1">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 px-3 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-700 transition w-full cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</div>