<?php

use App\Http\Controllers\ApunteController;
use Illuminate\Support\Facades\Route;

Route::get('/apuntes', [ApunteController::class, 'index']);
Route::post('/apuntes', [ApunteController::class, 'store']);
