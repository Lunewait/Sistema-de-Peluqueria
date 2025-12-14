@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Progress Bar -->
        <div class="mb-10 max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-4 relative">
                <!-- Step 1 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div class="w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center font-bold">✓
                    </div>
                    <span class="text-xs font-bold text-teal-600 mt-2 tracking-wide uppercase">Servicios</span>
                </div>

                <!-- Connection Line 1-2 -->
                <div class="absolute top-4 left-0 w-1/2 h-0.5 bg-teal-500 -z-0"></div>

                <!-- Step 2 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div class="w-8 h-8 rounded-full bg-teal-500 text-white flex items-center justify-center font-bold">✓
                    </div>
                    <span class="text-xs font-bold text-teal-600 mt-2 tracking-wide uppercase">Agenda</span>
                </div>

                <!-- Connection Line 2-3 -->
                <div class="absolute top-4 right-0 w-1/2 h-0.5 bg-teal-500 -z-0"></div>

                <!-- Step 3 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div
                        class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold shadow-lg shadow-teal-500/30 ring-4 ring-white">
                        3</div>
                    <span class="text-xs font-bold text-teal-700 mt-2 tracking-wide uppercase">Pago</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

            <!-- Left Column: Dark Summary Card (Fixed) -->
            <div class="lg:col-span-4 order-2 lg:order-1 sticky top-24">
                <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden">
                    <!-- Decorative Circle -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-500 rounded-full opacity-20 blur-3xl"></div>

                    <h3 class="text-xl font-bold mb-8">Resumen de Reserva</h3>

                    <!-- Service Info -->
                    <div class="flex gap-4 mb-6">
                        <div
                            class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-teal-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Servicio Principal</p>
                            <p class="font-medium text-lg leading-tight">{{ $service->name ?? '...' }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $service->duration_minutes ?? 60 }} minutos</p>
                            <p class="text-base font-semibold text-teal-400 mt-1">${{ $service->price }}</p>
                        </div>
                    </div>

                    <!-- Stylist Info -->
                    <div class="flex gap-4 mb-6">
                        <div
                            class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-teal-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Estilista</p>
                            <p class="font-medium text-lg">{{ $stylist->name ?? 'Cualquier Estilista' }}</p>
                            <div class="flex items-center gap-1 mt-1 text-yellow-500">
                                <span class="text-xs text-white bg-slate-800 px-1.5 py-0.5 rounded">★ 4.8</span>
                            </div>
                        </div>
                    </div>

                    <!-- Date Info -->
                    <div class="flex gap-4 mb-8 pb-8 border-b border-white/10">
                        <div
                            class="w-10 h-10 rounded-lg bg-white/10 flex items-center justify-center text-teal-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Fecha & Hora</p>
                            <p class="font-medium text-lg">{{ $formattedDate }}</p>
                        </div>
                    </div>

                    <!-- Added Products List (Dynamic) -->
                    <div id="addedProductsContainer" class="mb-8 hidden">
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-3">Productos Añadidos</p>
                        <div id="addedProductsList" class="space-y-3">
                            <!-- JS will populate -->
                        </div>
                        <div class="border-b border-white/10 mt-6"></div>
                    </div>

                    <!-- Totals -->
                    <div class="space-y-3">
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Subtotal</span>
                            <span id="summarySubtotal">${{ $service->price ?? '0.00' }}</span>
                        </div>
                        <div class="flex justify-between text-sm text-teal-400">
                            <span>Depósito Requerido (20%)</span>
                            <span id="summaryDeposit">${{ number_format(($service->price ?? 0) * 0.20, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-lg font-bold">Total</span>
                            <span class="text-3xl font-bold tracking-tight"
                                id="summaryTotal">${{ $service->price ?? '0.00' }}</span>
                        </div>
                    </div>

                    <!-- Loyalty Box -->
                    <!-- Experience Box -->
               <div class="mt-8 bg-teal-900/50 border border-teal-500/30 rounded-xl p-4 flex flex-col items-center text-center">
                   <p class="text-sm text-teal-200 uppercase tracking-widest text-[10px] mb-1">Experiencia Premium</p>
                   <div class="flex items-center gap-2 text-white font-medium">
                        <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>Diagnóstico + Bebida</span>
                   </div>
               </div>
                </div>
            </div>

            <!-- Right Column: Products & Form -->
            <div class="lg:col-span-8 order-1 lg:order-2">

                <!-- Products Section -->
                <div class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <h2 class="text-xl font-bold text-gray-700">Recomendados para tu Cuidado</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Product 1 -->
                        <div
                            class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-lg transition-all group">
                            <div class="h-40 rounded-xl bg-gray-100 mb-4 overflow-hidden relative">
                                <img src="/images/serum.png" class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm">Sérum Reparador Nocturno</h4>
                            <div class="flex justify-between items-end mt-3">
                                <span class="text-lg font-bold text-gray-900">$34.50</span>
                                <button onclick="toggleProduct(this, 'Sérum Reparador Nocturno', 34.50)"
                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-teal-500 hover:text-white flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Product 2 -->
                        <div
                            class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-lg transition-all group">
                            <div class="h-40 rounded-xl bg-gray-100 mb-4 overflow-hidden relative">
                                <!-- Using serum again as per failed gen, user can replace later -->
                                <img src="https://images.unsplash.com/photo-1556228720-1957be6a908a?auto=format&fit=crop&q=80&w=400"
                                    class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm">Mascarilla Hidratación Profunda</h4>
                            <div class="flex justify-between items-end mt-3">
                                <span class="text-lg font-bold text-gray-900">$28.00</span>
                                <button onclick="toggleProduct(this, 'Mascarilla Hidratación Profunda', 28.00)"
                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-teal-500 hover:text-white flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Product 3 -->
                        <div
                            class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-lg transition-all group">
                            <div class="h-40 rounded-xl bg-gray-100 mb-4 overflow-hidden relative">
                                <img src="https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&q=80&w=400"
                                    class="w-full h-full object-cover">
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm">Aceite de Argán Puro</h4>
                            <div class="flex justify-between items-end mt-3">
                                <span class="text-lg font-bold text-gray-900">$22.00</span>
                                <button onclick="toggleProduct(this, 'Aceite de Argan Puro', 22.00)"
                                    class="w-8 h-8 rounded-full bg-gray-100 hover:bg-teal-500 hover:text-white flex items-center justify-center transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <h2 class="text-2xl font-bold text-gray-900 mb-2">3. Finalizar Detalle</h2>
                <p class="text-gray-500 mb-8">Completa tus datos para asegurar tu cita.</p>

                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id ?? '' }}">
                    <input type="hidden" name="stylist_id" value="{{ $stylist->id ?? '' }}">
                    <input type="hidden" name="date" value="{{ $date ?? '' }}">
                    <input type="hidden" name="time" value="{{ $time ?? '' }}">
                    <!-- Products Data Hidden Input -->
                    <input type="hidden" name="products_json" id="productsJson">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Nombre Completo</label>
                            <input type="text" name="customer_name" required placeholder="Ej. Ana García"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" name="customer_email" required placeholder="correo@ejemplo.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Teléfono</label>
                            <input type="tel" name="customer_name" required placeholder="+54 9 11 ..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all">
                        </div>
                    </div>

                    <!-- Payment Mockup -->
                    <div class="bg-teal-50 border border-teal-100 rounded-2xl p-6 mb-8">
                        <div class="flex items-center gap-3 mb-4 text-teal-800">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            <h4 class="font-bold">Pago del Depósito Seguro</h4>
                        </div>
                        <p class="text-sm text-teal-600 mb-6">Para confirmar la reserva, requerimos un depósito de <span
                                class="font-bold"
                                id="depositAmountDisplay">${{ number_format(($service->price ?? 0) * 0.20, 2) }}</span>. El
                            resto se pagará en el salón.</p>

                        <div class="space-y-4">
                            <input type="text" placeholder="Número de Tarjeta (Simulado)"
                                class="w-full bg-white px-4 py-3 rounded-xl border border-teal-200 focus:border-teal-500 outline-none">
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" placeholder="MM/YY"
                                    class="w-full bg-white px-4 py-3 rounded-xl border border-teal-200 focus:border-teal-500 outline-none">
                                <input type="text" placeholder="CVC"
                                    class="w-full bg-white px-4 py-3 rounded-xl border border-teal-200 focus:border-teal-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-xl shadow-xl shadow-teal-600/20 transition-all flex items-center justify-center gap-2 transform active:scale-95">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Confirmar y Pagar <span
                            id="btnTotalLabel">{{ number_format(($service->price ?? 0) * 0.20, 2) }}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const basePrice = {{ $service->price ?? 0 }};
        let currentTotal = basePrice;
        let selectedProducts = [];

        function toggleProduct(btn, name, price) {
            const index = selectedProducts.findIndex(p => p.name === name);
            const icon = btn.querySelector('svg');

            if (index === -1) {
                // Add
                selectedProducts.push({ name, price });
                // Update Icon to Minus/Red
                btn.classList.remove('hover:bg-teal-500', 'bg-gray-100');
                btn.classList.add('bg-white', 'border-2', 'border-red-400', 'text-red-400', 'hover:bg-red-50');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>'; // Minus
            } else {
                // Remove
                selectedProducts.splice(index, 1);
                // Reset Icon
                btn.classList.add('hover:bg-teal-500', 'bg-gray-100');
                btn.classList.remove('bg-white', 'border-2', 'border-red-400', 'text-red-400', 'hover:bg-red-50');
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>'; // Plus
            }

            updateSummary();
        }

        function updateSummary() {
            const listContainer = document.getElementById('addedProductsList');
            const mainContainer = document.getElementById('addedProductsContainer');

            // Update List
            listContainer.innerHTML = '';
            if (selectedProducts.length > 0) {
                mainContainer.classList.remove('hidden');
                selectedProducts.forEach(p => {
                    const el = document.createElement('div');
                    el.className = 'flex justify-between text-sm';
                    el.innerHTML = `<span class='text-gray-300'>${p.name}</span><span class='text-white font-medium'>$${p.price.toFixed(2)}</span>`;
                    listContainer.appendChild(el);
                });
            } else {
                mainContainer.classList.add('hidden');
            }

            // Calculations
            let productsTotal = selectedProducts.reduce((sum, p) => sum + p.price, 0);
            let newSubtotal = basePrice + productsTotal;
            let newDeposit = newSubtotal * 0.20;

            // Displays
            document.getElementById('summarySubtotal').innerText = '$' + newSubtotal.toFixed(2);
            document.getElementById('summaryTotal').innerText = '$' + newSubtotal.toFixed(2);
            document.getElementById('summaryDeposit').innerText = '$' + newDeposit.toFixed(2);

            // Form & Button
            document.getElementById('btnTotalLabel').innerText = '$' + newDeposit.toFixed(2);
            document.getElementById('depositAmountDisplay').innerText = '$' + newDeposit.toFixed(2);

            // Hidden Input
            document.getElementById('productsJson').value = JSON.stringify(selectedProducts);
        }
    </script>
@endsection