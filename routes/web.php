<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MateriaController;
use App\Livewire\Calendario;
use App\Livewire\ManageApuntes;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// --- DATOS DEL EQUIPO ICEBERG ---
if (!function_exists('obtenerEquipoIceberg')) {
    function obtenerEquipoIceberg() {
        return [
            'emanuel' => [
                'nombre' => 'Cardozo  B. Emanuel',
                'iniciales' => 'EC',
                'github' => 'https://github.com/cardozoemanuel456-glitch',
                'email' => 'cardozoemanuel456@gmail.com',
                'instagram' => 'https://instagram.com/romeo_.prince'
            ],
            'mauricio' => [
                'nombre' => 'Cardozo Mauricio',
                'iniciales' => 'MC',
                'github' => 'https://github.com/Mauricio-Cardozo',
                'email' => 'mauricionair2004@gmail.com',
                'instagram' => 'https://instagram.com/mauricio'
            ],
            'lucas' => [
                'nombre' => 'Antonelli Lucas',
                'iniciales' => 'LA',
                'github' => 'https://github.com/LucasGabriel-D',
                'email' => 'antonellilucas0609@gmail.com',
                'instagram' => 'https://instagram.com/lucasgabriel_an'
            ],
            'santiago' => [
                'nombre' => 'Benitez Santiago',
                'iniciales' => 'SB',
                'github' => 'https://github.com/SantuBntz',
                'email' => 'santiago789564@gmail.com',
                'instagram' => 'https://instagram.com/santi.b3'
            ]
        ];
    }
}
// --------------------------------

Route::get('/', function () {
    $theme = config('app.landing_theme', 'morado');

    return view($theme === 'verde' ? 'inicioverde' : 'iniciomorado');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // --- RUTAS DEL EQUIPO (Reemplaza a la vista estática) ---
    Route::prefix('equipo')->group(function () {
        Route::get('/', function () {
            $equipo = obtenerEquipoIceberg();
            return view('equipo', compact('equipo'));
        })->name('equipo.index');

        Route::get('/{slug}', function ($slug) {
            $equipo = obtenerEquipoIceberg();
            if (!array_key_exists($slug, $equipo)) {
                abort(404);
            }
            $miembro = $equipo[$slug];
            return view('equipo-perfil', compact('miembro'));
        })->name('equipo.show');
    });
    // --------------------------------------------------------

    Route::resource('materias', MateriaController::class);
    Route::get('/apuntes', ManageApuntes::class)->name('apuntes.index');
    Route::post('/apuntes/upload', [\App\Http\Controllers\WebApunteController::class, 'store'])->name('apuntes.upload');
    Route::get('/calendario', Calendario::class)->name('calendario');

    Route::get('/calendario/eventos', function () {
        $eventos = Evento::where('user_id', Auth::id())
            ->get()
            ->map(fn ($e) => [
                'id' => $e->id,
                'title' => $e->titulo,
                'start' => $e->fecha_inicio->format('Y-m-d'),
                'end' => $e->fecha_fin ? \Carbon\Carbon::parse($e->fecha_fin)->addDay()->format('Y-m-d') : null,
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