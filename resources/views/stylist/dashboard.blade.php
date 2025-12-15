<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Agenda - Lumina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .appointment-block { min-height: 60px; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-full mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-3">
                    <img src="/images/logo.png" alt="Lumina Logo" class="w-10 h-10 object-contain">
                    <span class="text-lg font-bold text-gray-900">Lumina<span class="text-gray-400 font-normal">Manager</span></span>
                </div>
                <nav class="hidden md:flex items-center gap-6">
                    <a href="#" class="text-teal-600 font-medium border-b-2 border-teal-600 pb-1">Calendario</a>
                    <a href="#" class="text-gray-500 hover:text-teal-600 transition">Clientes</a>
                    <a href="#" class="text-gray-500 hover:text-teal-600 transition">Servicios</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-teal-600 transition" title="Ir a la web">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                </a>
                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button onclick="toggleDropdown()" class="flex items-center gap-3 hover:bg-gray-50 rounded-xl px-3 py-2 transition">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-semibold text-sm">
                            {{ substr(auth()->user()->name ?? 'U', 0, 2) }}
                        </div>
                        <span class="text-gray-700 font-medium hidden sm:block">{{ auth()->user()->name ?? 'Usuario' }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name ?? 'Usuario' }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Mi Perfil</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Configuración</a>
                        <div class="border-t border-gray-100 mt-2 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="flex">
        <!-- Main Calendar Area -->
        <main class="flex-1 p-6">
            <!-- Calendar Header -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center gap-4">
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                    </h1>
                    <div class="flex items-center gap-1">
                        <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button class="px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition">Hoy</button>
                        <button class="p-2 hover:bg-gray-100 rounded-lg transition">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <select class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 bg-white focus:border-teal-500 focus:ring-1 focus:ring-teal-500 outline-none">
                        <option>Vista Diaria</option>
                        <option selected>Vista Semanal</option>
                        <option>Vista Mensual</option>
                    </select>
                    <button class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nueva Cita
                    </button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <!-- Days Header -->
                <div class="grid grid-cols-8 border-b border-gray-200">
                    <div class="p-4 text-xs font-medium text-gray-400 uppercase">GMT-5</div>
                    @php
                        $today = \Carbon\Carbon::now();
                        $startOfWeek = $today->copy()->startOfWeek();
                        $days = ['LUN', 'MAR', 'MIÉ', 'JUE', 'VIE', 'SÁB', 'DOM'];
                    @endphp
                    @for($i = 0; $i < 7; $i++)
                        @php $day = $startOfWeek->copy()->addDays($i); @endphp
                        <div class="p-4 text-center {{ $day->isToday() ? 'bg-teal-50' : '' }}">
                            <p class="text-xs font-medium {{ $day->isToday() ? 'text-teal-600' : 'text-gray-400' }} uppercase">{{ $days[$i] }}</p>
                            <p class="text-2xl font-bold {{ $day->isToday() ? 'text-teal-600' : 'text-gray-900' }}">{{ $day->format('d') }}</p>
                        </div>
                    @endfor
                </div>

                <!-- Time Slots -->
                <div class="overflow-y-auto" style="max-height: 500px;">
                    @for($hour = 9; $hour <= 18; $hour++)
                        <div class="grid grid-cols-8 border-b border-gray-100">
                            <div class="p-4 text-xs text-gray-400 text-right pr-4">
                                {{ $hour < 12 ? $hour . ' AM' : ($hour == 12 ? '12 PM' : ($hour - 12) . ' PM') }}
                            </div>
                            @for($d = 0; $d < 7; $d++)
                                @php 
                                    $dayDate = $startOfWeek->copy()->addDays($d);
                                    $dayAppointments = $appointments->filter(function($apt) use ($hour, $dayDate) {
                                        return $apt->start_time->format('Y-m-d') == $dayDate->format('Y-m-d') 
                                               && $apt->start_time->format('G') == $hour;
                                    });
                                @endphp
                                <div class="border-l border-gray-100 min-h-[60px] p-1 {{ $dayDate->isToday() ? 'bg-teal-50/30' : '' }}">
                                    @foreach($dayAppointments as $apt)
                                        @php
                                            $colors = [
                                                'Confirmed' => 'bg-teal-100 border-teal-400 text-teal-800',
                                                'Pending' => 'bg-amber-100 border-amber-400 text-amber-800',
                                                'Completed' => 'bg-green-100 border-green-400 text-green-800',
                                            ];
                                            $color = $colors[$apt->status] ?? 'bg-gray-100 border-gray-400 text-gray-800';
                                        @endphp
                                        <div class="appointment-block rounded-lg border-l-4 {{ $color }} p-2 text-xs cursor-pointer hover:shadow-md transition">
                                            <p class="font-semibold truncate">{{ $apt->client->name ?? 'Cliente' }}</p>
                                            <p class="text-[10px] opacity-75 truncate">{{ $apt->service->name ?? 'Servicio' }}</p>
                                            <p class="text-[10px] opacity-60">{{ $apt->start_time->format('H:i') }} - {{ $apt->end_time->format('H:i') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                    @endfor
                </div>
            </div>
        </main>

        <!-- Right Sidebar: Agenda de Hoy -->
        <aside class="w-80 bg-white border-l border-gray-200 p-6 hidden lg:block">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-900 mb-1">Agenda de Hoy</h2>
                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->translatedFormat('l, d \d\e F') }}</p>
            </div>

            <!-- Today's Appointments -->
            <div class="space-y-4 mb-8">
                @forelse($todayAppointments as $apt)
                    <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition cursor-pointer">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-sm font-medium text-gray-900">{{ $apt->start_time->format('H:i') }}</span>
                            @if($apt->status == 'Confirmed' && $apt->start_time->diffInMinutes(now()) <= 60 && $apt->start_time > now())
                                <span class="text-xs font-medium text-teal-600 bg-teal-50 px-2 py-0.5 rounded-full">En Curso</span>
                            @endif
                        </div>
                        <h4 class="font-semibold text-gray-900">{{ $apt->client->name ?? 'Cliente' }}</h4>
                        <p class="text-sm text-gray-500">{{ $apt->service->name ?? 'Servicio' }}</p>
                        @if($apt->notes)
                            <p class="text-xs text-gray-400 mt-2 italic">{{ $apt->notes }}</p>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-10">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <p class="text-gray-500">Sin citas para hoy</p>
                    </div>
                @endforelse
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100">
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">{{ $todayAppointments->count() }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Citas Hoy</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-teal-600">{{ $todayAppointments->count() > 0 ? round(($todayAppointments->where('status', 'Confirmed')->count() / max($todayAppointments->count(), 1)) * 100) : 0 }}%</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Confirmadas</p>
                </div>
            </div>
        </aside>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const button = e.target.closest('button');
            if (!button && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>