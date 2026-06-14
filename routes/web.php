<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ComentarioController;
use App\Livewire\ManageApuntes;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('materias', MateriaController::class);
    Route::get('/apuntes', ManageApuntes::class)->name('apuntes.index');
    Route::resource('comentarios', ComentarioController::class);
});

require __DIR__.'/settings.php';
