<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApunteController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Apunte::with(['user', 'materia'])->latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'titulo' => 'required|min:3',
            'materia_id' => 'required|exists:materias,id',
            'archivo' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $path = $request->file('archivo')->storeAs(
            'apuntes/materia_'.$request->materia_id,
            $request->file('archivo')->hashName(),
            'public'
        );

        $apunte = Apunte::create([
            'user_id' => $request->user()->id,
            'materia_id' => $request->materia_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'ruta_archivo' => $path,
        ]);

        return response()->json($apunte->load(['user', 'materia']), 201);
    }
}
