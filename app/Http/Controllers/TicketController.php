<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['user', 'tecnico'])
            ->when(Auth::user()->hasRole('usuario'), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->when(Auth::user()->hasRole('tecnico'), function ($query) {
                $query->where('tecnico_id', Auth::id());
            })
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'departamento' => ['required', 'string', 'max:100'],
            'ubicacion' => ['nullable', 'string', 'max:150'],
            'extension' => ['nullable', 'string', 'max:20'],
            'equipo_afectado' => ['nullable', 'string', 'max:150'],
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'min:10'],
            'categoria' => ['required', 'string', 'max:100'],
            'prioridad' => ['required', 'in:Baja,Media,Alta,Urgente'],
            'adjunto' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ]);

        $adjuntoPath = null;

        if ($request->hasFile('adjunto')) {
            $adjuntoPath = $request->file('adjunto')->store('tickets', 'public');
        }

        $tecnico = null;

        switch ($request->categoria) {
            case 'Internet':
            case 'Impresora':
            case 'Correo':
            case 'Sistema interno':
            case 'Mantenimiento':
            case 'Soporte técnico':
                $tecnico = User::role('tecnico')->inRandomOrder()->first();
                break;
        }

        Ticket::create([
            'user_id' => Auth::id(),
            'tecnico_id' => $tecnico?->id,
            'departamento' => $request->departamento,
            'ubicacion' => $request->ubicacion,
            'extension' => $request->extension,
            'equipo_afectado' => $request->equipo_afectado,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'prioridad' => $request->prioridad,
            'estado' => $tecnico ? 'Asignado' : 'Pendiente',
            'adjunto' => $adjuntoPath,
        ]);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Ticket creado correctamente.');
    }
}