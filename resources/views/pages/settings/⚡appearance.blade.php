<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Apariencia')] class extends Component {
    //
}; ?>

<section class="w-full">
    @include('partials.settings-heading')

    <x-pages::settings.layout heading="Apariencia" subheading="Actualizá la configuración de apariencia de tu cuenta">

        <div class="mt-6">
            <p class="text-sm font-semibold text-neutral-700 dark:text-neutral-300 mb-3">Tema</p>
            <div class="flex gap-2">
                <button
                    onclick="setTheme('light')"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium transition-all duration-150 theme-btn"
                    data-theme="light"
                >
                     Claro
                </button>
                <button
                    onclick="setTheme('dark')"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium transition-all duration-150 theme-btn"
                    data-theme="dark"
                >
                     Oscuro
                </button>
                <button
                    onclick="setTheme('system')"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl border text-sm font-medium transition-all duration-150 theme-btn"
                    data-theme="system"
                >
                     Sistema
                </button>
            </div>
        </div>

        <script>
            function setTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else if (theme === 'light') {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    localStorage.removeItem('theme');
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
                updateButtons(theme);
            }

            function updateButtons(activeTheme) {
                document.querySelectorAll('.theme-btn').forEach(btn => {
                    if (btn.dataset.theme === activeTheme) {
                        btn.className = btn.className.replace('border-neutral-200 dark:border-zinc-700 text-neutral-600 dark:text-neutral-400', '');
                        btn.classList.add('border-emerald-500', 'bg-emerald-50', 'dark:bg-violet-900/30', 'text-emerald-700', 'dark:text-violet-400');
                    } else {
                        btn.classList.remove('border-emerald-500', 'bg-emerald-50', 'dark:bg-violet-900/30', 'text-emerald-700', 'dark:text-violet-400');
                        btn.classList.add('border-neutral-200', 'dark:border-zinc-700', 'text-neutral-600', 'dark:text-neutral-400');
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', () => {
                const saved = localStorage.getItem('theme') || 'system';
                updateButtons(saved);
            });

            document.addEventListener('livewire:navigated', () => {
                const saved = localStorage.getItem('theme') || 'system';
                updateButtons(saved);
            });
        </script>

    </x-pages::settings.layout>
</section>
