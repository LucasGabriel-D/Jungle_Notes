<?php

namespace App\Http\Controllers;

use App\Models\Apunte;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class WebApunteController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        /** @var UploadedFile|null $archivo */
        $archivo = $request->file('archivo');

        if ($archivo && !$archivo->isValid()) {
            dd("Error de PHP al subir: " . $archivo->getErrorMessage());
        }

        $request->validate([
            'titulo' => 'required|min:3',
            'materia_id' => 'required|exists:materias,id',
            'archivo' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'materia_id.required' => 'Debes seleccionar una materia.',
            'archivo.required' => 'El archivo es obligatorio.',
            'archivo.mimes' => 'Solo se permiten archivos PDF o Word.',
            'archivo.max' => 'El archivo no puede superar los 10MB.',
            'archivo.uploaded' => 'El servidor falló al procesar el archivo. El error interno es: ' . ($archivo ? $archivo->getErrorMessage() : 'Desconocido'),
        ]);

        /** @var UploadedFile $archivo */
        $path = $archivo->storeAs(
            'apuntes/materia_'.$request->materia_id,
            $archivo->hashName(),
            'public'
        );

        Apunte::create([
            'user_id' => Auth::id(),
            'materia_id' => $request->materia_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'ruta_archivo' => $path,
        ]);

        return redirect()->route('apuntes.index')->with('message', 'Apunte subido correctamente.');
    }
}