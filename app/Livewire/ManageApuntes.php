<?php

namespace App\Livewire;

use App\Models\Apunte;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageApuntes extends Component
{
    use WithFileUploads;

    public string $search = '';
    public bool $confirmingDeletion = false;
    public ?int $apunteIdBeingDeleted = null;

    public function confirmDelete(int $id): void
    {
        $this->apunteIdBeingDeleted = $id;
        $this->confirmingDeletion = true;
    }

    public function deleteApunte(): void
    {
        if (!$this->apunteIdBeingDeleted) return;
        $this->delete($this->apunteIdBeingDeleted);
        $this->confirmingDeletion = false;
        $this->apunteIdBeingDeleted = null;
    }

    public function delete(int $id): void
    {
        $apunte = Apunte::findOrFail($id);
        if ($apunte->user_id !== Auth::id()) {
            session()->flash('error', 'No tienes permiso para eliminar este apunte.');

            return;
        }
        Storage::disk('public')->delete($apunte->ruta_archivo);
        $apunte->delete();
        session()->flash('message', 'Apunte eliminado.');
    }

    public function render(): View
    {
        $materias = Materia::where('user_id', Auth::id())->get();
        $apuntes = Apunte::with(['user', 'materia'])
            ->where('user_id', Auth::id())
            ->where(function ($q) {
                $q->where('titulo', 'like', '%'.$this->search.'%')
                    ->orWhereHas('materia', function ($query) {
                        $query->where('nombre', 'like', '%'.$this->search.'%');
                    });
            })
            ->latest()
            ->get();

        return view('livewire.manage-apuntes', compact('materias', 'apuntes'));
    }
}
