@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-500 mt-1">Bienvenido al panel de administración de Lumina</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">Hoy</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['today_appointments'] }}</p>
            <p class="text-gray-500 text-sm">Citas de hoy</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Pendientes</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_appointments'] }}</p>
            <p class="text-gray-500 text-sm">Por confirmar</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
            <p class="text-gray-500 text-sm">Clientes totales</p>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Este mes</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">${{ number_format($stats['revenue_month'], 2) }}</p>
            <p class="text-gray-500 text-sm">Ingresos del mes</p>
        </div>
    </div>

    <!-- Quick Actions + Recent -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Acciones Rápidas</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.appointments.create') }}"
                    class="flex items-center gap-4 p-4 rounded-xl bg-teal-50 hover:bg-teal-100 transition group">
                    <div class="w-10 h-10 bg-teal-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-teal-700 group-hover:text-teal-900">Nueva Cita</span>
                </a>
                <a href="{{ route('admin.services.create') }}"
                    class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition group">
                    <div class="w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-gray-900">Nuevo Servicio</span>
                </a>
                <a href="{{ route('admin.users.create') }}"
                    class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition group">
                    <div class="w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700 group-hover:text-gray-900">Nuevo Usuario</span>
                </a>
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-900">Últimas Citas</h3>
                <a href="{{ route('admin.appointments.index') }}"
                    class="text-teal-600 hover:text-teal-700 text-sm font-medium">Ver todas →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm text-gray-500 border-b">
                            <th class="pb-3 font-medium">Cliente</th>
                            <th class="pb-3 font-medium">Servicio</th>
                            <th class="pb-3 font-medium">Estilista</th>
                            <th class="pb-3 font-medium">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($recentAppointments as $apt)
                            <tr class="text-sm">
                                <td class="py-4">{{ $apt->client->name ?? 'N/A' }}</td>
                                <td class="py-4">{{ $apt->service->name ?? 'N/A' }}</td>
                                <td class="py-4">{{ $apt->employee->name ?? 'N/A' }}</td>
                                <td class="py-4">
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center text-gray-500">No hay citas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection