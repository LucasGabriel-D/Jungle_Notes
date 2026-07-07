<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Livewire\Calendario;
use App\Livewire\ManageApuntes;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $theme = config('app.landing_theme', 'morado');

    return view($theme === 'verde' ? 'inicioverde' : 'iniciomorado');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::view('/equipo', 'equipo')->name('equipo');
    Route::resource('materias', MateriaController::class);
    Route::get('/apuntes', ManageApuntes::class)->name('apuntes.index');
    Route::get('/calendario', Calendario::class)->name('calendario');

    Route::get('/calendario/eventos', function () {
        $eventos = Evento::where('user_id', Auth::id())
            ->get()
            ->map(fn ($e) => [
                'id' => $e->id,
                'title' => $e->titulo,
                'start' => $e->fecha_inicio->format('Y-m-d'),
                'end' => $e->fecha_fin?->format('Y-m-d'),
                'color' => $e->color ?? '#10b981',
                'extendedProps' => ['tipo' => $e->tipo],
            ]);

        /** @var array<int, array{title: string, date: string, color: string}> $feriadosConfig */
        $feriadosConfig = config('feriados.'.date('Y'), []);

        $feriados = collect($feriadosConfig)
            ->map(fn ($f) => [
                'title' => $f['title'],
                'start' => $f['date'],
                'color' => $f['color'],
                'display' => 'background',
                'extendedProps' => ['tipo' => 'feriado'],
            ]);

        return response()->json($eventos->merge($feriados)->values());
    })->name('calendario.eventos');

    Route::resource('comentarios', ComentarioController::class);
});

require __DIR__.'/settings.php';
