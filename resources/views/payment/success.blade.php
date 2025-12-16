@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-white flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full text-center space-y-8">

            <!-- Animación de Éxito -->
            <div class="rounded-full bg-green-100 p-6 w-24 h-24 mx-auto flex items-center justify-center animate-bounce">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <div>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">¡Pago Exitoso!</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Tu transacción ha sido procesada correctamente.
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-6 text-left border border-gray-100 shadow-sm">
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">ID de Transacción</dt>
                        <dd class="text-sm font-bold text-gray-900">PAY-{{ strtoupper(uniqid()) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm font-medium text-gray-500">Estado</dt>
                        <dd
                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                            Completado
                        </dd>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-4 mt-4">
                        <dt class="text-base font-medium text-gray-900">Total Pagado</dt>
                        <dd class="text-base font-bold text-teal-600">
                            @if($type === 'booking')
                                (Depósito de Reserva)
                            @else
                                Total
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="grid grid-cols-1 gap-3">
                @if($type === 'booking')
                    <a href="{{ route('home') }}"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-lg transition-all">
                        Volver al Inicio
                    </a>
                @else
                    <a href="{{ route('shop.index') }}"
                        class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-lg transition-all">
                        Seguir Comprando
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection