<?php

namespace App\Livewire;

use App\Models\Nota;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class BlocNotas extends Component
{
    public string $contenido = '';

    public string $fechaSeleccionada;

    public int $mesActual;

    public int $anioActual;

    public function mount(): void
    {
        $this->fechaSeleccionada = now()->toDateString();
        $this->mesActual = now()->month;
        $this->anioActual = now()->year;
    }

    public function seleccionarFecha(string $fecha): void
    {
        $this->fechaSeleccionada = $fecha;
        $this->contenido = '';
    }

    public function mesAnterior(): void
    {
        if ($this->mesActual === 1) {
            $this->mesActual = 12;
            $this->anioActual--;
        } else {
            $this->mesActual--;
        }
    }

    public function mesSiguiente(): void
    {
        if ($this->mesActual === 12) {
            $this->mesActual = 1;
            $this->anioActual++;
        } else {
            $this->mesActual++;
        }
    }

    public function guardarNota(): void
    {
        $this->validate([
            'contenido' => 'required|min:1|max:1000',
        ]);

        Nota::create([
            'user_id' => Auth::id(),
            'contenido' => $this->contenido,
            'fecha' => $this->fechaSeleccionada,
        ]);

        $this->contenido = '';
        session()->flash('message', 'Nota guardada.');
    }

    public function eliminarNota(int $id): void
    {
        $nota = Nota::findOrFail($id);
        if ($nota->user_id === Auth::id()) {
            $nota->delete();
        }
    }

    public function render(): View
    {
        $notasDelDia = Nota::where('user_id', Auth::id())
            ->whereDate('fecha', $this->fechaSeleccionada)
            ->latest()
            ->get();

        $diasConNotas = Nota::where('user_id', Auth::id())
            ->whereYear('fecha', $this->anioActual)
            ->whereMonth('fecha', $this->mesActual)
            ->pluck('fecha')
            ->map(fn ($f) => $f->format('Y-m-d'))
            ->unique()
            ->toArray();

        return view('livewire.bloc-notas', compact('notasDelDia', 'diasConNotas'));
    }
}
