<?php

use App\Concerns\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Seguridad')] class extends Component {
    use PasswordValidationRules;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => $this->currentPasswordRules(),
                'password' => $this->passwordRules(),
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => $validated['password'],
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        session()->flash('status', 'password-updated');
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-pages::settings.layout heading="Actualizar contraseña" subheading="Asegurate de usar una contraseña larga y aleatoria para mantener tu cuenta segura">

        @if (session('status') === 'password-updated')
            <div class="bg-emerald-100 dark:bg-emerald-900/30 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 p-4 mb-4 rounded-lg">
                Contraseña actualizada correctamente.
            </div>
        @endif

        <form method="POST" wire:submit="updatePassword" class="mt-6 space-y-6">

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Contraseña actual</label>
                <input
                    wire:model="current_password"
                    type="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                >
                @error('current_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Nueva contraseña</label>
                <input
                    wire:model="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                >
                @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Confirmar contraseña</label>
                <input
                    wire:model="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition duration-150"
                >
                @error('password_confirmation') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl shadow-sm transition-all duration-150">
                    Guardar
                </button>
            </div>

        </form>
    </x-pages::settings.layout>
</section>
