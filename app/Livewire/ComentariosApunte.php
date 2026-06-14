<?php

namespace App\Livewire;

use App\Models\Comentario;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class ComentariosApunte extends Component
{
    public int $apunte_id;

    public string $contenido = '';

    /** @var array<string, string> */
    protected array $rules = [
        'contenido' => 'required|min:3|max:500',
    ];

    /** @var array<string, string> */
    protected array $messages = [
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

    public function render(): View
    {
        $comentarios = Comentario::with('user')
            ->where('apunte_id', $this->apunte_id)
            ->latest()
            ->get();

        return view('livewire.comentarios-apunte', compact('comentarios'));
    }
}
