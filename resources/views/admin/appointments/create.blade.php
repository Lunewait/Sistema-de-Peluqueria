@extends('layouts.admin')

@section('title', 'Nueva Cita - Lumina Admin')

@section('content')
    <div class="max-w-3xl mx-auto px-8 py-6">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.appointments.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Nueva Cita</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.appointments.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    <!-- Cliente y Fecha -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                            <select name="client_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                <option value="">Seleccione un cliente</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                            <input type="date" name="date" required min="{{ date('Y-m-d') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                        </div>
                    </div>

                    <!-- Servicio y Estilista -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Servicio</label>
                            <select name="service_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                <option value="">Seleccione un servicio</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} - S/{{ $service->price }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estilista</label>
                            <select name="employee_id" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                <option value="">Seleccione un estilista</option>
                                @foreach($stylists as $stylist)
                                    <option value="{{ $stylist->id }}">{{ $stylist->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Hora y Notas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Hora de Inicio</label>
                            <input type="time" name="time" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notas</label>
                        <textarea name="notes" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500"
                            placeholder="Detalles de la reserva..."></textarea>
                    </div>

                    <div class="border-t border-gray-100 pt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.appointments.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow">Crear
                            Cita</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection