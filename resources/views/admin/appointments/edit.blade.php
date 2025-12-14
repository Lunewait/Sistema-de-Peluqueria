@extends('layouts.admin')

@section('title', 'Editar Cita')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <a href="{{ route('admin.appointments.index') }}"
                class="text-gray-500 hover:text-teal-600 text-sm flex items-center gap-1 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a citas
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar Cita</h1>
        </div>

        <form action="{{ route('admin.appointments.update', $appointment) }}" method="POST"
            class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cliente *</label>
                    <select name="client_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ $appointment->client_id == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Servicio *</label>
                    <select name="service_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $appointment->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estilista *</label>
                    <select name="employee_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                        @foreach($stylists as $stylist)
                            <option value="{{ $stylist->id }}" {{ $appointment->employee_id == $stylist->id ? 'selected' : '' }}>
                                {{ $stylist->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha *</label>
                        <input type="date" name="date"
                            value="{{ \Carbon\Carbon::parse($appointment->start_time)->format('Y-m-d') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Hora *</label>
                        <input type="time" name="time"
                            value="{{ \Carbon\Carbon::parse($appointment->start_time)->format('H:i') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                    <select name="status" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                        @foreach(['Pending', 'Confirmed', 'Completed', 'Cancelled', 'NoShow'] as $status)
                            <option value="{{ $status }}" {{ $appointment->status == $status ? 'selected' : '' }}>{{ $status }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notas</label>
                    <textarea name="notes" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">{{ $appointment->notes }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl font-medium transition">Actualizar
                    Cita</button>
                <a href="{{ route('admin.appointments.index') }}"
                    class="px-6 py-3 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition">Cancelar</a>
            </div>
        </form>
    </div>
@endsection