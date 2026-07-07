<?php

namespace App\Livewire;

use App\Models\Evento;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class Calendario extends Component
{
    public ?int $eventoId = null;

    public string $titulo = '';

    public string $fechaInicio = '';

    public string $fechaFin = '';

    public string $tipo = 'examen';

    public string $color = '#10b981';

    public bool $mostrarModal = false;

    public bool $confirmando = false;

    public bool $editando = false;

    /** @var array<string, string> */
    protected array $rules = [
        'titulo' => 'required|min:2',
        'fechaInicio' => 'required',
        'tipo' => 'required|in:examen,presentacion,otro',
        'color' => 'nullable',
    ];

    /** @var array<string, string> */
    protected array $messages = [
        'titulo.required' => 'El título es obligatorio.',
        'fechaInicio.required' => 'La fecha es obligatoria.',
    ];

    public function abrirModal(?string $fecha = null): void
    {
        $this->reset(['eventoId', 'titulo', 'fechaFin', 'editando', 'confirmando']);
        $parsed = $fecha ? \Carbon\Carbon::parse($fecha) : now();
        $this->fechaInicio = $parsed->format('Y-m-d\TH:i');
        $this->tipo = 'examen';
        $this->color = '#10b981';
        $this->mostrarModal = true;
    }

    public function abrirEditar(int $id): void
    {
        $evento = Evento::findOrFail($id);
        $this->eventoId = $evento->id;
        $this->titulo = $evento->titulo;
        $this->fechaInicio = $evento->fecha_inicio->format('Y-m-d\TH:i');
        $this->fechaFin = $evento->fecha_fin?->format('Y-m-d\TH:i') ?? '';
        $this->tipo = $evento->tipo;
        $this->color = $evento->color ?? '#10b981';
        $this->editando = true;
        $this->mostrarModal = true;
    }

    public function guardar(): void
    {
        $this->validate();

        $data = [
            'user_id' => Auth::id(),
            'titulo' => $this->titulo,
            'fecha_inicio' => $this->fechaInicio,
            'fecha_fin' => $this->fechaFin ?: null,
            'tipo' => $this->tipo,
            'color' => $this->color,
        ];

        if ($this->editando && $this->eventoId) {
            /** @var Evento $evento */
            $evento = Evento::findOrFail($this->eventoId);
            if ($evento->user_id === Auth::id()) {
                $evento->update($data);
            }
        } else {
            Evento::create($data);
        }

        $this->mostrarModal = false;
        session()->flash('message', $this->editando ? 'Evento actualizado.' : 'Evento creado.');
        $this->dispatch('eventosActualizados');
    }

    public function eliminar(): void
    {
        if ($this->eventoId === null) {
            return;
        }
        $evento = Evento::findOrFail($this->eventoId);
        if ($evento->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar este evento.');

            return;
        }
        $evento->delete();
        $this->mostrarModal = false;
        $this->reset(['eventoId', 'titulo', 'fechaInicio', 'fechaFin', 'editando', 'confirmando']);
        session()->flash('message', 'Evento eliminado.');
        $this->dispatch('eventosActualizados');
    }

    /** @return array<int, array<string, mixed>> */
    private function getFeriados(): array
    {
        /** @var array<int, array<string, string>> $feriados */
        $feriados = config('feriados.'.date('Y'), []);

        return array_map(fn ($f) => [
            'title' => $f['title'],
            'start' => $f['date'],
            'color' => 'transparent',
            'textColor' => $f['color'],
            'className' => 'feriado-event',
            'extendedProps' => ['tipo' => 'feriado'],
        ], $feriados);
    }

    /** @return array<int, array<string, mixed>> */
    public function getEventos(): array
    {
        $eventos = Evento::where('user_id', Auth::id())
            ->get()
            ->flatMap(function ($e) {
                $evs = [];
                $isAllDay = $e->fecha_inicio->format('H:i:s') === '00:00:00' && 
                           (!$e->fecha_fin || $e->fecha_fin->format('H:i:s') === '00:00:00');
                
                $spansDays = $e->fecha_fin && $e->fecha_fin->format('Y-m-d') !== $e->fecha_inicio->format('Y-m-d');

                // Evento Principal / Inicio
                $evs[] = [
                    'id' => $e->id,
                    'title' => $spansDays ? $e->titulo . ' (Inicio)' : $e->titulo,
                    'start' => $isAllDay ? $e->fecha_inicio->format('Y-m-d') : $e->fecha_inicio->format('Y-m-d\TH:i:s'),
                    'end' => (!$spansDays && $e->fecha_fin && !$isAllDay) ? $e->fecha_fin->format('Y-m-d\TH:i:s') : null,
                    'allDay' => $isAllDay,
                    'color' => $e->color ?? '#10b981',
                    'extendedProps' => ['tipo' => $e->tipo, 'originalId' => $e->id],
                ];
                
                // Evento de Fin (si abarca varios días)
                if ($spansDays) {
                    $evs[] = [
                        'id' => $e->id . '_fin',
                        'title' => $e->titulo . ' (Fin)',
                        'start' => $isAllDay ? \Carbon\Carbon::parse($e->fecha_fin)->addDay()->format('Y-m-d') : $e->fecha_fin->format('Y-m-d\TH:i:s'),
                        'allDay' => $isAllDay,
                        'color' => $e->color ?? '#10b981',
                        'extendedProps' => ['tipo' => $e->tipo, 'originalId' => $e->id],
                    ];
                }
                
                return $evs;
            })
            ->toArray();

        return array_merge($eventos, $this->getFeriados());
    }

    public function render(): View
    {
        return view('livewire.calendario');
    }
}
