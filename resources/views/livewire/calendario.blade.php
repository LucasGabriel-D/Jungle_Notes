<div class="flex flex-col gap-4 p-4 text-neutral-800 antialiased" x-data>
    <style>
        /* Base Variables & Font */
        .fc { 
            --fc-border-color: #f3f4f6; 
            --fc-page-bg: #ffffff; 
            --fc-neutral-bg: #f8fafc; 
            --fc-today-bg: #ecfdf5; 
            --fc-list-event-hover-bg: #f1f5f9; 
            --fc-event-border-color: transparent; 
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;
            font-size: 0.875rem; 
        }
        
        /* Toolbar (Header) */
        .fc .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 800; color: #0f172a; letter-spacing: -0.025em; }
        .fc .fc-button { 
            background: #ffffff !important; 
            border: 1px solid #e2e8f0 !important; 
            color: #475569 !important; 
            font-size: 0.85rem !important; 
            font-weight: 600 !important;
            padding: 0.4rem 0.8rem !important; 
            border-radius: 0.5rem !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s ease !important;
            text-transform: capitalize;
        }
        .fc .fc-button:hover { background: #f8fafc !important; color: #0f172a !important; border-color: #cbd5e1 !important; }
        .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .fc .fc-button-primary:not(:disabled):active { 
            background: #10b981 !important; 
            border-color: #10b981 !important; 
            color: #ffffff !important; 
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06) !important;
        }

        /* Grid & Cells */
        .fc td, .fc th { border-color: #f1f5f9; }
        .fc .fc-col-header-cell-cushion { color: #64748b; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.75rem 0; }
        .fc .fc-daygrid-day-number { color: #475569; font-size: 0.85rem; font-weight: 600; padding: 0.5rem; }
        .fc .fc-daygrid-day.fc-day-today { background-color: var(--fc-today-bg) !important; border-radius: 0.5rem; }
        
        /* Events */
        .fc .fc-event { 
            border-radius: 6px; 
            padding: 3px 6px; 
            font-size: 0.75rem; 
            font-weight: 600;
            border: none;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .fc .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            z-index: 10 !important;
            cursor: pointer;
        }
        .fc .fc-daygrid-block-event .fc-event-time { display: none; } /* Hide time in month view for cleaner look */
        .fc .fc-daygrid-more-link { color: #10b981; font-weight: 700; font-size: 0.75rem; text-decoration: none; padding: 2px 4px; border-radius: 4px; }
        .fc .fc-daygrid-more-link:hover { background: #ecfdf5; }

        /* Dark Mode Overrides */
        .dark .fc { 
            --fc-border-color: #3f3f46; 
            --fc-page-bg: #27272a; 
            --fc-neutral-bg: #3f3f46; 
            --fc-today-bg: rgba(139, 92, 246, 0.15); 
            --fc-list-event-hover-bg: #3f3f46; 
        }
        .dark .fc .fc-toolbar-title { color: #f4f4f5; }
        .dark .fc .fc-col-header-cell-cushion { color: #a1a1aa; }
        .dark .fc .fc-daygrid-day-number { color: #d4d4d8; }
        .dark .fc .fc-day-other .fc-daygrid-day-top { opacity: 0.3; }
        .dark .fc .fc-button { background: #3f3f46 !important; border-color: #52525b !important; color: #d4d4d8 !important; }
        .dark .fc .fc-button:hover { background: #52525b !important; color: #fafafa !important; }
        .dark .fc .fc-button-primary:not(:disabled).fc-button-active, 
        .dark .fc .fc-button-primary:not(:disabled):active { 
            background: #8b5cf6 !important; 
            border-color: #8b5cf6 !important; 
        }
        .dark .fc td, .dark .fc th, .dark .fc-scrollgrid { border-color: #3f3f46 !important; }
        .dark .fc-theme-standard td, .dark .fc-theme-standard th { border: 1px solid #3f3f46; }
        .dark .fc .fc-event { box-shadow: 0 1px 2px rgba(0,0,0,0.2); }
        .dark .fc .fc-event:hover { box-shadow: 0 4px 6px -1px rgba(0,0,0,0.3); }
        .dark .fc .fc-daygrid-more-link { color: #a78bfa; }
        .dark .fc .fc-daygrid-more-link:hover { background: rgba(139, 92, 246, 0.2); }
        .dark .fc .fc-popover { background: #27272a; border: 1px solid #52525b; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5); border-radius: 0.75rem; overflow: hidden; }
        .dark .fc .fc-popover-header { background: #3f3f46; padding: 0.5rem 1rem; }
        .dark .fc .fc-popover-title { color: #f4f4f5; font-weight: 700; }
        
        /* Light Mode Popover */
        .fc .fc-popover { border: 1px solid #e2e8f0; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); overflow: hidden; }
        .fc .fc-popover-header { background: #f8fafc; padding: 0.5rem 1rem; }
        .fc .fc-popover-title { font-weight: 700; }

        /* TimeGrid (Semana/Dia) Styling */
        .fc-theme-standard .fc-timegrid-slot-minor { border-top-style: dotted !important; }
        .fc .fc-timegrid-slot-label-cushion { font-size: 0.75rem; font-weight: 600; color: #94a3b8; }
        .fc .fc-timegrid-axis-cushion { font-size: 0.7rem; color: #cbd5e1; text-transform: uppercase; }
        
        .dark .fc .fc-timegrid-slot-label-cushion { color: #71717a; }
        .dark .fc .fc-timegrid-axis-cushion { color: #52525b; }
        
        /* TimeGrid Events */
        .fc .fc-timegrid-event {
            border-radius: 8px;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.2), 0 2px 4px rgba(0,0,0,0.05);
            padding: 4px;
        }
        .fc .fc-timegrid-event:hover {
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.3), 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        .fc .fc-timegrid-event .fc-event-title { font-weight: 700; font-size: 0.8rem; }
        .fc .fc-timegrid-event .fc-event-time { font-weight: 500; font-size: 0.7rem; opacity: 0.9; margin-bottom: 2px; }
        
        /* Indicador de Hora Actual */
        .fc .fc-timegrid-now-indicator-line { border-color: #ef4444; border-width: 2px; box-shadow: 0 1px 2px rgba(239, 68, 68, 0.5); }
        .fc .fc-timegrid-now-indicator-arrow { border-color: #ef4444; border-width: 5px; }
        
        .fc .fc-timegrid-col.fc-day-today { background-color: var(--fc-today-bg) !important; }

        /* Feriados Style (Color-mix background) */
        .fc .feriado-event {
            background-color: color-mix(in srgb, currentColor 12%, transparent) !important;
            border: none !important;
            padding: 4px 6px;
            border-radius: 6px;
        }
        .dark .fc .feriado-event {
            background-color: color-mix(in srgb, currentColor 25%, transparent) !important;
        }
        .fc .feriado-event .fc-event-main {
            font-weight: 700;
        }
    </style>
    @if (session()->has('error'))
        <div class="text-red-600 text-sm font-medium">{{ session('error') }}</div>
    @endif
    @if (session()->has('message'))
        <div class="text-emerald-600 dark:text-violet-400 text-sm font-medium">{{ session('message') }}</div>
    @endif

    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-neutral-900 dark:text-neutral-100 flex items-center gap-2">
            <svg class="w-6 h-6 text-emerald-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <div class="bg-white dark:bg-zinc-800 p-6 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm overflow-hidden">
        <div class="overflow-x-auto overflow-y-hidden">
            <div id="calendar" class="min-w-[800px] min-h-[400px] dark:text-neutral-200" wire:ignore></div>
        </div>
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
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Inicio</label>
                        <input type="datetime-local" wire:model="fechaInicio" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10">
                        @error('fechaInicio') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Fin (opcional)</label>
                        <input type="datetime-local" wire:model="fechaFin" class="w-full rounded-lg border border-neutral-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 px-3 py-2 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10">
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
            allDayText: 'Todo el día',
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                meridiem: false,
                hour12: false
            },
            events: @js($this->getEventos()),
            dateClick: function(info) {
                $wire.abrirModal(info.dateStr);
            },
            eventClick: function(info) {
                if (info.event.extendedProps.tipo !== 'feriado') {
                    $wire.abrirEditar(info.event.extendedProps.originalId);
                }
            },
            dayMaxEvents: 3,
        });
        calendar.render();
        document.getElementById('calendar')._fc = calendar;

        $wire.on('eventosActualizados', async () => {
            const eventos = await $wire.getEventos();
            calendar.removeAllEvents();
            calendar.addEventSource(eventos);
        });
    </script>
    @endscript
</div>
