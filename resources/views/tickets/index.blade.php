<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800">
                Tickets
            </h2>

            <a href="{{ route('tickets.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold">
                + Crear Ticket
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow p-6 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b text-gray-500">
                            <th class="py-3">ID</th>
                            <th class="py-3">Solicitante</th>
                            <th class="py-3">Departamento</th>
                            <th class="py-3">Asunto</th>
                            <th class="py-3">Categoría</th>
                            <th class="py-3">Prioridad</th>
                            <th class="py-3">Estado</th>
                            <th class="py-3">Fecha</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4 font-semibold">#{{ $ticket->id }}</td>
                                <td class="py-4">{{ $ticket->user->name ?? 'Sin usuario' }}</td>
                                <td class="py-4">{{ $ticket->departamento ?? '-' }}</td>
                                <td class="py-4 font-semibold text-gray-800">{{ $ticket->titulo }}</td>
                                <td class="py-4">{{ $ticket->categoria }}</td>
                                <td class="py-4">{{ $ticket->prioridad }}</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                                        {{ $ticket->estado }}
                                    </span>
                                </td>
                                <td class="py-4">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-8 text-center text-gray-500">
                                    No hay tickets registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-5">
                    {{ $tickets->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>