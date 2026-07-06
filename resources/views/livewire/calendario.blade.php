<div class="p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-neutral-800 dark:text-neutral-100">Calendario</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Calendario -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm p-5">

            <!-- Header -->
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
                        $tieneNotas = isset($notas[$fecha]);
                        $tieneApuntes = isset($apuntes[$fecha]);
                    @endphp
                    <button
                        wire:click="seleccionarFecha('{{ $fecha }}')"
                        class="relative flex flex-col items-center justify-center h-10 w-full rounded-lg text-sm font-medium transition-all duration-150
                            {{ $esSeleccionado ? 'bg-emerald-600 text-white' : ($esHoy ? 'border-2 border-emerald-500 text-emerald-700 dark:text-emerald-400' : 'text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-zinc-700') }}"
                    >
                        {{ $dia }}
                        <div class="flex gap-0.5 mt-0.5">
                            @if ($tieneNotas)
                                <span class="w-1 h-1 rounded-full bg-emerald-400"></span>
                            @endif
                            @if ($tieneApuntes)
                                <span class="w-1 h-1 rounded-full bg-blue-400"></span>
                            @endif
                        </div>
                    </button>
                @endfor
            </div>

            <!-- Leyenda -->
            <div class="flex items-center gap-4 mt-4 pt-4 border-t border-neutral-100 dark:border-zinc-700">
                <div class="flex items-center gap-1.5 text-xs text-neutral-500 dark:text-neutral-400">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Notas
                </div>
                <div class="flex items-center gap-1.5 text-xs text-neutral-500 dark:text-neutral-400">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    Apuntes
                </div>
            </div>
        </div>

        <!-- Panel de eventos del día -->
        <div class="flex flex-col gap-4">
            <div class="bg-white dark:bg-zinc-800 rounded-xl border border-neutral-200 dark:border-zinc-700 shadow-sm p-5">
                <h3 class="text-sm font-bold text-neutral-700 dark:text-neutral-300 mb-4">
                     {{ \Carbon\Carbon::parse($fechaSeleccionada)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                </h3>

                <!-- Notas del día -->
                @if(count($eventosDelDia['notas'] ?? []) > 0)
                    <div class="mb-4">
                        <h4 class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-2">📝 Notas</h4>
                        <div class="flex flex-col gap-2">
                            @foreach($eventosDelDia['notas'] as $nota)
                                <div class="p-3 bg-emerald-50/40 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-800/50">
                                    <p class="text-sm text-neutral-700 dark:text-neutral-300">{{ $nota->contenido }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Apuntes del día -->
                @if(count($eventosDelDia['apuntes'] ?? []) > 0)
                    <div>
                        <h4 class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider mb-2">📄 Apuntes subidos</h4>
                        <div class="flex flex-col gap-2">
                            @foreach($eventosDelDia['apuntes'] as $apunte)
                                <div class="p-3 bg-blue-50/40 dark:bg-blue-900/20 rounded-xl border border-blue-100 dark:border-blue-800/50 flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-neutral-700 dark:text-neutral-300">{{ $apunte->titulo }}</p>
                                        <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ $apunte->materia->nombre }}</p>
                                    </div>
                                    <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-xs bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 px-2 py-1 rounded-lg font-semibold border border-blue-100 dark:border-blue-800">
                                        Abrir
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($eventosDelDia['notas'] ?? []) === 0 && count($eventosDelDia['apuntes'] ?? []) === 0)
                    <p class="text-sm text-neutral-400 dark:text-neutral-500">No hay eventos para este día.</p>
                @endif
            </div>
        </div>
    </div>
</div>