@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- Progress Bar -->
        <div class="mb-10">
            <div class="flex justify-between items-center mb-4 relative">
                <!-- Step 1 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div
                        class="w-10 h-10 rounded-full bg-teal-500 text-white flex items-center justify-center font-bold shadow-lg shadow-teal-500/30 ring-4 ring-white">
                        1</div>
                    <span class="text-xs font-bold text-teal-600 mt-2 tracking-wide uppercase">Servicios</span>
                </div>

                <!-- Connection Line 1-2 -->
                <div class="absolute top-5 left-0 w-1/2 h-0.5 bg-gray-200 -z-0"></div>

                <!-- Step 2 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div
                        class="w-8 h-8 rounded-full bg-white border-2 border-gray-200 text-gray-400 flex items-center justify-center font-medium text-sm">
                        2</div>
                    <span class="text-xs font-medium text-gray-400 mt-2 tracking-wide uppercase">Agenda</span>
                </div>

                <!-- Connection Line 2-3 -->
                <div class="absolute top-5 right-0 w-1/2 h-0.5 bg-gray-200 -z-0"></div>

                <!-- Step 3 Indicator -->
                <div class="flex flex-col items-center z-10">
                    <div
                        class="w-8 h-8 rounded-full bg-white border-2 border-gray-200 text-gray-400 flex items-center justify-center font-medium text-sm">
                        3</div>
                    <span class="text-xs font-medium text-gray-400 mt-2 tracking-wide uppercase">Pago</span>
                </div>
            </div>
        </div>

        <!-- Intro -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">1. Selecciona tu Experiencia</h2>
            <p class="text-gray-500">Elige entre nuestros servicios premium diseñados para ti.</p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 gap-6 mb-12">
            @foreach($services as $service)
                <!-- Service Card -->
                <div class="group relative bg-white rounded-2xl p-4 border border-gray-100 shadow-sm hover:shadow-xl hover:border-teal-100 transition-all duration-300 cursor-pointer flex flex-col sm:flex-row gap-6 overflow-hidden"
                    onclick="selectCard(this, 'service', {{ $service->id }})">

                    <!-- Image Section -->
                    <div class="w-full sm:w-40 h-40 rounded-xl overflow-hidden flex-shrink-0 relative">
                        @php
                            $img = '/images/haircut.png'; // Default
                            if (Str::contains($service->name, 'Color'))
                                $img = '/images/coloring.png';
                            // Add more mappings as needed
                        @endphp
                        <img src="{{ $img }}" alt="{{ $service->name }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                    </div>

                    <!-- Content Section -->
                    <div class="flex-1 flex flex-col justify-center">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">
                                    {{ $service->name }}</h3>
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed line-clamp-2">{{ $service->description }}
                                </p>
                            </div>
                            <!-- Checkmark Icon (Hidden by default) -->
                            <div
                                class="check-icon hidden w-8 h-8 bg-teal-500 rounded-full items-center justify-center text-white shadow-lg shadow-teal-500/30 transform scale-0 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="mt-5 flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-500 border border-gray-100">
                                ⏱ {{ $service->duration_minutes }} min
                            </span>
                            <span class="text-xl font-bold text-teal-600">${{ $service->price }}</span>
                        </div>
                    </div>
                    <!-- Active Border Overlay -->
                    <div
                        class="absolute inset-0 border-2 border-teal-500 rounded-2xl opacity-0 pointer-events-none transition-opacity duration-200 active-border">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Stylist Selection -->
        <div class="mb-12">
            <h3 class="text-xl font-bold text-gray-900 mb-6">¿Preferencia de Estilista?</h3>
            <p class="text-sm text-gray-500 mb-6 -mt-4">Selecciona un profesional o permite que te asignemos el mejor
                disponible.</p>

            <div class="flex gap-6 overflow-x-auto pb-6 pt-2 custom-scrollbar">
                <!-- Any Stylist Option -->
                <div class="flex flex-col items-center flex-shrink-0 cursor-pointer group"
                    onclick="selectCard(this, 'stylist', 0)">
                    <div
                        class="w-20 h-20 rounded-full bg-gray-50 border-2 border-gray-200 flex items-center justify-center text-gray-400 group-hover:border-teal-400 group-hover:text-teal-500 transition-all duration-300 relative overflow-hidden stylist-avatar">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                        <!-- Active Ring -->
                        <div
                            class="absolute inset-0 border-2 border-teal-500 rounded-full opacity-0 scale-110 active-ring transition-all">
                        </div>
                    </div>
                    <span
                        class="mt-3 text-sm font-bold text-gray-400 group-hover:text-teal-600 transition-colors text-center w-24 leading-tight">Cualquiera<br>Disponible</span>
                </div>

                <!-- Real Stylists (Mock Data Loop) -->
            <!-- Stylist 1 -->
            <div class="flex flex-col items-center flex-shrink-0 cursor-pointer group" onclick="selectCard(this, 'stylist', 1)">
                <div class="w-20 h-20 rounded-full border-2 border-transparent relative stylist-avatar mb-3">
                    <img src="https://i.pravatar.cc/150?img=5" alt="Ana" class="w-full h-full rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300 shadow-sm">
                     <div class="absolute inset-0 border-[3px] border-teal-500 rounded-full opacity-0 scale-105 active-ring transition-all"></div>
                </div>
                <span class="text-sm font-bold text-gray-500 group-hover:text-teal-700 transition-colors">Ana García</span>
                <div class="flex items-center gap-1 mt-1">
                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <span class="text-xs font-medium text-gray-400">4.9</span>
                </div>
            </div>
            
             <!-- Stylist 2 -->
             <div class="flex flex-col items-center flex-shrink-0 cursor-pointer group" onclick="selectCard(this, 'stylist', 2)">
                <div class="w-20 h-20 rounded-full border-2 border-transparent relative stylist-avatar mb-3">
                   <img src="https://i.pravatar.cc/150?img=11" alt="Carlos" class="w-full h-full rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300 shadow-sm">
                   <div class="absolute inset-0 border-[3px] border-teal-500 rounded-full opacity-0 scale-105 active-ring transition-all"></div>
                </div>
                <span class="text-sm font-bold text-gray-500 group-hover:text-teal-700 transition-colors">Carlos Ruiz</span>
                <div class="flex items-center gap-1 mt-1">
                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <span class="text-xs font-medium text-gray-400">4.8</span>
                </div>
            </div>

             <!-- Stylist 3 -->
             <div class="flex flex-col items-center flex-shrink-0 cursor-pointer group" onclick="selectCard(this, 'stylist', 3)">
                <div class="w-20 h-20 rounded-full border-2 border-transparent relative stylist-avatar mb-3">
                   <img src="https://i.pravatar.cc/150?img=9" alt="Elena" class="w-full h-full rounded-full object-cover grayscale group-hover:grayscale-0 transition-all duration-300 shadow-sm">
                   <div class="absolute inset-0 border-[3px] border-teal-500 rounded-full opacity-0 scale-105 active-ring transition-all"></div>
                </div>
                <span class="text-sm font-bold text-gray-500 group-hover:text-teal-700 transition-colors">Elena V.</span>
                <div class="flex items-center gap-1 mt-1">
                    <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    <span class="text-xs font-medium text-gray-400">5.0</span>
                </div>
            </div>            
            </div>
        </div>

        <!-- Continue Wrapper -->
        <div
            class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 p-4 sm:static sm:bg-transparent sm:border-0 sm:p-0 z-40">
            <div class="max-w-3xl mx-auto flex justify-end">
                <a id="continueBtn" href="#"
                    class="bg-teal-500 hover:bg-teal-600 text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg shadow-teal-500/30 opacity-50 cursor-not-allowed pointer-events-none flex items-center transform active:scale-95 w-full sm:w-auto justify-center sm:justify-start">
                    Siguiente
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        let selectedServiceId = null;
        let selectedStylistId = null;

        function selectCard(element, group, id) {
            if (group === 'service') {
                selectedServiceId = id;
                // Deselect all services
                document.querySelectorAll('[onclick*="service"]').forEach(el => {
                    el.classList.remove('ring-2', 'ring-teal-500', 'bg-teal-50/30');
                    el.querySelector('.active-border').classList.add('opacity-0');
                    el.querySelector('.check-icon').classList.add('hidden', 'scale-0');
                    el.querySelector('.check-icon').classList.remove('flex', 'scale-100');
                });

                // Select clicked
                element.classList.add('bg-teal-50/30');
                element.querySelector('.active-border').classList.remove('opacity-0');
                const check = element.querySelector('.check-icon');
                check.classList.remove('hidden', 'scale-0');
                check.classList.add('flex', 'scale-100');
            }

            if (group === 'stylist') {
                selectedStylistId = id;
                // Deselect all stylists
                document.querySelectorAll('[onclick*="stylist"]').forEach(el => {
                    const ring = el.querySelector('.active-ring');
                    const name = el.querySelector('span');
                    if (ring) ring.classList.add('opacity-0', 'scale-110');
                    name.classList.remove('text-teal-700', 'font-bold');
                    name.classList.add('text-gray-600');
                    // Grayscale handling
                    const img = el.querySelector('img');
                    if (img) img.classList.add('grayscale');
                });

                // Select clicked
                const ring = element.querySelector('.active-ring');
                const name = element.querySelector('span');

                if (ring) ring.classList.remove('opacity-0');
                name.classList.add('text-teal-700', 'font-bold');
                name.classList.remove('text-gray-600');

                const img = element.querySelector('img');
                if (img) img.classList.remove('grayscale');
            }

            updateLink();
        }

        function updateLink() {
            const btn = document.getElementById('continueBtn');
            if (selectedServiceId) {
                btn.classList.remove('opacity-50', 'cursor-not-allowed', 'pointer-events-none');
                let url = "{{ route('booking.step2') }}?service_id=" + selectedServiceId;
                if (selectedStylistId !== null) url += "&stylist_id=" + selectedStylistId;
                btn.href = url;
            }
        }
    </script>

    <style>
        /* Hide scrollbar for clean horizontal scroll */
        .custom-scrollbar::-webkit-scrollbar {
            height: 0px;
            background: transparent;
        }
    </style>
@endsection