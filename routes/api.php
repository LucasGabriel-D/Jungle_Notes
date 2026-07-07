<?php

use App\Http\Controllers\ApunteController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/apuntes', [ApunteController::class, 'index']);
Route::post('/apuntes', [ApunteController::class, 'store']);

Route::get('/calendario/eventos', function () {
    /** @var User|null $user */
    $user = auth('api')->user() ?? auth()->user();
    if (! $user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $eventos = \App\Models\Evento::where('user_id', $user->id)
        ->get()
        ->map(fn ($e) => [
            'id' => $e->id,
            'title' => $e->titulo,
            'start' => $e->fecha_inicio->toIso8601String(),
            'end' => $e->fecha_fin?->toIso8601String(),
            'color' => $e->color ?? '#10b981',
            'extendedProps' => ['tipo' => $e->tipo],
        ]);

    /** @var array<int, array<string, string>> $feriadosConfig */
    $feriadosConfig = config('feriados.'.date('Y'), []);

    $feriados = collect($feriadosConfig)
        ->map(fn ($f) => [
            'title' => $f['title'],
            'start' => $f['date'],
            'color' => $f['color'],
            'display' => 'background',
            'extendedProps' => ['tipo' => 'feriado'],
        ]);

    return $eventos->merge($feriados)->values()->toJson();
})->middleware('auth');
