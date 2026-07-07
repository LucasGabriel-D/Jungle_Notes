<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MateriaController extends Controller
{
    public function index(): View
    {
        $materias = Materia::withCount('apuntes')
            ->where('user_id', Auth::id())
            ->get();

        return view('materias.index', compact('materias'));
    }

    public function create(): View
    {
        return view('materias.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:materias,nombre,NULL,id,user_id,'.Auth::id(),
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        $validated['user_id'] = Auth::id();
        Materia::create($validated);

        return redirect()->route('materias.index')->with('message', 'Materia creada correctamente.');
    }

    public function show(Materia $materia): View
    {
        abort_if($materia->user_id !== Auth::id(), 403);

        $materia->load(['apuntes' => function ($q) {
            $q->with('user')->latest();
        }]);

        return view('materias.show', compact('materia'));
    }

    public function edit(Materia $materia): View
    {
        abort_if($materia->user_id !== Auth::id(), 403);

        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, Materia $materia): RedirectResponse
    {
        abort_if($materia->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'nombre' => 'required|unique:materias,nombre,'.$materia->id.',id,user_id,'.Auth::id(),
            'descripcion' => 'nullable',
            'anio' => 'required|integer|min:1|max:5',
        ]);

        $materia->update($validated);

        return redirect()->route('materias.index')->with('message', 'Materia actualizada correctamente.');
    }

    public function destroy(Materia $materia): RedirectResponse
    {
        abort_if($materia->user_id !== Auth::id(), 403);

        $materia->delete();

        return redirect()->route('materias.index')->with('message', 'Materia eliminada correctamente.');
    }
}