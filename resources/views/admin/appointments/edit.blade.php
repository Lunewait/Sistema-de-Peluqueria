@extends('layouts.admin')

@section('title', 'Editar Cita - Lumina Admin')

@section('content')
<div class="max-w-3xl mx-auto px-8 py-6">
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('admin.appointments.index') }}" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Editar Cita #{{ $appointment->id }}</h1>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                 <!-- Status Bar -->
                <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Estado Actual:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold 
                        {{ $appointment->status == 'Confirmed' ? 'bg-green-100 text-green-700' : 
                           ($appointment->status == 'Pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-200 text-gray-700') }}">
                        {{ $appointment->status }}
                    </span>
                </div>

                <!-- Cliente y Fecha -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                        <select name="client_id" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }} ({{ $client->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" name="date" value="{{ $appointment->start_time->format('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                </div>

                <!-- Servicio y Estilista -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                        <select name="service_id" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} - S/{{ $service->price }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estilista</label>
                        <select name="employee_id" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            @foreach($stylists as $stylist)
                                <option value="{{ $stylist->id }}" {{ $appointment->employee_id == $stylist->id ? 'selected' : '' }}>
                                    {{ $stylist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Hora y Estado -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hora de Inicio</label>
                        <input type="time" name="time" value="{{ $appointment->start_time->format('H:i') }}" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select name="status" required class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending (Pendiente)</option>
                            <option value="Confirmed" {{ $appointment->status == 'Confirmed' ? 'selected' : '' }}>Confirmed (Confirmada)</option>
                            <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed (Completada)</option>
                            <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled (Cancelada)</option>
                            <option value="NoShow" {{ $appointment->status == 'NoShow' ? 'selected' : '' }}>NoShow (No Asistió)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                    <textarea name="notes" rows="3" class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">{{ $appointment->notes }}</textarea>
                </div>

                <div class="border-t border-gray-100 pt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.appointments.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                    <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow">Actualizar Cita</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection