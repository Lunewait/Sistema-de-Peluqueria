@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">
        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between text-sm font-medium text-gray-400 mb-2">
                <span>Servicios</span>
                <span class="text-teal-600">Horario</span>
                <span>Confirmar</span>
            </div>
            <div class="h-1 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-teal-500 w-2/3 transition-all duration-500"></div>
            </div>
        </div>

        <!-- Step Heading -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">2. Elige el Momento</h2>
            <p class="text-gray-500">Selecciona la fecha ideal para tu visita.</p>
        </div>

        <div class="space-y-8 animate-fade-in">
            <!-- Date Selection (Dynamic) -->
            <div>
                <div id="daysContainer" class="flex gap-4 overflow-x-auto pb-4 custom-scrollbar snap-x">
                    <!-- Javascript will inject days here -->
                </div>
            </div>

            <!-- Time Slots -->
            <div id="timeSection" class="transition-all duration-500 opacity-40 pointer-events-none">
                <div class="flex items-center gap-2 mb-4">
                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700">Horarios Disponibles</h3>
                </div>

                <div id="slotsContainer" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                    <!-- Javascript will inject slots here -->
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-12 pt-6 border-t border-gray-100">
            <button onclick="history.back()"
                class="text-gray-500 hover:text-gray-700 font-medium px-6 py-3 rounded-xl transition-colors">
                Atrás
            </button>
            <button id="continueBtn"
                class="bg-teal-500 hover:bg-teal-600 text-white font-bold px-8 py-3 rounded-xl transition-all shadow-lg shadow-teal-500/30 opacity-50 cursor-not-allowed transform active:scale-95">
                Continuar
            </button>
        </div>
    </div>

    <script>
        // --- Logic inspired by Lumina React Prototype ---

        // PHP Params
        const serviceId = "{{ $serviceId }}";
        const stylistId = "{{ $stylistId }}";

        // State
        let selectedDate = null;
        let selectedTime = null;

        // 1. Generate Next 14 Days
        const daysContainer = document.getElementById('daysContainer');
        const today = new Date();
        const days = [];

        for (let i = 0; i < 14; i++) {
            const d = new Date(today);
            d.setDate(today.getDate() + i);
            days.push(d);
        }

        days.forEach(d => {
            const dateStr = d.toISOString().split('T')[0];
            const dayName = d.toLocaleDateString('es-ES', { weekday: 'short' });
            const dayNum = d.getDate();

            const btn = document.createElement('button');
            btn.className = `flex flex-col items-center justify-center min-w-[80px] h-24 rounded-2xl border transition-all duration-200 bg-white border-gray-200 text-gray-600 hover:border-teal-300 hover:bg-teal-50 snap-start`;
            btn.onclick = () => selectDate(dateStr, btn);
            btn.innerHTML = `
                <span class="text-xs font-medium uppercase tracking-wider opacity-80">${dayName}</span>
                <span class="text-2xl font-bold">${dayNum}</span>
            `;
            daysContainer.appendChild(btn);
        });

        // 2. Mock Time Slots Generator
        const generateSlots = () => {
            const slots = [];
            const times = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];

            times.forEach(t => {
                // Randomly assign availability
                let isAvailable = Math.random() > 0.3;

                slots.push({ time: t, available: isAvailable });
            });
            return slots;
        };

        // 3. Interactions
        function selectDate(dateStr, btnElement) {
            selectedDate = dateStr;
            selectedTime = null; // Reset time
            updateContinueLink();

            // UI Updates for Date
            // Reset all
            Array.from(daysContainer.children).forEach(b => {
                b.className = `flex flex-col items-center justify-center min-w-[80px] h-24 rounded-2xl border transition-all duration-200 bg-white border-gray-200 text-gray-600 hover:border-teal-300 hover:bg-teal-50 snap-start`;
            });
            // Highlight selected
            btnElement.className = `flex flex-col items-center justify-center min-w-[80px] h-24 rounded-2xl border transition-all duration-200 bg-teal-500 border-teal-500 text-white shadow-lg shadow-teal-500/30 transform scale-105 snap-start`;

            // Show Time Section
            const timeSection = document.getElementById('timeSection');
            timeSection.classList.remove('opacity-40', 'pointer-events-none');

            // Render Slots
            renderSlots();
        }

        function renderSlots() {
            const container = document.getElementById('slotsContainer');
            container.innerHTML = ''; // Clear

            // In "Lumina" logic, slots are clean objects
            const slots = generateSlots();

            slots.forEach(slot => {
                const btn = document.createElement('button');
                btn.disabled = !slot.available;

                let baseClasses = "py-2 px-4 rounded-xl text-sm font-semibold transition-all duration-200";
                let stateClasses = "";

                if (!slot.available) {
                    stateClasses = "bg-gray-100 text-gray-400 cursor-not-allowed line-through decoration-gray-300";
                } else {
                    stateClasses = "bg-white border border-gray-200 text-gray-700 hover:border-teal-400 hover:text-teal-600 slot-btn";
                    btn.onclick = () => selectTime(slot.time, btn);
                }

                btn.className = `${baseClasses} ${stateClasses}`;
                btn.textContent = slot.time;

                container.appendChild(btn);
            });
        }

        function selectTime(time, btnElement) {
            selectedTime = time;

            // UI Updates for Time
            document.querySelectorAll('.slot-btn').forEach(b => {
                b.className = "py-2 px-4 rounded-xl text-sm font-semibold transition-all duration-200 bg-white border border-gray-200 text-gray-700 hover:border-teal-400 hover:text-teal-600 slot-btn";
            });

            btnElement.className = "py-2 px-4 rounded-xl text-sm font-semibold transition-all duration-200 bg-teal-500 text-white shadow-md transform scale-105 slot-btn";

            updateContinueLink();
        }

        function updateContinueLink() {
            const btn = document.getElementById('continueBtn');
            if (selectedDate && selectedTime) {
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
                // Using query params to pass data
                const url = `{{ route('booking.step3') }}?service_id=${serviceId}&stylist_id=${stylistId}&date=${selectedDate}&time=${selectedTime}`;
                btn.onclick = () => window.location.href = url;
            } else {
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                btn.onclick = null;
            }
        }
    </script>

    <style>
        /* Custom Scrollbar for horizontal scrolling */
        .custom-scrollbar::-webkit-scrollbar {
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection