<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Mesa de Ayuda TI
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Control y seguimiento de solicitudes del Departamento de Informática
                </p>
            </div>

            <a href="{{ route('tickets.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow text-sm font-semibold">
                + Crear Ticket
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Bienvenida --}}
            <div class="bg-gradient-to-r from-indigo-800 via-blue-700 to-cyan-600 rounded-2xl shadow-xl p-8 text-white">
                <h1 class="text-4xl font-extrabold drop-shadow">
                    Bienvenido, {{ Auth::user()->name }}
                </h1>
                <p class="mt-3 text-blue-100 text-lg">
                    Aquí puedes gestionar tickets, dar seguimiento a casos y controlar solicitudes de soporte técnico.
                </p>
            </div>

            {{-- Estadísticas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-yellow-400">
                    <p class="text-sm text-gray-500">Tickets pendientes</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $pendientes }}</h3>
                    <p class="text-xs text-gray-400 mt-2">Solicitudes nuevas</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-red-500">
                    <p class="text-sm text-gray-500">Urgentes</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $urgentes }}</h3>
                    <p class="text-xs text-gray-400 mt-2">Prioridad urgente</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-indigo-500">
                    <p class="text-sm text-gray-500">Mis tickets</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $misTickets }}</h3>
                    <p class="text-xs text-gray-400 mt-2">Creados por mí</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border-l-4 border-green-500">
                    <p class="text-sm text-gray-500">Técnicos activos</p>
                    <h3 class="text-4xl font-bold text-gray-800 mt-2">{{ $tecnicosActivos }}</h3>
                    <p class="text-xs text-gray-400 mt-2">Usuarios registrados</p>
                </div>
            </div>

            {{-- Gráfica --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-5">
                    📈 Tickets por mes
                </h3>

                <canvas id="ticketsChart" height="90"></canvas>
            </div>

            {{-- Tickets recientes + Acciones --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-xl font-bold text-gray-800">
                            🕒 Últimos tickets
                        </h3>

                        <a href="{{ route('tickets.index') }}"
                           class="text-sm text-indigo-600 hover:text-indigo-800 font-semibold">
                            Ver todos
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b text-gray-500">
                                    <th class="py-3">Ticket</th>
                                    <th class="py-3">Categoría</th>
                                    <th class="py-3">Prioridad</th>
                                    <th class="py-3">Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($ultimosTickets as $ticket)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-4 font-semibold text-gray-800">
                                            #{{ $ticket->id }} - {{ $ticket->titulo }}
                                        </td>
                                        <td class="py-4 text-gray-500">
                                            {{ $ticket->categoria }}
                                        </td>
                                        <td class="py-4 text-gray-500">
                                            {{ $ticket->prioridad }}
                                        </td>
                                        <td class="py-4">
                                            <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                                {{ $ticket->estado }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 text-center text-gray-500">
                                            Sin tickets registrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Acciones rápidas --}}
                <div class="bg-white rounded-2xl shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-5">
                        Acciones rápidas
                    </h3>

                    <div class="grid grid-cols-1 gap-4">
                        <a href="{{ route('tickets.create') }}"
                           class="flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-xl font-semibold transition shadow-sm">
                            + Crear Ticket
                        </a>

                        <a href="{{ route('tickets.index') }}"
                           class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-4 rounded-xl font-semibold transition">
                            Ver Tickets
                        </a>

                        <a href="{{ route('profile.edit') }}"
                           class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-800 py-4 rounded-xl font-semibold transition">
                            Mi Perfil
                        </a>
                    </div>

                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-100">
                        <p class="font-semibold text-blue-700">
                            Consejo TI
                        </p>

                        <p class="text-sm text-blue-600 mt-1 leading-relaxed">
                            Registra cada solicitud para llevar control, tiempos de respuesta e historial técnico institucional.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('ticketsChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($meses),
                datasets: [{
                    label: 'Tickets creados',
                    data: @json($totales),
                    tension: 0.4
                }]
            }
        });
    </script>
</x-app-layout>