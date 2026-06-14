<?php

namespace App\Livewire;

use App\Models\Apunte;
use App\Models\Materia;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ManageApuntes extends Component
{
    use WithFileUploads;

    public string $titulo = '';
    public ?string $descripcion = null;
    public string $materia_id = '';
    public $archivo;
    public string $search = '';

    protected $rules = [
        'titulo' => 'required|min:3',
        'descripcion' => 'nullable',
        'materia_id' => 'required|exists:materias,id',
        'archivo' => 'required|file|mimes:pdf,doc,docx|max:10240',
    ];

    protected $messages = [
        'titulo.required' => 'El título es obligatorio.',
        'materia_id.required' => 'Debes seleccionar una materia.',
        'archivo.required' => 'El archivo es obligatorio.',
        'archivo.mimes' => 'Solo se permiten archivos PDF o Word.',
        'archivo.max' => 'El archivo no puede superar los 10MB.',
    ];

    public function store(): void
    {
        $this->validate();

        $nombreArchivo = time() . '_' . $this->archivo->getClientOriginalName();
        $ruta = $this->archivo->storeAs("apuntes/materia_" . $this->materia_id, $nombreArchivo, 'public');

        Apunte::create([
            'user_id' => Auth::id(),
            'materia_id' => $this->materia_id,
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
            'ruta_archivo' => $ruta,
        ]);

        $this->reset(['titulo', 'descripcion', 'materia_id', 'archivo']);
        session()->flash('message', 'Apunte subido correctamente.');
    }

    public function delete(int $id): void
    {
        $apunte = Apunte::findOrFail($id);
        if ($apunte->user_id === Auth::id()) {
            Storage::disk('public')->delete($apunte->ruta_archivo);
            $apunte->delete();
            session()->flash('message', 'Apunte eliminado.');
        }
    }

    public function render(): \Illuminate\View\View
    {
        $materias = Materia::all();
        $apuntes = Apunte::with(['user', 'materia'])
            ->where(function ($q) {
                $q->where('titulo', 'like', '%' . $this->search . '%')
                  ->orWhereHas('materia', function ($query) {
                      $query->where('nombre', 'like', '%' . $this->search . '%');
                  });
            })
            ->latest()
            ->get();

        return view('livewire.manage-apuntes', compact('materias', 'apuntes'));
    }
}
