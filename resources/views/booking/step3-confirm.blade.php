@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-6">

        <!-- Progress Steps -->
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-teal-600 text-sm font-medium mt-2">SERVICIOS</span>
                </div>
                <div class="w-24 h-0.5 bg-teal-600"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-teal-600 text-sm font-medium mt-2">AGENDA</span>
                </div>
                <div class="w-24 h-0.5 bg-teal-600"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold">3
                    </div>
                    <span class="text-teal-600 text-sm font-medium mt-2">PAGO</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Sidebar Oscuro - Resumen -->
            <div class="lg:col-span-1 order-2 lg:order-1">
                <div class="bg-slate-900 rounded-2xl p-6 text-white sticky top-6">
                    <h3 class="text-xl font-bold mb-6">Resumen de Reserva</h3>

                    <!-- Servicio -->
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-teal-600/20 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wide">Servicio Principal</p>
                            <p class="font-semibold" id="summary-service">{{ $service->name ?? 'Servicio' }}</p>
                            <p class="text-slate-400 text-sm" id="summary-duration">{{ $service->duration_minutes ?? 30 }}
                                minutos</p>
                            <p class="text-teal-400 font-semibold" id="summary-price">
                                S/{{ number_format($service->price ?? 0, 2) }}</p>
                        </div>
                    </div>

                    <!-- Estilista -->
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wide">Estilista</p>
                            <p class="font-semibold" id="summary-stylist">{{ $stylist->name ?? 'Cualquier disponible' }}</p>
                            <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                4.8
                            </div>
                        </div>
                    </div>

                    <!-- Fecha y Hora -->
                    <div class="flex items-start gap-4 mb-6">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wide">Fecha & Hora</p>
                            <p class="font-semibold" id="summary-datetime">{{ $formattedDate }}</p>
                        </div>
                    </div>

                    <!-- Productos Añadidos -->
                    <div id="added-products-section" class="border-t border-slate-700 pt-4 mb-4 hidden">
                        <p class="text-slate-400 text-xs uppercase tracking-wide mb-3">Productos Añadidos</p>
                        <div id="added-products-list" class="space-y-2"></div>
                    </div>

                    <!-- Totales -->
                    <div class="border-t border-slate-700 pt-4 space-y-2">
                        <div class="flex justify-between text-slate-400 text-sm">
                            <span>Subtotal</span>
                            <span id="summary-subtotal">S/{{ number_format($service->price ?? 0, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-teal-400 font-medium">
                            <span>Depósito Requerido (20%)</span>
                            <span id="summary-deposit">S/{{ number_format(($service->price ?? 0) * 0.20, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="lg:col-span-2 order-1 lg:order-2">

                <!-- Productos Recomendados -->
                @if($products->count() > 0)
                    <div class="mb-10">
                        <div class="flex items-center gap-2 mb-6">
                            <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                            <h2 class="text-xl font-bold text-gray-900">Recomendados para tu Cuidado</h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="product-card border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all bg-white"
                                    data-product-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}">
                                    <div class="h-40 bg-gray-50 flex items-center justify-center">
                                        @if($product->image_url)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-contain p-4">
                                        @else
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h4 class="font-semibold text-gray-900 mb-1 truncate">{{ $product->name }}</h4>
                                        <div class="flex items-center justify-between">
                                            <span class="text-teal-600 font-bold">S/{{ number_format($product->price, 2) }}</span>
                                            <button
                                                onclick="toggleProduct(this, {{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }})"
                                                class="add-btn w-8 h-8 rounded-full border-2 border-gray-200 flex items-center justify-center hover:border-teal-600 hover:bg-teal-50 transition-all">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Experiencia Premium -->
                <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-6 mb-10 text-white">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">Experiencia Premium Incluida</h3>
                            <p class="text-teal-100 text-sm">Tu reserva incluye diagnóstico capilar personalizado + bebida
                                de cortesía</p>
                        </div>
                    </div>
                </div>

                <!-- Confirmar Reserva (Sin datos de tarjeta) -->
                <div class="bg-white rounded-2xl border border-gray-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900">Confirmar Reserva</h3>
                    </div>

                    <p class="text-gray-500 mb-6">
                        Tu reserva será confirmada inmediatamente. El depósito del <strong>20%</strong> se pagará en el
                        salón al momento de asistir.
                    </p>

                    <!-- Datos del Cliente -->
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ request('service_id', 1) }}">
                        <input type="hidden" name="stylist_id" value="{{ request('stylist_id') }}">
                        <input type="hidden" name="date" value="{{ request('date', now()->format('Y-m-d')) }}">
                        <input type="hidden" name="time" value="{{ request('time', '10:00') }}">

                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                                <input type="text" name="client_name" required placeholder="Tu nombre"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                                <input type="tel" name="client_phone" required placeholder="987 654 321"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="client_email" required placeholder="tu@email.com"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-4 rounded-xl flex items-center justify-center gap-3 transition-all shadow-lg shadow-teal-600/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Confirmar Reserva
                        </button>
                    </form>

                    <p class="text-center text-gray-400 text-sm mt-6">
                        📧 Recibirás un email de confirmación con todos los detalles
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        let baseServicePrice = {{ $service->price ?? 0 }}; // Precio del servicio base
        let addedProducts = {};

        function toggleProduct(button, productId, productName, productPrice) {
            const card = button.closest('.product-card');

            if (addedProducts[productId]) {
                // Remove product
                delete addedProducts[productId];
                card.classList.remove('border-teal-500', 'bg-teal-50');
                button.innerHTML = '<svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>';
                button.classList.remove('bg-red-50', 'border-red-300');
            } else {
                // Add product
                addedProducts[productId] = { name: productName, price: productPrice };
                card.classList.add('border-teal-500', 'bg-teal-50');
                button.innerHTML = '<svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>';
                button.classList.add('bg-red-50', 'border-red-300');
            }

            updateSummary();
        }

        function updateSummary() {
            const productsList = document.getElementById('added-products-list');
            const productsSection = document.getElementById('added-products-section');

            // Calculate totals
            let productsTotal = 0;
            let productsHTML = '';

            for (let id in addedProducts) {
                productsTotal += addedProducts[id].price;
                productsHTML += `<div class="flex justify-between text-sm">
                                    <span class="text-slate-300">${addedProducts[id].name}</span>
                                    <span class="text-white">S/${addedProducts[id].price.toFixed(2)}</span>
                                </div>`;
            }

            // Show/hide products section
            if (Object.keys(addedProducts).length > 0) {
                productsSection.classList.remove('hidden');
                productsList.innerHTML = productsHTML;
            } else {
                productsSection.classList.add('hidden');
            }

            // Update totals
            const subtotal = baseServicePrice + productsTotal;
            const deposit = subtotal * 0.20;

            document.getElementById('summary-subtotal').textContent = 'S/' + subtotal.toFixed(2);
            document.getElementById('summary-deposit').textContent = 'S/' + deposit.toFixed(2);
        }
    </script>
@endsection