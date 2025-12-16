@extends('layouts.app')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-teal-50 via-white to-gray-50 flex items-center justify-center py-20 px-6">
        <div class="max-w-2xl w-full">

            <!-- Success Animation Container -->
            <div class="text-center mb-10 animate-fade-in">
                <!-- Animated Check Icon -->
                <div class="relative inline-block">
                    <div class="absolute inset-0 bg-teal-400 rounded-full blur-2xl opacity-30 animate-pulse"></div>
                    <div
                        class="relative w-28 h-28 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mx-auto shadow-2xl shadow-teal-500/40 animate-bounce-in">
                        <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 mt-8 mb-3">¡Reserva Confirmada!</h1>
                <p class="text-lg text-gray-500">Tu cita ha sido agendada exitosamente. Te esperamos con ansias.</p>
            </div>

            <!-- Appointment Details Card -->
            <div class="bg-slate-900 rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/30 mb-8 animate-slide-up">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-teal-600 to-teal-500 px-8 py-5">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="text-white">
                            <p class="text-sm font-medium text-teal-100">Tu Cita</p>
                            <p class="font-bold text-xl">{{ ucfirst($formattedDate) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-8 space-y-5">
                    <div class="flex justify-between items-center py-3 border-b border-slate-700/50">
                        <span class="text-slate-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z">
                                </path>
                            </svg>
                            Servicio
                        </span>
                        <span class="font-semibold text-white">{{ $appointment->service->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-slate-700/50">
                        <span class="text-slate-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Estilista
                        </span>
                        <span class="font-semibold text-white">{{ $appointment->employee->name ?? 'Por asignar' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3 border-b border-slate-700/50">
                        <span class="text-slate-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Duración
                        </span>
                        <span class="font-semibold text-white">{{ $appointment->service->duration_minutes ?? 45 }}
                            minutos</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-slate-400 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            Precio Total
                        </span>
                        <span class="font-bold text-2xl text-teal-400">S/{{ number_format($appointment->price, 2) }}</span>
                    </div>
                </div>

                <!-- Deposit Info -->
                <div class="bg-slate-800/50 px-8 py-4 flex justify-between items-center">
                    <div>
                        <span class="text-sm text-slate-400">Depósito requerido (20%)</span>
                        <p class="text-teal-400 font-bold text-lg">
                            S/{{ number_format($appointment->deposit_amount ?? $appointment->price * 0.2, 2) }}</p>
                    </div>
                    <span class="bg-yellow-500/20 text-yellow-400 text-xs font-bold px-3 py-1.5 rounded-full">
                        Pendiente de pago
                    </span>
                </div>
            </div>

            <!-- Info Notice -->
            <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8 shadow-sm animate-slide-up">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Confirmación enviada a tu email</h4>
                        <p class="text-gray-500 text-sm">Te hemos enviado un correo con todos los detalles. Recuerda llegar
                            <strong>10 minutos antes</strong> de tu cita.</p>
                    </div>
                </div>
            </div>

            <!-- Important Notes -->
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-10 animate-slide-up">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-amber-800 mb-1">Importante</h4>
                        <p class="text-amber-700 text-sm">El depósito del 20% se pagará en el salón al momento de asistir.
                            Si necesitas cancelar, hazlo con al menos 24 horas de anticipación.</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in">
                <a href="{{ route('home') }}"
                    class="bg-gray-900 hover:bg-gray-800 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver al Inicio
                </a>
                <a href="{{ route('booking.step1') }}"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-4 rounded-xl font-semibold transition-all shadow-lg shadow-teal-600/30 hover:shadow-xl flex items-center justify-center gap-2 group">
                    Agendar otra Cita
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes bounce-in {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            60% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-bounce-in {
            animation: bounce-in 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }

        .animate-slide-up {
            animation: slide-up 0.6s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }
    </style>
@endsection