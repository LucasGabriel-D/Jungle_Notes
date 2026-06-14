<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(Materia::withCount('apuntes')->get());
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:materias',
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        $materia = Materia::create($validated);

        return response()->json($materia, 201);
    }

    public function show(Materia $materia): \Illuminate\Http\JsonResponse
    {
        return response()->json($materia->load('apuntes'));
    }

    public function update(Request $request, Materia $materia): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:materias,nombre,' . $materia->id,
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        $materia->update($validated);

        return response()->json($materia);
    }

    public function destroy(Materia $materia): \Illuminate\Http\JsonResponse
    {
        $materia->delete();

        return response()->json(null, 204);
    }
}
