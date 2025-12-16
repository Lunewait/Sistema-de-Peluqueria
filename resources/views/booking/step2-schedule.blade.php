@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-4xl mx-auto px-6 py-10">

            <!-- Progress Steps - Premium Style -->
            <div class="flex items-center justify-center mb-12">
                <div class="flex items-center gap-4">
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 rounded-full bg-teal-600 text-white flex items-center justify-center shadow-lg shadow-teal-600/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <span class="text-teal-600 text-xs font-semibold mt-2 uppercase tracking-wider">Servicios</span>
                    </div>
                    <div class="w-20 h-1 bg-teal-600 rounded-full"></div>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-teal-600/30">
                            2
                        </div>
                        <span class="text-teal-600 text-xs font-semibold mt-2 uppercase tracking-wider">Agenda</span>
                    </div>
                    <div class="w-20 h-1 bg-gray-200 rounded-full"></div>
                    <div class="flex flex-col items-center">
                        <div
                            class="w-12 h-12 rounded-full bg-gray-200 text-gray-400 flex items-center justify-center font-bold text-lg">
                            3
                        </div>
                        <span class="text-gray-400 text-xs font-semibold mt-2 uppercase tracking-wider">Pago</span>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100">

                <!-- Header -->
                <div class="bg-gradient-to-r from-slate-900 to-slate-800 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white mb-1">Elige el Momento Perfecto</h2>
                    <p class="text-slate-400 text-sm">Selecciona la fecha y hora que mejor se ajuste a tu agenda</p>
                </div>

                <div class="p-8">
                    <!-- Date Selection -->
                    <div class="mb-10">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Fecha</h3>
                        </div>

                        <div id="daysContainer"
                            class="flex gap-3 overflow-x-auto pb-4 custom-scrollbar snap-x scroll-smooth">
                            <!-- JavaScript will inject days here -->
                        </div>
                    </div>

                    <!-- Time Slots -->
                    <div id="timeSection" class="transition-all duration-500 opacity-30 pointer-events-none">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 bg-teal-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Hora Disponible</h3>
                        </div>

                        <div id="slotsContainer" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3">
                            <!-- JavaScript will inject slots here -->
                        </div>

                        <!-- Legend -->
                        <div class="flex items-center gap-6 mt-6 pt-6 border-t border-gray-100">
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded bg-white border-2 border-gray-200"></div>
                                <span class="text-xs text-gray-500">Disponible</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded bg-teal-500"></div>
                                <span class="text-xs text-gray-500">Seleccionado</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded bg-gray-100"></div>
                                <span class="text-xs text-gray-500">No disponible</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="bg-gray-50 px-8 py-6 flex justify-between items-center border-t border-gray-100">
                    <button onclick="history.back()"
                        class="flex items-center gap-2 text-gray-500 hover:text-gray-700 font-medium transition-colors group">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </button>

                    <button id="continueBtn"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3.5 rounded-xl transition-all shadow-lg shadow-teal-600/30 opacity-50 cursor-not-allowed flex items-center gap-2 group disabled:transform-none hover:scale-[1.02]">
                        Continuar
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Selected Summary (appears when both selected) -->
            <div id="selectionSummary" class="hidden mt-6 bg-teal-50 border border-teal-200 rounded-2xl p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-teal-700 font-medium">Tu cita será:</p>
                            <p id="summaryText" class="text-lg font-bold text-gray-900"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const serviceId = "{{ $serviceId }}";
        const stylistId = "{{ $stylistId ?? '' }}";

        let selectedDate = null;
        let selectedTime = null;

        // Generate Next 14 Days
        const daysContainer = document.getElementById('daysContainer');
        const today = new Date();
        const monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        const dayNames = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];

        for (let i = 0; i < 14; i++) {
            const d = new Date(today);
            d.setDate(today.getDate() + i);
            const dateStr = d.toISOString().split('T')[0];
            const dayName = dayNames[d.getDay()];
            const dayNum = d.getDate();
            const monthName = monthNames[d.getMonth()];
            const isToday = i === 0;

            const btn = document.createElement('button');
            btn.className = `day-btn flex flex-col items-center justify-center min-w-[85px] h-[100px] rounded-2xl border-2 transition-all duration-300 bg-white border-gray-200 hover:border-teal-400 hover:shadow-lg snap-start relative overflow-hidden group`;
            btn.onclick = () => selectDate(dateStr, btn, dayName, dayNum, monthName);
            btn.innerHTML = `
                    ${isToday ? '<span class="absolute top-2 right-2 text-[10px] font-bold text-teal-600 bg-teal-100 px-1.5 py-0.5 rounded">HOY</span>' : ''}
                    <span class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-1">${dayName}</span>
                    <span class="text-3xl font-bold text-gray-800 group-hover:text-teal-600 transition-colors">${dayNum}</span>
                    <span class="text-xs font-medium text-gray-400">${monthName}</span>
                `;
            daysContainer.appendChild(btn);
        }

        // Generate Time Slots
        const generateSlots = () => {
            const slots = [];
            const times = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00'];
            times.forEach(t => {
                let isAvailable = Math.random() > 0.25;
                slots.push({ time: t, available: isAvailable });
            });
            return slots;
        };

        function selectDate(dateStr, btnElement, dayName, dayNum, monthName) {
            selectedDate = dateStr;
            selectedTime = null;
            updateUI();

            // UI Updates for Date
            document.querySelectorAll('.day-btn').forEach(b => {
                b.className = `day-btn flex flex-col items-center justify-center min-w-[85px] h-[100px] rounded-2xl border-2 transition-all duration-300 bg-white border-gray-200 hover:border-teal-400 hover:shadow-lg snap-start relative overflow-hidden group`;
            });

            btnElement.className = `day-btn flex flex-col items-center justify-center min-w-[85px] h-[100px] rounded-2xl border-2 transition-all duration-300 bg-teal-600 border-teal-600 text-white shadow-xl shadow-teal-600/40 scale-105 snap-start relative overflow-hidden`;
            btnElement.innerHTML = `
                    <span class="text-xs font-medium text-teal-200 uppercase tracking-wider mb-1">${dayName}</span>
                    <span class="text-3xl font-bold text-white">${dayNum}</span>
                    <span class="text-xs font-medium text-teal-200">${monthName}</span>
                `;

            // Show Time Section
            const timeSection = document.getElementById('timeSection');
            timeSection.classList.remove('opacity-30', 'pointer-events-none');

            renderSlots();
        }

        function renderSlots() {
            const container = document.getElementById('slotsContainer');
            container.innerHTML = '';

            const slots = generateSlots();

            slots.forEach(slot => {
                const btn = document.createElement('button');
                btn.disabled = !slot.available;

                if (!slot.available) {
                    btn.className = "py-3 px-4 rounded-xl text-sm font-semibold bg-gray-100 text-gray-400 cursor-not-allowed line-through transition-all";
                } else {
                    btn.className = "time-btn py-3 px-4 rounded-xl text-sm font-bold border-2 border-gray-200 text-gray-700 hover:border-teal-500 hover:text-teal-600 hover:shadow-md transition-all bg-white";
                    btn.onclick = () => selectTime(slot.time, btn);
                }

                btn.textContent = slot.time;
                container.appendChild(btn);
            });
        }

        function selectTime(time, btnElement) {
            selectedTime = time;

            document.querySelectorAll('.time-btn').forEach(b => {
                b.className = "time-btn py-3 px-4 rounded-xl text-sm font-bold border-2 border-gray-200 text-gray-700 hover:border-teal-500 hover:text-teal-600 hover:shadow-md transition-all bg-white";
            });

            btnElement.className = "time-btn py-3 px-4 rounded-xl text-sm font-bold border-2 bg-teal-600 border-teal-600 text-white shadow-lg shadow-teal-600/30 scale-105 transition-all";

            updateUI();
        }

        function updateUI() {
            const btn = document.getElementById('continueBtn');
            const summary = document.getElementById('selectionSummary');
            const summaryText = document.getElementById('summaryText');

            if (selectedDate && selectedTime) {
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
                btn.disabled = false;

                // Show summary
                const dateObj = new Date(selectedDate + 'T00:00:00');
                const options = { weekday: 'long', day: 'numeric', month: 'long' };
                const formattedDate = dateObj.toLocaleDateString('es-ES', options);
                summaryText.textContent = `${formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1)}, ${selectedTime}`;
                summary.classList.remove('hidden');

                const url = `{{ route('booking.step3') }}?service_id=${serviceId}&stylist_id=${stylistId}&date=${selectedDate}&time=${selectedTime}`;
                btn.onclick = () => window.location.href = url;
            } else {
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                btn.disabled = true;
                summary.classList.add('hidden');
                btn.onclick = null;
            }
        }
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(to right, #14b8a6, #0d9488);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(to right, #0d9488, #0f766e);
        }
    </style>
@endsection