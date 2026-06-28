<flux:dropdown position="bottom" align="start">
    <flux:sidebar.profile
        :name="auth()->user()->name"
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
    />

    <flux:menu class="min-w-[220px]">
        <div class="flex items-center gap-3 px-3 py-2 text-start text-sm">
            <flux:avatar
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                class="ring-2 ring-emerald-100"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate font-semibold text-neutral-900">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate text-neutral-500 text-xs">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="text-neutral-700 hover:bg-emerald-50 hover:text-emerald-700 cursor-pointer">
                {{ __('Ajustes') }}
            </flux:menu.item>
            <flux:menu.separator />
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full text-neutral-700 hover:bg-emerald-50 hover:text-red-600 cursor-pointer"
                    data-test="logout-button"
                >
                    {{ __('Cerrar sesión') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
