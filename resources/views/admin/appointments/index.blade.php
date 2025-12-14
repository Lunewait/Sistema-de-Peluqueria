@extends('layouts.admin')

@section('title', 'Citas')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Citas</h1>
            <p class="text-gray-500 mt-1">Gestiona todas las reservaciones</p>
        </div>
        <a href="{{ route('admin.appointments.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-3 rounded-xl font-medium flex items-center gap-2 transition shadow-lg shadow-teal-600/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nueva Cita
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-sm text-gray-600">
                    <th class="px-6 py-4 font-medium">Cliente</th>
                    <th class="px-6 py-4 font-medium">Servicio</th>
                    <th class="px-6 py-4 font-medium">Estilista</th>
                    <th class="px-6 py-4 font-medium">Fecha/Hora</th>
                    <th class="px-6 py-4 font-medium">Estado</th>
                    <th class="px-6 py-4 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($appointments as $apt)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $apt->client->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $apt->service->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $apt->employee->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($apt->start_time)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'Pending' => 'bg-amber-100 text-amber-700',
                                    'Confirmed' => 'bg-blue-100 text-blue-700',
                                    'Completed' => 'bg-green-100 text-green-700',
                                    'Cancelled' => 'bg-red-100 text-red-700',
                                    'NoShow' => 'bg-gray-100 text-gray-700',
                                ];
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$apt->status] ?? 'bg-gray-100' }}">
                                {{ $apt->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.appointments.edit', $apt) }}"
                                class="text-teal-600 hover:text-teal-800 font-medium text-sm">Editar</a>
                            <form action="{{ route('admin.appointments.destroy', $apt) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Eliminar esta cita?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 font-medium text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No hay citas registradas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($appointments->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>
@endsection