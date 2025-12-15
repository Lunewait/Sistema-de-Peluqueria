@extends('layouts.admin')

@section('title', 'Gestión de Citas - Lumina Admin')

@section('content')
    <div class="px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Citas</h1>
            <a href="{{ route('appointments.create') }}"
                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Cita
            </a>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
            <form method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Buscar cliente..."
                    class="flex-1 rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                <select name="status" class="rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                    <option value="">Todos los Estados</option>
                    <option value="Confirmed">Confirmadas</option>
                    <option value="Pending">Pendientes</option>
                    <option value="Cancelled">Canceladas</option>
                    <option value="Completed">Completadas</option>
                </select>
                <button type="submit"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm font-medium">Filtrar</button>
            </form>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-3 font-medium">ID</th>
                            <th class="px-6 py-3 font-medium">Cliente</th>
                            <th class="px-6 py-3 font-medium">Servicio</th>
                            <th class="px-6 py-3 font-medium">Estilista</th>
                            <th class="px-6 py-3 font-medium">Fecha</th>
                            <th class="px-6 py-3 font-medium">Estado</th>
                            <th class="px-6 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4 text-gray-500">#{{ $appointment->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $appointment->client->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-400">{{ $appointment->client->email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $appointment->service->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $appointment->employee->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $appointment->start_time->format('d M, Y') }}<br>
                                    <span class="text-xs text-gray-400">{{ $appointment->start_time->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $appointment->status == 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $appointment->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $appointment->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $appointment->status == 'Completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                        {{ $appointment->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('appointments.edit', $appointment) }}"
                                            class="p-1 hover:bg-gray-100 rounded text-blue-600 hover:text-blue-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-1 hover:bg-red-50 rounded text-red-600 hover:text-red-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    No se encontraron citas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($appointments instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection