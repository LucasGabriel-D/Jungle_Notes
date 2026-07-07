<?php

use App\Concerns\ProfileValidationRules;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Configuración de Perfil')] class extends Component {
    use ProfileValidationRules;

    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();
        $validated = $this->validate($this->profileRules($user->id));
        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        session()->flash('status', 'profile-updated');
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && ! Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function showDeleteUser(): bool
    {
        return ! Auth::user() instanceof MustVerifyEmail
            || (Auth::user() instanceof MustVerifyEmail && Auth::user()->hasVerifiedEmail());
    }
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-pages::settings.layout heading="Perfil" subheading="Actualizá tu nombre y correo electrónico">

        @if (session('status') === 'profile-updated')
            <div class="bg-emerald-100 dark:bg-violet-900/30 border-l-4 border-emerald-500 dark:border-violet-500 text-emerald-700 dark:text-violet-400 p-4 mb-4 rounded-lg">
                Perfil actualizado correctamente.
            </div>
        @endif

        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Nombre</label>
                <input
                    wire:model="name"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                >
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-1">Correo electrónico</label>
                <input
                    wire:model="email"
                    type="email"
                    required
                    autocomplete="email"
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150"
                >
                @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror

                @if ($this->hasUnverifiedEmail)
                    <div class="mt-3">
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            Tu correo electrónico no está verificado.
                            <button type="button" wire:click.prevent="resendVerificationNotification" class="text-emerald-600 dark:text-violet-400 hover:underline font-semibold">
                                Hacé clic acá para reenviar el correo de verificación.
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm font-medium text-emerald-600 dark:text-violet-400">
                                Se envió un nuevo enlace de verificación a tu correo electrónico.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="bg-emerald-600 dark:bg-violet-600 hover:bg-emerald-700 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl shadow-sm transition-all duration-150">
                    Guardar
                </button>
            </div>

        </form>

        @if ($this->showDeleteUser)
            <livewire:pages::settings.delete-user-form />
        @endif

    </x-pages::settings.layout>
</section>
