<div class="flex flex-col gap-4 p-4 text-neutral-800 antialiased" x-data>
    <style>
        .fc { --fc-border-color: #e5e7eb; --fc-page-bg: #fff; --fc-neutral-bg: #f9fafb; --fc-today-bg: rgba(16, 185, 129, 0.08); --fc-list-event-hover-bg: #f9fafb; --fc-event-border-color: transparent; font-size: 0.85rem; }
        .fc .fc-toolbar-title { font-size: 1.1rem !important; font-weight: 700; color: #1f2937; }
        .fc .fc-col-header-cell-cushion { color: #374151; font-weight: 600; font-size: 0.8rem; }
        .fc .fc-daygrid-day-number { color: #4b5563; font-size: 0.8rem; }
        .fc .fc-daygrid-more-link { color: #059669; font-size: 0.75rem; }
        .fc .fc-button { background: #fff !important; border-color: #d1d5db !important; color: #374151 !important; font-size: 0.8rem !important; padding: 0.3rem 0.6rem !important; }
        .fc .fc-button:hover { background: #f3f4f6 !important; border-color: #9ca3af !important; }
        .fc .fc-button-primary:not(:disabled).fc-button-active, .fc .fc-button-primary:not(:disabled):active { background: #059669 !important; border-color: #059669 !important; color: #fff !important; }
        .fc .fc-popover { background: #fff; border-color: #d1d5db; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .fc .fc-popover-title { color: #1f2937; }
        .fc td, .fc th { border-color: #e5e7eb; }
        .fc .fc-scrollgrid { border-color: #e5e7eb; }
        .fc .fc-list-table tr { border-color: #e5e7eb; }
        .fc .fc-list-day-cushion { background: #f9fafb; }
        .fc .fc-list-day-text, .fc .fc-list-day-side-text { color: #374151; }
        .fc .fc-daygrid-day { min-height: 28px; }
        .fc .fc-timegrid-slot { height: 1.2rem; }
        .fc .fc-timegrid-axis { width: 40px; }
        .fc .fc-event { border-radius: 4px; padding: 1px 4px; font-size: 0.78rem; }
        .fc .fc-daygrid-block-event .fc-event-time { font-size: 0.75rem; }
        .fc .fc-daygrid-day-events { margin-top: 2px; }
        .dark .fc { --fc-border-color: #52525b; --fc-page-bg: #27272a; --fc-neutral-bg: #3f3f46; --fc-today-bg: rgba(139, 92, 246, 0.12); --fc-list-event-hover-bg: #3f3f46; }
        .dark .fc .fc-toolbar-title { color: #e4e4e7; }
        .dark .fc .fc-col-header-cell-cushion { color: #d4d4d8; }
        .dark .fc .fc-daygrid-day-number { color: #a1a1aa; }
        .dark .fc .fc-daygrid-more-link { color: #a78bfa; }
        .dark .fc .fc-day-other .fc-daygrid-day-top { opacity: 0.4; }
        .dark .fc .fc-button { background: #3f3f46 !important; border-color: #52525b !important; color: #e4e4e7 !important; }
        .dark .fc .fc-button:hover { background: #52525b !important; border-color: #71717a !important; }
        .dark .fc .fc-button-primary:not(:disabled).fc-button-active, .dark .fc .fc-button-primary:not(:disabled):active { background: #7c3aed !important; border-color: #7c3aed !important; }
        .dark .fc .fc-popover { background: #27272a; border-color: #52525b; }
        .dark .fc .fc-popover-title { color: #e4e4e7; }
        .dark .fc .fc-more-popover .fc-daygrid-day-events { background: #27272a; }
        .dark .fc td, .dark .fc th { border-color: #3f3f46; }
        .dark .fc .fc-scrollgrid { border-color: #3f3f46; }
        .dark .fc .fc-list-table tr { border-color: #3f3f46; }
        .dark .fc .fc-list-day-cushion { background: #3f3f46; }
        .dark .fc .fc-list-day-text, .dark .fc .fc-list-day-side-text { color: #e4e4e7; }
        .dark .fc .fc-daygrid-day { min-height: 28px; }
    </style>
    @if (session()->has('error'))
        <div class="text-red-600 text-sm font-medium">{{ session('error') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="text-emerald-600 text-sm font-medium">{{ session('message') }}</div>
    @endif

    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100 flex items-center gap-2">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Calendario Académico
        </h2>
        <button
            wire:click="abrirModal"
            class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all duration-150"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Evento
        </button>
    </div>

    <div class="rounded-xl border border-neutral-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-4 shadow-sm">
        <div id="calendar" class="min-h-[300px] dark:text-neutral-200" wire:ignore></div>
    </div>

    @if($mostrarModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" wire:click.self="mostrarModal = false">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6" @click.outside="$wire.set('mostrarModal', false)">
            <h3 class="text-lg font-bold text-neutral-900 dark:text-neutral-100 mb-4">{{ $editando ? 'Editar Evento' : 'Nuevo Evento' }}</h3>

            <form wire:submit="guardar" class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Título</label>
                    <input type="text" wire:model="titulo" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10" placeholder="Ej: Parcial de Matemática">
                    @error('titulo') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Tipo</label>
                    <select wire:model="tipo" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10">
                        <option value="examen">Examen</option>
                        <option value="presentacion">Presentación</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Fecha</label>
                        <input type="date" wire:model="fechaInicio" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10">
                        @error('fechaInicio') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Fecha Fin (opcional)</label>
                        <input type="date" wire:model="fechaFin" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Color</label>
                    <div class="flex gap-2">
                        @foreach(['#10b981' => 'Verde', '#ef4444' => 'Rojo', '#3b82f6' => 'Azul', '#f59e0b' => 'Amarillo', '#8b5cf6' => 'Violeta'] as $hex => $label)
                            <button type="button" wire:click="$set('color', '{{ $hex }}')"
                                class="w-8 h-8 rounded-full border-2 transition-all {{ $color === $hex ? 'border-neutral-900 dark:border-neutral-100 scale-110' : 'border-transparent' }}"
                                style="background-color: {{ $hex }}" title="{{ $label }}"></button>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" wire:click="$set('mostrarModal', false)" class="px-4 py-2 text-sm font-medium text-neutral-700 dark:text-neutral-300 bg-neutral-100 dark:bg-zinc-700 hover:bg-neutral-200 dark:hover:bg-zinc-600 rounded-lg transition-colors">
                        Cancelar
                    </button>
                    @if($editando)
                    <button type="button" wire:click="$set('confirmando', true)"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        Eliminar
                    </button>
                    @endif
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 rounded-lg transition-colors">
                        {{ $editando ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($confirmando)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-sm p-6">
            <p class="text-neutral-800 dark:text-neutral-200 font-medium mb-4">¿Eliminar este evento?</p>
            <div class="flex justify-end gap-2">
                <button wire:click="$set('confirmando', false)" class="px-4 py-2 text-sm font-medium rounded-lg bg-neutral-100 dark:bg-zinc-700 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-zinc-600 transition-colors">Cancelar</button>
                <button wire:click="eliminar" class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Sí, eliminar</button>
            </div>
        </div>
    </div>
    @endif

    @script
    <script>
        const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            locale: 'es',
            contentHeight: 'auto',
            aspectRatio: 2.2,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
            },
            events: @js($this->getEventos()),
            dateClick: function(info) {
                $wire.abrirModal(info.dateStr);
            },
            eventClick: function(info) {
                if (info.event.extendedProps.tipo !== 'feriado') {
                    $wire.abrirEditar(info.event.id);
                }
            },
            eventDisplay: 'block',
            dayMaxEvents: 3,
        });
        calendar.render();
        document.getElementById('calendar')._fc = calendar;
    </script>
    @endscript
</div>
