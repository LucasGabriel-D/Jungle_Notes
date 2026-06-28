<x-layouts::app :title="'Panel General'">
    <div class="flex flex-col gap-6 p-6 text-neutral-800 antialiased">

        <!-- Stats Tabs + Nuevo Apunte -->
        <div class="flex items-center justify-between border border-neutral-200 bg-white p-1 rounded-xl shadow-sm">
            <div class="flex overflow-x-auto">
                <div class="flex items-center space-x-2 px-4 py-2 text-sm font-semibold text-emerald-700 bg-emerald-50 rounded-lg shrink-0">
                    <span>Comunidad:</span>
                    <span class="bg-emerald-600 text-white px-2 py-0.5 text-xs rounded-full">{{ $totalApuntes }}</span>
                </div>
                <div class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-neutral-600 shrink-0">
                    <span>Materias Activas:</span>
                    <span class="bg-neutral-100 text-neutral-700 px-2 py-0.5 text-xs rounded-full">{{ $totalMaterias }}</span>
                </div>
                <div class="flex items-center space-x-2 px-4 py-2 text-sm font-medium text-neutral-600 shrink-0">
                    <span>Mis Aportes:</span>
                    <span class="bg-neutral-100 text-neutral-700 px-2 py-0.5 text-xs rounded-full">{{ $misApuntes }}</span>
                </div>
            </div>
            <a href="{{ route('apuntes.index') }}" class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all duration-150 mr-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Apunte
            </a>
        </div>

        <!-- Cards en cascada -->
        <div class="flex flex-col gap-6">
            
            <!-- Tarjeta: Últimos Apuntes -->
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-neutral-900 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                        Últimos Apuntes Recientes
                    </h3>
                    <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">Global</span>
                </div>
                
                <div class="divide-y divide-neutral-100">
                    @forelse($ultimosApuntes as $apunte)
                        <div class="flex items-center justify-between py-3.5 last:pb-0 group">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-emerald-50 text-emerald-700 rounded-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-sm text-neutral-900">{{ $apunte->titulo }}</h4>
                                    <p class="text-xs text-neutral-500">{{ $apunte->materia->nombre }} — {{ $apunte->user->name }}</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-xs bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white px-3 py-2 rounded-lg font-semibold transition-all duration-150 shadow-sm border border-emerald-100 flex items-center gap-1">
                                Abrir
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <p class="text-sm text-neutral-500 py-4">No hay apuntes cargados.</p>
                    @endforelse
                </div>
            </div>

            <!-- Tarjeta: Comentarios -->
            <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm">
                <div>
                    <h3 class="text-lg font-bold text-neutral-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Mi Actividad
                    </h3>
                    <div class="space-y-4">
                        @forelse($misComentarios as $comentario)
                            <div class="p-3.5 bg-emerald-50/40 rounded-xl border border-emerald-100/70">
                                <p class="text-xs italic text-neutral-700">"{{ $comentario->contenido }}"</p>
                                <span class="block text-[10px] text-emerald-600 mt-2 font-semibold uppercase tracking-wider">Doc: {{ $comentario->apunte->titulo }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-neutral-500 py-4">Sin comentarios recientes.</p>
                        @endforelse
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-neutral-100 text-center">
                    <span class="text-xs text-neutral-400 font-medium">JungleNotes — UTN FRRE</span>
                </div>
            </div>

        </div>
    </div>
</x-layouts::app>