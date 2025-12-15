@extends('layouts.admin')

@section('title', 'Dashboard - Lumina Admin')

@section('content')
    <!-- Top Bar -->
    <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8">
        <h1 class="text-2xl font-bold text-gray-900">Resumen General</h1>
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-teal-600 flex items-center gap-1">
                Ver Sitio Web
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
        </div>
    </header>

    <div class="p-8">
        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xs font-semibold text-teal-600 bg-teal-50 px-2 py-1 rounded-full">+{{ $stats['today_appointments'] }}
                        Hoy</span>
                </div>
                <h3 class="text-gray-400 text-sm font-medium">Citas Totales</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_appointments'] }}</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-sm font-medium">Clientes Registrados</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-sm font-medium">Pendientes</h3>
                <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_appointments'] }}</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-sm font-medium">Ingresos (Mes)</h3>
                <p class="text-3xl font-bold text-gray-900">S/{{ number_format($stats['revenue_month'], 2) }}</p>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-900">Citas Recientes</h2>
                <a href="{{ route('appointments.index') }}"
                    class="text-sm font-medium text-teal-600 hover:text-teal-700">Ver todas</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-3 font-medium">Cliente</th>
                            <th class="px-6 py-3 font-medium">Servicio</th>
                            <th class="px-6 py-3 font-medium">Estilista</th>
                            <th class="px-6 py-3 font-medium">Fecha y Hora</th>
                            <th class="px-6 py-3 font-medium">Estado</th>
                            <th class="px-6 py-3 font-medium text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentAppointments as $apt)
                                        <tr class="hover:bg-gray-50/50 transition">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">
                                                        {{ substr($apt->client->name ?? 'C', 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900 text-sm">{{ $apt->client->name ?? 'Cliente' }}
                                                        </p>
                                                        <p class="text-xs text-gray-400">{{ $apt->client->email ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $apt->service->name ?? 'Servicio' }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $apt->employee->name ?? 'Estilista' }}</td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                {{ $apt->start_time->format('d M, Y') }} <br>
                                                <span class="text-xs text-gray-400">{{ $apt->start_time->format('H:i') }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    {{ $apt->status === 'Confirmed' ? 'bg-green-100 text-green-800' :
                            ($apt->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ $apt->status }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-gray-900">
                                                S/{{ number_format($apt->price, 2) }}
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    No hay citas recientes.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection