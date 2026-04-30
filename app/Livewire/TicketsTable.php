<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class TicketsTable extends Component
{
    use WithPagination;

    public $search = '';
    public $estado = '';
    public $prioridad = '';

    public function render()
    {
        $tickets = Ticket::query()
            ->when($this->search, fn ($q) =>
            $q->where('titulo', 'like', '%' . $this->search . '%')
            )
            ->when($this->estado, fn ($q) =>
            $q->where('estado', $this->estado)
            )
            ->when($this->prioridad, fn ($q) =>
            $q->where('prioridad', $this->prioridad)
            )
            ->with(['user', 'tecnico'])
            ->latest()
            ->paginate(10);

        return view('livewire.tickets-table', compact('tickets'));
    }
}
