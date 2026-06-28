<x-layouts::app :title="__('Dashboard')">
    <!-- Contenedor General con el estado de Alpine.js para abrir/cerrar el menú -->
    <div x-data="{ sidebarOpen: false }" class="relative flex h-full w-full flex-1 flex-col gap-6 text-neutral-800 antialiased bg-neutral-50/50">
        
        <!-- ==================== TOP BAR & HEADER ==================== -->
        <div class="flex items-center justify-between border-b border-neutral-500 bg-white px-4 py-3 rounded-xl shadow-sm">
            <div class="flex items-center space-x-3">
                <!-- Botón Hamburguesa (Visible en móviles/tablets) -->
                <button @click="sidebarOpen = !sidebarOpen" class="rounded-lg p-2 text-neutral-600 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none lg:hidden transition duration-150">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-neutral-900 flex items-center gap-2">
                        <span class="text-emerald-600">🌿</span> JungleNotes
                    </h1>
                </div>
            </div>

            <!-- Botón Acción Rápida -->
            <button class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition duration-150 flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nuevo Apunte
            </button>
        </div>

        <div class="flex flex-1 gap-6">
            <!-- ==================== SIDEBAR LATERAL DESPLEGABLE ==================== -->
            <!-- Fondo oscuro difuminado detrás del menú (Solo se muestra en móvil cuando está abierto) -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false" 
                 class="fixed inset-0 z-40 bg-neutral-900/40 backdrop-blur-xs lg:hidden" 
                 style="display: none;">
            </div>

            <!-- Contenedor del Menú Lateral -->
            <aside x-show="sidebarOpen || window.innerWidth >= 1024"
                   :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                   class="fixed bottom-0 top-0 left-0 z-50 w-64 transform bg-white p-5 border-r border-neutral-200 transition-transform duration-200 ease-in-out lg:static lg:block lg:translate-x-0 lg:rounded-xl lg:border shadow-sm"
                   style="display: none;">
                
                <!-- Cabecera para cerrar en móvil -->
                <div class="flex items-center justify-between mb-6 lg:hidden">
                    <span class="font-bold text-emerald-800">Menú</span>
                    <button @click="sidebarOpen = false" class="text-neutral-500 hover:text-neutral-800 p-1 rounded-lg hover:bg-neutral-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Enlaces del Menú con Iconos Vectoriales -->
                <nav class="space-y-1.5">
                    <!-- Panel General -->
                    <a href="#" class="flex items-center space-x-3 rounded-lg bg-emerald-50 px-4 py-2.5 text-sm font-semibold text-emerald-700">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path>
                        </svg>
                        <span>Panel General</span>
                    </a>

                    <!-- Mis Materias -->
                    <a href="#" class="flex items-center space-x-3 rounded-lg px-4 py-2.5 text-sm font-medium text-neutral-600 hover:bg-emerald-50/50 hover:text-emerald-700 transition duration-150 group">
                        <svg class="w-5 h-5 text-neutral-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <span>Mis Materias</span>
                    </a>

                    <!-- Bloc de Notas -->
                    <a href="#" class="flex items-center space-x-3 rounded-lg px-4 py-2.5 text-sm font-medium text-neutral-600 hover:bg-emerald-50/50 hover:text-emerald-700 transition duration-150 group">
                        <svg class="w-5 h-5 text-neutral-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span>Bloc de Notas</span>
                    </a>

                    <!-- Calendario Académico -->
                    <a href="#" class="flex items-center space-x-3 rounded-lg px-4 py-2.5 text-sm font-medium text-neutral-600 hover:bg-emerald-50/50 hover:text-emerald-700 transition duration-150 group">
                        <svg class="w-5 h-5 text-neutral-400 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Calendario</span>
                    </a>

                    <hr class="border-neutral-200 my-4">

                    <!-- Integrantes Grupo -->
                    <a href="#" class="flex items-center space-x-3 rounded-lg px-4 py-2.5 text-sm font-medium text-neutral-500 hover:bg-neutral-50 hover:text-neutral-800 transition duration-150 group">
                        <svg class="w-5 h-5 text-neutral-400 group-hover:text-neutral-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span>Equipo Iceberg</span>
                    </a>
                </nav>
            </aside>

            <!-- ==================== CONTENIDO PRINCIPAL CON PESTAÑAS (TABS) ==================== -->
            <div class="flex-1 flex flex-col gap-6">
                
                <!-- Pestañas Superiores de Estado -->
                <div class="flex border border-neutral-200 bg-white p-1 rounded-xl shadow-sm overflow-x-auto">
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

                <!-- Grilla Inferior (Últimos apuntes y comentarios) -->
                <div class="grid gap-6 lg:grid-cols-3">
                    
                    <!-- Tarjeta: Últimos Apuntes -->
                    <div class="lg:col-span-2 rounded-xl border border-neutral-200 bg-white p-6 shadow-sm">
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
                                            <p class="text-xs text-neutral-500">{{ $apunte->materia->nombre }} — Por {{ $apunte->user->name }}</p>
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
                    <div class="rounded-xl border border-neutral-200 bg-white p-6 shadow-sm flex flex-col justify-between">
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
        </div>

    </div>
</x-layouts::app>