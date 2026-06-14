<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use App\Models\Materia;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApuntes = Apunte::count();
        $totalMaterias = Materia::count();
        $misApuntes = Apunte::where('user_id', Auth::id())->count();

        $ultimosApuntes = Apunte::with(['user', 'materia'])->latest()->take(3)->get();
        $misComentarios = Comentario::with('apunte')->where('user_id', Auth::id())->latest()->take(5)->get();

        return view('dashboard', compact('totalApuntes', 'totalMaterias', 'misApuntes', 'ultimosApuntes', 'misComentarios'));
    }
}
