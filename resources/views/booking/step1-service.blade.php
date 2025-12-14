@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-6">

        <!-- Progress Steps -->
        <div class="flex items-center justify-center mb-12">
            <div class="flex items-center gap-4">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold">1
                    </div>
                    <span class="text-teal-600 text-sm font-medium mt-2">SERVICIOS</span>
                </div>
                <div class="w-24 h-0.5 bg-gray-200"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">
                        2</div>
                    <span class="text-gray-400 text-sm font-medium mt-2">AGENDA</span>
                </div>
                <div class="w-24 h-0.5 bg-gray-200"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">
                        3</div>
                    <span class="text-gray-400 text-sm font-medium mt-2">PAGO</span>
                </div>
            </div>
        </div>

        <!-- Section 1: Servicios -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">1. Selecciona tu Experiencia</h2>
            <p class="text-gray-500 mb-8">Elige entre nuestros servicios premium diseñados para ti.</p>

            <div class="grid md:grid-cols-2 gap-6">
                @foreach($services as $service)
                    <div onclick="selectService(this, {{ $service->id }}, {{ $service->price }}, {{ $service->duration_minutes }})"
                        class="service-card cursor-pointer border-2 border-gray-100 rounded-2xl p-5 flex gap-4 hover:border-teal-500 hover:shadow-lg transition-all group relative">

                        <!-- Imagen del servicio -->
                        <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                            @if($service->image)
                                <img src="{{ $service->image }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Info del servicio -->
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $service->name }}</h3>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $service->description }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-400 text-sm">{{ $service->duration_minutes }} min</span>
                                <span class="text-teal-600 font-bold text-lg">S/{{ number_format($service->price, 2) }}</span>
                            </div>
                        </div>

                        <!-- Check mark when selected -->
                        <div
                            class="check-icon absolute top-4 right-4 w-6 h-6 bg-teal-600 rounded-full items-center justify-center hidden">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Section 2: Estilistas -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">¿Preferencia de Estilista?</h2>
            <p class="text-gray-500 mb-8">Selecciona un profesional o permite que te asignemos el mejor disponible.</p>

            <div class="flex gap-6 flex-wrap">
                <!-- Opción: Cualquier disponible -->
                <div onclick="selectStylist(this, null)"
                    class="stylist-card cursor-pointer flex flex-col items-center gap-3 p-4 rounded-2xl border-2 border-dashed border-gray-200 hover:border-teal-500 transition-all min-w-[100px]">
                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                        <span
                            class="text-gray-400 text-xs text-center leading-tight font-medium">Cualquiera<br>Disponible</span>
                    </div>
                </div>

                @foreach($stylists as $stylist)
                    <div onclick="selectStylist(this, {{ $stylist->id }})"
                        class="stylist-card cursor-pointer flex flex-col items-center gap-3 p-4 rounded-2xl border-2 border-transparent hover:border-teal-500 transition-all min-w-[100px]">
                        <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200">
                            @if($stylist->profile_image)
                                <img src="{{ $stylist->profile_image }}" alt="{{ $stylist->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold text-xl">
                                    {{ substr($stylist->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="font-medium text-gray-900 text-sm">{{ $stylist->name }}</p>
                            <div class="flex items-center justify-center gap-1 text-gray-500 text-xs">
                                <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                                <span>{{ number_format(rand(45, 50) / 10, 1) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Botón Continuar -->
        <div class="flex justify-end">
            <a id="continueBtn" href="#" onclick="return validateAndContinue()"
                class="bg-gray-300 text-gray-500 cursor-not-allowed px-8 py-4 rounded-full font-semibold flex items-center gap-2 transition-all">
                Continuar
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </div>

    <script>
        let selectedServiceId = null;
        let selectedStylistId = null;
        let selectedPrice = 0;
        let selectedDuration = 0;

        function selectService(element, serviceId, price, duration) {
            // Remove selection from all
            document.querySelectorAll('.service-card').forEach(card => {
                card.classList.remove('border-teal-500', 'bg-teal-50');
                card.querySelector('.check-icon').classList.add('hidden');
                card.querySelector('.check-icon').classList.remove('flex');
            });

            // Add selection to clicked
            element.classList.add('border-teal-500', 'bg-teal-50');
            element.querySelector('.check-icon').classList.remove('hidden');
            element.querySelector('.check-icon').classList.add('flex');

            selectedServiceId = serviceId;
            selectedPrice = price;
            selectedDuration = duration;

            updateContinueButton();
        }

        function selectStylist(element, stylistId) {
            // Remove selection from all
            document.querySelectorAll('.stylist-card').forEach(card => {
                card.classList.remove('border-teal-500', 'bg-teal-50');
            });

            // Add selection to clicked
            element.classList.add('border-teal-500', 'bg-teal-50');
            selectedStylistId = stylistId;

            updateContinueButton();
        }

        function updateContinueButton() {
            const btn = document.getElementById('continueBtn');
            if (selectedServiceId) {
                btn.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                btn.classList.add('bg-teal-600', 'text-white', 'hover:bg-teal-700', 'shadow-lg', 'shadow-teal-600/20');
            }
        }

        function validateAndContinue() {
            if (!selectedServiceId) {
                alert('Por favor selecciona un servicio');
                return false;
            }
            // Navigate to step 2 with selected options
            const stylistParam = selectedStylistId ? `&stylist_id=${selectedStylistId}` : '';
            window.location.href = `{{ route('booking.step2') }}?service_id=${selectedServiceId}${stylistParam}`;
            return false;
        }
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection