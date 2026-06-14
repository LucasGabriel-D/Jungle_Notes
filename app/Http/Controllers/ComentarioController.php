<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Comentario::with('user', 'apunte')->latest()->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'apunte_id' => 'required|exists:apuntes,id',
            'contenido' => 'required|min:3|max:500',
        ]);

        $comentario = Comentario::create([
            'user_id' => $request->user()->id,
            'apunte_id' => $validated['apunte_id'],
            'contenido' => $validated['contenido'],
        ]);

        return response()->json($comentario->load('user'), 201);
    }

    public function destroy(Comentario $comentario): JsonResponse
    {
        $comentario->delete();

        return response()->json(null, 204);
    }
}
