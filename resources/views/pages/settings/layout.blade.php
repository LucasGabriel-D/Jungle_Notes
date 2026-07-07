<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <nav class="flex flex-col gap-1">
            <a href="{{ route('profile.edit') }}" wire:navigate
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                {{ request()->routeIs('profile.edit') ? 'bg-emerald-50 dark:bg-violet-900/30 text-emerald-700 dark:text-violet-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-zinc-700' }}">
                Perfil
            </a>
            <a href="{{ route('security.edit') }}" wire:navigate
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                {{ request()->routeIs('security.edit') ? 'bg-emerald-50 dark:bg-violet-900/30 text-emerald-700 dark:text-violet-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-zinc-700' }}">
                Seguridad
            </a>
            <a href="{{ route('appearance.edit') }}" wire:navigate
                class="px-3 py-2 rounded-lg text-sm font-medium transition-colors
                {{ request()->routeIs('appearance.edit') ? 'bg-emerald-50 dark:bg-violet-900/30 text-emerald-700 dark:text-violet-400' : 'text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-zinc-700' }}">
                Apariencia
            </a>
        </nav>
    </div>

    <hr class="md:hidden border-neutral-200 dark:border-zinc-700 w-full mb-4">

    <div class="flex-1 self-stretch max-md:pt-6">
        @if($heading ?? false)
            <h2 class="text-lg font-bold text-neutral-900 dark:text-neutral-100">{{ $heading }}</h2>
        @endif
        @if($subheading ?? false)
            <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $subheading }}</p>
        @endif

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
