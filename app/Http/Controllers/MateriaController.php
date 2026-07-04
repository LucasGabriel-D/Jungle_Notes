<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MateriaController extends Controller
{
    public function index(): View
    {
        $materias = Materia::withCount('apuntes')->get();

        return view('materias.index', compact('materias'));
    }

    public function create(): View
    {
        return view('materias.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:materias',
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        Materia::create($validated);

        return redirect()->route('materias.index')->with('message', 'Materia creada correctamente.');
    }

    public function show(Materia $materia): View
    {
        $materia->load(['apuntes' => function ($q) {
            $q->with('user')->latest();
        }]);

        return view('materias.show', compact('materia'));
    }

    public function edit(Materia $materia): View
    {
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:materias,nombre,'.$materia->id,
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        $materia->update($validated);

        return redirect()->route('materias.index')->with('message', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia): RedirectResponse
    {
        $materia->delete();

        return redirect()->route('materias.index')->with('message', 'Materia eliminada correctamente.');
    }
}
