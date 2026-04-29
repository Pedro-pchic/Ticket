<div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <input
            type="text"
            wire:model.live="search"
            placeholder="Buscar ticket..."
            class="rounded-lg border-gray-300 text-sm"
        >

        <select wire:model.live="estado" class="rounded-lg border-gray-300 text-sm">
            <option value="">Todos los estados</option>
            <option value="Pendiente">Pendiente</option>
            <option value="Asignado">Asignado</option>
            <option value="En proceso">En proceso</option>
            <option value="Resuelto">Resuelto</option>
            <option value="Cerrado">Cerrado</option>
        </select>

        <select wire:model.live="prioridad" class="rounded-lg border-gray-300 text-sm">
            <option value="">Todas las prioridades</option>
            <option value="Baja">Baja</option>
            <option value="Media">Media</option>
            <option value="Alta">Alta</option>
            <option value="Urgente">Urgente</option>
        </select>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b text-gray-500">
                    <th class="p-4">ID</th>
                    <th class="p-4">Solicitante</th>
                    <th class="p-4">Técnico</th>
                    <th class="p-4">Asunto</th>
                    <th class="p-4">Prioridad</th>
                    <th class="p-4">Estado</th>
                    <th class="p-4">Fecha</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tickets as $ticket)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4 font-semibold">#{{ $ticket->id }}</td>
                        <td class="p-4">{{ $ticket->user->name ?? 'Sin usuario' }}</td>
                        <td class="p-4">{{ $ticket->tecnico->name ?? 'Sin asignar' }}</td>
                        <td class="p-4">{{ $ticket->titulo }}</td>
                        <td class="p-4">{{ $ticket->prioridad }}</td>
                        <td class="p-4">{{ $ticket->estado }}</td>
                        <td class="p-4">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            No hay tickets registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $tickets->links() }}
</div>