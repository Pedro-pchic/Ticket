<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $pendientes = Ticket::where('estado', 'Pendiente')->count();

        $urgentes = Ticket::where('prioridad', 'Urgente')->count();

        $misTickets = Ticket::where('user_id', Auth::id())->count();

        $ultimosTickets = Ticket::with('user')
            ->latest()
            ->take(5)
            ->get();

        $tecnicosActivos = User::count();

        $ticketsPorMes = Ticket::select(
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'mes');

        $meses = [];
        $totales = [];

        for ($i = 1; $i <= 12; $i++) {
            $meses[] = date('M', mktime(0, 0, 0, $i, 1));
            $totales[] = $ticketsPorMes[$i] ?? 0;
        }

        return view('dashboard', compact(
            'pendientes',
            'urgentes',
            'misTickets',
            'ultimosTickets',
            'tecnicosActivos',
            'meses',
            'totales'
        ));
    }
}