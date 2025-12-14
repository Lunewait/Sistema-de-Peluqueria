@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-20 px-6 text-center">

        <!-- Success Icon -->
        <div class="w-24 h-24 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">¡Reserva Confirmada!</h1>
        <p class="text-gray-500 text-lg mb-10">Tu cita ha sido agendada exitosamente. Te esperamos.</p>

        <!-- Appointment Details Card -->
        <div class="bg-slate-900 rounded-2xl p-8 text-left text-white mb-10">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-slate-400 text-sm">Tu Cita</p>
                    <p class="font-bold text-xl">{{ ucfirst($formattedDate) }}</p>
                </div>
            </div>

            <div class="space-y-4 border-t border-slate-700 pt-6">
                <div class="flex justify-between">
                    <span class="text-slate-400">Servicio</span>
                    <span class="font-medium">{{ $appointment->service->name ?? 'N/A' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Estilista</span>
                    <span class="font-medium">{{ $appointment->employee->name ?? 'Por asignar' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Precio Total</span>
                    <span class="font-bold text-teal-400">S/{{ number_format($appointment->price, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400">Depósito (20%)</span>
                    <span class="font-medium text-teal-300">S/{{ number_format($appointment->price * 0.2, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Info Notice -->
        <div class="bg-teal-50 border border-teal-200 rounded-xl p-6 mb-10 text-left">
            <div class="flex items-start gap-4">
                <span class="text-2xl">📧</span>
                <div>
                    <h4 class="font-semibold text-gray-900 mb-1">Confirmación enviada</h4>
                    <p class="text-gray-600 text-sm">Te hemos enviado un email con todos los detalles de tu cita. Recuerda
                        llegar 10 minutos antes.</p>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('home') }}"
                class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-4 rounded-full font-semibold transition-all">
                Volver al Inicio
            </a>
            <a href="{{ route('booking.step1') }}"
                class="border border-gray-300 hover:border-gray-400 px-8 py-4 rounded-full font-semibold text-gray-700 transition-all">
                Agendar otra Cita
            </a>
        </div>
    </div>
@endsection