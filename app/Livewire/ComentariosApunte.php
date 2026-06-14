<?php

namespace App\Livewire;

use App\Models\Comentario;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ComentariosApunte extends Component
{
    public int $apunte_id;
    public string $contenido = '';

    protected $rules = [
        'contenido' => 'required|min:3|max:500',
    ];

    protected $messages = [
        'contenido.required' => 'El comentario no puede estar vacío.',
        'contenido.min' => 'El comentario debe tener al menos 3 caracteres.',
        'contenido.max' => 'El comentario no puede superar los 500 caracteres.',
    ];

    public function mount(int $apunte_id): void
    {
        $this->apunte_id = $apunte_id;
    }

    public function store(): void
    {
        $this->validate();

        Comentario::create([
            'user_id' => Auth::id(),
            'apunte_id' => $this->apunte_id,
            'contenido' => $this->contenido,
        ]);

        $this->reset('contenido');
        session()->flash('success', 'Comentario publicado.');
    }

    public function delete(int $id): void
    {
        $comentario = Comentario::findOrFail($id);
        if ($comentario->user_id === Auth::id()) {
            $comentario->delete();
            session()->flash('success', 'Comentario eliminado.');
        }
    }

    public function render(): \Illuminate\View\View
    {
        $comentarios = Comentario::with('user')
            ->where('apunte_id', $this->apunte_id)
            ->latest()
            ->get();

        return view('livewire.comentarios-apunte', compact('comentarios'));
    }
}
