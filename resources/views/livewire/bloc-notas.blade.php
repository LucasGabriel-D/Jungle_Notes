<div class="p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-neutral-800 dark:text-neutral-100">Bloc de Notas</h2>

    @if (session()->has('message'))
        <div class="bg-emerald-100 dark:bg-violet-900/30 border-l-4 border-emerald-500 text-emerald-700 dark:text-violet-400 p-4 mb-4 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Calendario -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm p-5">

            <!-- Header del calendario -->
            <div class="flex items-center justify-between mb-4">
                <button wire:click="mesAnterior" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-zinc-700 transition text-neutral-600 dark:text-neutral-400">
                    ←
                </button>
                <h3 class="text-sm font-bold text-neutral-800 dark:text-neutral-100 capitalize">
                    {{ \Carbon\Carbon::create($anioActual, $mesActual, 1)->locale('es')->isoFormat('MMMM YYYY') }}
                </h3>
                <button wire:click="mesSiguiente" class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-zinc-700 transition text-neutral-600 dark:text-neutral-400">
                    →
                </button>
            </div>

            <!-- Días de la semana -->
            <div class="grid grid-cols-7 mb-2">
                @foreach(['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'] as $dia)
                    <div class="text-center text-xs font-semibold text-neutral-400 dark:text-neutral-500 py-1">{{ $dia }}</div>
                @endforeach
            </div>

            <!-- Días del mes -->
            @php
                $primerDia = \Carbon\Carbon::create($anioActual, $mesActual, 1);
                $diasEnMes = $primerDia->daysInMonth;
                $inicioDeSemana = $primerDia->dayOfWeekIso - 1;
            @endphp

            <div class="grid grid-cols-7 gap-1">
                @for ($i = 0; $i < $inicioDeSemana; $i++)
                    <div></div>
                @endfor

                @for ($dia = 1; $dia <= $diasEnMes; $dia++)
                    @php
                        $fecha = \Carbon\Carbon::create($anioActual, $mesActual, $dia)->toDateString();
                        $esHoy = $fecha === now()->toDateString();
                        $esSeleccionado = $fecha === $fechaSeleccionada;
                        $tieneNotas = in_array($fecha, $diasConNotas);
                    @endphp
                    <button
                        wire:click="seleccionarFecha('{{ $fecha }}')"
                        class="relative flex items-center justify-center h-9 w-full rounded-lg text-sm font-medium transition-all duration-150
                            {{ $esSeleccionado ? 'bg-emerald-600 text-white' : ($esHoy ? 'border-2 border-emerald-500 text-emerald-700 dark:text-violet-400' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-zinc-700') }}"
                    >
                        {{ $dia }}
                        @if ($tieneNotas && !$esSeleccionado)
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-emerald-500"></span>
                        @endif
                    </button>
                @endfor
            </div>
        </div>

        <!-- Panel de notas -->
        <div class="flex flex-col gap-4">

            <!-- Fecha seleccionada -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm p-5">
                <h3 class="text-sm font-bold text-neutral-700 dark:text-neutral-300 mb-3">
                     {{ \Carbon\Carbon::parse($fechaSeleccionada)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                </h3>

                <textarea
                    wire:model="contenido"
                    rows="4"
                    placeholder="Escribí una nota rápida..."
                    class="w-full px-4 py-2.5 rounded-xl border border-neutral-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-neutral-900 dark:text-neutral-100 text-sm focus:border-emerald-500 dark:focus:border-violet-500 focus:ring-4 focus:ring-emerald-500/10 dark:focus:ring-violet-500/10 focus:outline-none transition duration-150 resize-none"
                ></textarea>
                @error('contenido') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <button
                    wire:click="guardarNota"
                    class="mt-3 w-full bg-emerald-600 hover:bg-emerald-700 dark:bg-violet-600 dark:hover:bg-violet-700 text-white font-semibold text-sm py-2.5 px-4 rounded-xl shadow-sm transition-all duration-150"
                >
                    Guardar nota
                </button>
            </div>

            <!-- Notas del día -->
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm p-5 flex flex-col gap-3">
                <h3 class="text-sm font-bold text-neutral-700 dark:text-neutral-300">
                    Notas del día ({{ count($notasDelDia) }})
                </h3>

                @forelse($notasDelDia as $nota)
                    <div class="p-3 bg-emerald-50/40 dark:bg-violet-900/20 rounded-xl border border-emerald-100 dark:border-violet-800/50 flex items-start justify-between gap-3">
                        <p class="text-sm text-neutral-700 dark:text-neutral-300 flex-1">{{ $nota->contenido }}</p>
                        <button
                            wire:click="eliminarNota({{ $nota->id }})"
                            wire:confirm="¿Eliminar esta nota?"
                            class="text-red-400 hover:text-red-600 transition shrink-0 text-xs font-semibold"
                        >
                            Eliminar
                        </button>
                    </div>
                @empty
                    <p class="text-sm text-neutral-400 dark:text-neutral-500">No hay notas para este día.</p>
                @endforelse
            </div>

        </div>
    </div>
</div>