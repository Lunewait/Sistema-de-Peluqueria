@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" x-data="checkoutPage()">
        <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Columna Izquierda: Resumen -->
            <div class="md:col-span-1 order-2 md:order-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Resumen del Pedido</h3>

                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 leading-tight">{{ $concept }}</p>
                            <p class="text-sm text-gray-500">ID: #{{ $item->id }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 my-4 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium">S/{{ number_format($amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Comisión Pasarela</span>
                            <span class="font-medium">S/0.00</span>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4 flex justify-between items-center">
                        <span class="font-bold text-gray-900">Total a Pagar</span>
                        <span class="font-bold text-xl text-teal-600">S/{{ number_format($amount, 2) }}</span>
                    </div>

                    <div class="mt-6 flex items-center gap-2 text-xs text-gray-400 bg-gray-50 p-2 rounded justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        <span>Pago Seguro 128-bit SSL</span>
                    </div>
                </div>
            </div>

            <!-- Columna Central/Derecha: Formulario de Pago -->
            <div class="md:col-span-2 order-1 md:order-2">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <div
                        class="bg-gradient-to-r from-slate-900 to-slate-800 px-8 py-6 text-white flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold">Pasarela de Pago Segura</h2>
                            <p class="text-slate-400 text-sm">Completa tus datos para procesar la transacción</p>
                        </div>
                        <div class="flex gap-2 opacity-70">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg"
                                class="h-6 bg-white rounded px-1">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg"
                                class="h-6 bg-white rounded px-1">
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Selector de Método -->
                        <div class="flex gap-4 mb-8">
                            <button @click="method = 'card'"
                                :class="method === 'card' ? 'border-teal-500 ring-1 ring-teal-500 bg-teal-50 text-teal-800' : 'border-gray-200 hover:border-gray-300'"
                                class="flex-1 py-4 border rounded-xl font-bold text-sm transition-all flex flex-col items-center gap-2">
                                <span class="text-2xl">💳</span>
                                Tarjeta Débito/Crédito
                            </button>
                            <button @click="method = 'yape'"
                                :class="method === 'yape' ? 'border-teal-500 ring-1 ring-teal-500 bg-teal-50 text-teal-800' : 'border-gray-200 hover:border-gray-300'"
                                class="flex-1 py-4 border rounded-xl font-bold text-sm transition-all flex flex-col items-center gap-2">
                                <span class="text-2xl">📱</span>
                                Yape / Plin (QR)
                            </button>
                        </div>

                        <!-- Formulario Tarjeta -->
                        <form action="{{ route('payment.process') }}" method="POST" x-show="method === 'card'"
                            @submit="processing = true">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="payment_method" value="card">

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Número de Tarjeta</label>
                                    <div class="relative">
                                        <input type="text" placeholder="0000 0000 0000 0000" maxlength="19"
                                            x-model="cardNumber" @input="formatCard"
                                            class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 uppercase tracking-widest"
                                            required>
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiración</label>
                                        <input type="text" placeholder="MM/YY" maxlength="5" x-model="expiry"
                                            @input="formatExpiry"
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 text-center"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">CVC / CVV</label>
                                        <div class="relative">
                                            <input type="text" placeholder="123" maxlength="4"
                                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 text-center"
                                                required>
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-400">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Titular</label>
                                    <input type="text" placeholder="Como aparece en la tarjeta"
                                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 uppercase"
                                        required>
                                </div>

                                <button type="submit" :disabled="processing"
                                    class="w-full bg-slate-900 border border-transparent rounded-xl py-4 flex items-center justify-center text-base font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-all shadow-lg transform active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed">
                                    <span x-show="!processing">Pagar S/{{ number_format($amount, 2) }}</span>
                                    <span x-show="processing" class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Procesando...
                                    </span>
                                </button>
                            </div>
                        </form>

                        <!-- Simulación Yape/Plin -->
                        <form action="{{ route('payment.process') }}" method="POST" x-show="method === 'yape'"
                            @submit="processing = true">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="hidden" name="payment_method" value="yape">

                            <div class="text-center py-6">
                                <p class="text-gray-600 mb-4 font-medium">Escanea este código QR con tu app</p>
                                <div
                                    class="bg-gray-100 p-4 inline-block rounded-xl border-2 border-dashed border-gray-300 mb-4">
                                    <!-- QR Mock -->
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Simulacion_Pago_Lumina_{{ $item->id }}"
                                        class="w-48 h-48 opacity-80">
                                </div>
                                <p class="text-xs text-gray-400 mb-8">Código válido por 5:00 minutos</p>

                                <button type="submit" :disabled="processing"
                                    class="w-full bg-teal-600 border border-transparent rounded-xl py-4 flex items-center justify-center text-base font-medium text-white hover:bg-teal-700 transition-all shadow-lg transform active:scale-95 disabled:opacity-70">
                                    <span x-show="!processing">✅ Confirmar Pago Realizado</span>
                                    <span x-show="processing" class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Verificando...
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <p class="text-center text-gray-400 text-xs mt-6">
                    Lumina Salon & Spa - Todos los derechos reservados.<br>
                    Esta es una transacción segura simulada para propósitos de demostración.
                </p>
            </div>
        </div>
    </div>

    <script>
        function checkoutPage() {
            return {
                method: 'card', // card, yape
                cardNumber: '',
                expiry: '',
                processing: false,

                formatCard() {
                    let val = this.cardNumber.replace(/\D/g, '');
                    val = val.replace(/(.{4})/g, '$1 ').trim();
                    this.cardNumber = val.substring(0, 19);
                },

                formatExpiry() {
                    let val = this.expiry.replace(/\D/g, '');
                    if (val.length >= 2) {
                        val = val.substring(0, 2) + '/' + val.substring(2, 4);
                    }
                    this.expiry = val.substring(0, 5);
                }
            }
        }
    </script>
@endsection