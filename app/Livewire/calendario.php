<?php

namespace App\Livewire;

use App\Models\Nota;
use App\Models\Apunte;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Calendario extends Component
{
    public int $mesActual;
    public int $anioActual;
    public string $fechaSeleccionada = '';

    public function mount(): void
    {
        $this->mesActual = now()->month;
        $this->anioActual = now()->year;
        $this->fechaSeleccionada = now()->toDateString();
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

    public function seleccionarFecha(string $fecha): void
    {
        $this->fechaSeleccionada = $fecha;
    }

    public function render(): View
    {
        $notas = Nota::where('user_id', Auth::id())
            ->whereYear('fecha', $this->anioActual)
            ->whereMonth('fecha', $this->mesActual)
            ->get()
            ->groupBy(fn($n) => $n->fecha->format('Y-m-d'));

        $apuntes = Apunte::with('materia')
            ->where('user_id', Auth::id())
            ->whereYear('created_at', $this->anioActual)
            ->whereMonth('created_at', $this->mesActual)
            ->get()
            ->groupBy(fn($a) => $a->created_at->format('Y-m-d'));

        $eventosDelDia = [
            'notas' => Nota::where('user_id', Auth::id())
                ->where('fecha', $this->fechaSeleccionada)
                ->latest()
                ->get(),
            'apuntes' => Apunte::with('materia')
                ->where('user_id', Auth::id())
                ->whereDate('created_at', $this->fechaSeleccionada)
                ->latest()
                ->get(),
        ];

        return view('livewire.calendario', compact('notas', 'apuntes', 'eventosDelDia'));
    }
}