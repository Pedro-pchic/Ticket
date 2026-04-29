@extends('layouts.app')

@section('titulo', 'Dashboard')

@section('contenido')

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Usuarios</h3>
        <p class="text-3xl font-bold">150</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Ventas</h3>
        <p class="text-3xl font-bold text-green-500">Q 12,500</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="text-gray-500">Pedidos</h3>
        <p class="text-3xl font-bold text-blue-500">45</p>
    </div>

</div>

@endsection