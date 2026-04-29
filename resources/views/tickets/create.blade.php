<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800">
                🎫 Crear Ticket
            </h2>

            <a href="{{ route('tickets.index') }}"
               class="text-sm text-gray-600 hover:text-gray-900">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-lg p-6">

                <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase">
            Ubicación física
        </label>
        <input type="text" name="ubicacion" value="{{ old('ubicacion') }}"
               placeholder="Ej: 2do nivel, oficina cartera"
               class="mt-1 w-full rounded-lg border-gray-300 text-sm">
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase">
            Extensión
        </label>
        <input type="text" name="extension" value="{{ old('extension') }}"
               placeholder="Ej: 102"
               class="mt-1 w-full rounded-lg border-gray-300 text-sm">
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-500 uppercase">
            Equipo afectado
        </label>
        <input type="text" name="equipo_afectado" value="{{ old('equipo_afectado') }}"
               placeholder="Ej: PC-INFO-01 / Impresora HP"
               class="mt-1 w-full rounded-lg border-gray-300 text-sm">
    </div>
</div>

<div>
    <label class="block text-xs font-semibold text-gray-500 uppercase">
        Evidencia / Adjunto
    </label>
    <input type="file" name="adjunto"
           class="mt-1 w-full rounded-lg border-gray-300 text-sm">
</div>
                    {{-- 🔹 FILA 1 --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Solicitante --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">
                                Solicitante
                            </label>

                            <input type="text"
                                   value="{{ Auth::user()?->name ?? 'Invitado' }}"
                                   disabled
                                   class="mt-1 w-full rounded-lg border-gray-300 bg-gray-100 text-sm">
                        </div>

                        {{-- Departamento --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">
                                Departamento
                            </label>

                            <select name="departamento"
                                    class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500">

                                <option value="">Seleccione</option>
                                <option value="Informática">Informática</option>
                                <option value="Cartera">Cartera</option>
                                <option value="Catastro">Catastro</option>
                                <option value="Jurídico">Jurídico</option>
                                <option value="RRHH">RRHH</option>
                                <option value="Dirección">Dirección</option>

                            </select>

                            @error('departamento')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Prioridad --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">
                                Prioridad
                            </label>

                            <select name="prioridad"
                                    class="mt-1 w-full rounded-lg border-gray-300 text-sm">

                                <option value="Baja">Baja</option>
                                <option value="Media" selected>Media</option>
                                <option value="Alta">Alta</option>
                                <option value="Urgente">Urgente</option>

                            </select>
                        </div>

                    </div>

                    {{-- 🔹 FILA 2 --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Asunto --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">
                                Asunto
                            </label>

                            <input type="text"
                                   name="titulo"
                                   value="{{ old('titulo') }}"
                                   placeholder="Ej: Problema con impresora"
                                   class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500">

                            @error('titulo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Categoría --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase">
                                Categoría
                            </label>

                            <select name="categoria"
                                    class="mt-1 w-full rounded-lg border-gray-300 text-sm">

                                <option value="Soporte técnico">Soporte técnico</option>
                                <option value="Internet">Internet</option>
                                <option value="Impresora">Impresora</option>
                                <option value="Correo">Correo</option>
                                <option value="Sistema interno">Sistema interno</option>
                                <option value="Mantenimiento">Mantenimiento</option>

                            </select>
                        </div>

                    </div>

                    {{-- 🔹 DESCRIPCIÓN --}}
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase">
                            Descripción del problema
                        </label>

                        <textarea name="descripcion"
                                  rows="4"
                                  placeholder="Describe el problema con detalle..."
                                  class="mt-1 w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 🔹 BOTONES --}}
                    <div class="flex justify-end gap-3 pt-4 border-t">

                        <a href="{{ route('tickets.index') }}"
                           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-semibold">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold shadow">
                            Guardar Ticket
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>