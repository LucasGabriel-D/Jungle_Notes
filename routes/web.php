<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Livewire\ManageApuntes;
use App\Livewire\BlocNotas;
use App\Livewire\Calendario;
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
    Route::get('/bloc-notas', BlocNotas::class)->name('bloc-notas.index');
    Route::resource('comentarios', ComentarioController::class);

    // MOVIDA AQUÍ DENTRO DEL GRUPO AUTH
    Route::get('/calendario', Calendario::class)->name('calendario.index');
});

require __DIR__.'/settings.php';