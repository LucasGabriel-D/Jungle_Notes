<div class="p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Gestionar Apuntes</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg shadow-md mb-8">
        <form wire:submit.prevent="store" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                <input type="text" wire:model="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                @error('titulo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                <textarea wire:model="descripcion" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white"></textarea>
                @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Materia</label>
                <select wire:model="materia_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">
                    <option value="">Seleccione una materia</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                @error('materia_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Archivo (PDF/Word, max 10MB)</label>
                <input type="file" wire:model="archivo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300">
                @error('archivo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition">
                Subir Apunte
            </button>
        </form>
    </div>

    <div class="bg-white dark:bg-neutral-800 p-6 rounded-lg shadow-md">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Buscar apuntes o materia..." class="mb-4 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-700 dark:border-neutral-600 dark:text-white">

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50 dark:bg-neutral-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300">Título</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300">Materia</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300">Autor</th>
                        <th class="px-4 py-2 text-left text-gray-600 dark:text-gray-300">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($apuntes as $apunte)
                        <tr class="border-b dark:border-neutral-600">
                            <td class="px-4 py-2 dark:text-white">{{ $apunte->titulo }}</td>
                            <td class="px-4 py-2 dark:text-gray-300">{{ $apunte->materia->nombre }}</td>
                            <td class="px-4 py-2 dark:text-gray-300">{{ $apunte->user->name }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ asset('storage/' . $apunte->ruta_archivo) }}" target="_blank" class="text-blue-600 hover:underline dark:text-blue-400">Descargar</a>
                                @if($apunte->user_id === auth()->id())
                                    <button wire:click="delete({{ $apunte->id }})" wire:confirm="¿Seguro que deseas eliminar?" class="text-red-600 hover:underline dark:text-red-400">Eliminar</button>
                                @endif

                                <div class="mt-4 border-t pt-2 dark:border-neutral-600">
                                    <livewire:comentarios-apunte :apunte_id="$apunte->id" :key="'comentarios-' . $apunte->id" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
