@extends('layouts.app')

@section('content')
    <div class="min-h-[80vh] flex flex-col items-center justify-center p-4">
        <div class="bg-teal-50 rounded-full p-8 mb-6 animate-fade-in">
            <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center shadow-xl shadow-teal-500/20">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-slate-900 mb-2 text-center">¡Reserva Confirmada!</h1>

        <div class="text-center text-slate-500 max-w-md mb-10">
            <p>Gracias <strong>{{ $appointment->client->name }}</strong>, hemos enviado los detalles a <span
                    class="font-medium text-slate-700">{{ $appointment->client->email }}</span>.</p>
            <p class="mt-2 text-lg text-teal-600 font-medium">Te esperamos el {{ $formattedDate }}.</p>
        </div>

        <a href="{{ route('booking.step1') }}"
            class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95">
            Volver al Inicio
        </a>
    </div>
@endsection