<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')
            ->where('user_id', Auth::id())
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
        $tecnico = null;

if ($request->categoria === 'Internet') {
    $tecnico = User::role('tecnico')->first();
}

if ($request->categoria === 'Impresora') {
    $tecnico = User::role('tecnico')->first();
}

if ($request->categoria === 'Sistema interno') {
    $tecnico = User::role('tecnico')->first();
}
        

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