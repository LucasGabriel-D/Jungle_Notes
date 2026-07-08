<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::redirect('configuracion', 'configuracion/perfil');

    Route::livewire('configuracion/perfil', 'pages::settings.profile')->name('profile.edit');
    Route::livewire('configuracion/seguridad', 'pages::settings.security')->name('security.edit');
});