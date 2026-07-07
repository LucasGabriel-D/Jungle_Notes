<div class="flex flex-col gap-4 p-4 text-neutral-800 antialiased">
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-neutral-900 flex items-center gap-2">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Calendario Académico
        </h2>
        <button
            wire:click="abrirModal"
            class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all duration-150"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Evento
        </button>
    </div>

    <div class="rounded-xl border border-neutral-200 bg-white p-4 shadow-sm">
        <div id="calendar" class="min-h-[300px]"></div>
    </div>

    @if($mostrarModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" wire:click.self="mostrarModal = false">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6" @click.outside="$wire.set('mostrarModal', false)">
            <h3 class="text-lg font-bold text-neutral-900 mb-4">{{ $editando ? 'Editar Evento' : 'Nuevo Evento' }}</h3>

            <form wire:submit="guardar" class="flex flex-col gap-4">
                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Título</label>
                    <input type="text" wire:model="titulo" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Ej: Parcial de Matemática">
                    @error('titulo') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Tipo</label>
                    <select wire:model="tipo" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="examen">Examen</option>
                        <option value="presentacion">Presentación</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Fecha Inicio</label>
                        <input type="datetime-local" wire:model="fechaInicio" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                        @error('fechaInicio') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Fecha Fin (opcional)</label>
                        <input type="datetime-local" wire:model="fechaFin" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-neutral-700 mb-1">Color</label>
                    <div class="flex gap-2">
                        @foreach(['#10b981' => 'Verde', '#ef4444' => 'Rojo', '#3b82f6' => 'Azul', '#f59e0b' => 'Amarillo', '#8b5cf6' => 'Violeta'] as $hex => $label)
                            <button type="button" wire:click="$set('color', '{{ $hex }}')"
                                class="w-8 h-8 rounded-full border-2 transition-all {{ $color === $hex ? 'border-neutral-900 scale-110' : 'border-transparent' }}"
                                style="background-color: {{ $hex }}" title="{{ $label }}"></button>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-2">
                    <button type="button" wire:click="$set('mostrarModal', false)" class="px-4 py-2 text-sm font-medium text-neutral-700 bg-neutral-100 hover:bg-neutral-200 rounded-lg transition-colors">
                        Cancelar
                    </button>
                    @if($editando)
                    <button type="button" wire:click="eliminar({{ $eventoId }})" wire:confirm="¿Eliminar este evento?"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        Eliminar
                    </button>
                    @endif
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-colors">
                        {{ $editando ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
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

        Livewire.on('eventosActualizados', () => {
            fetch('/api/calendario/eventos')
                .then(r => r.json())
                .then(events => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(events);
                });
        });
    </script>
    @endscript
</div>
