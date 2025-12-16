<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estilista - Lumina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800" x-data="{ openModal: false, selectedAppointment: null }">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Lumina Logo" class="w-10 h-10 object-contain">
                <div>
                    <h1 class="text-xl font-bold text-gray-900 leading-tight">Panel de Estilista</h1>
                    <p class="text-xs text-gray-500">Gestión operativa y cierre de ventas</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="bg-white border border-gray-200 rounded-lg px-4 py-2 flex items-center gap-2 shadow-sm">
                    <span class="text-sm text-gray-500">Hoy:</span>
                    <span class="font-bold text-gray-900">{{ now()->translatedFormat('d M, Y') }}</span>
                </div>

                <!-- User Profile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-3 hover:bg-gray-50 rounded-xl px-2 py-1 transition">
                        <div
                            class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold border-2 border-white shadow-sm">
                            {{ substr(auth()->user()->name ?? 'Estilista', 0, 1) }}
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Cerrar
                                Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6">

        <!-- Cards Grid (Today's Focus) -->
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Citas de Hoy</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($todayAppointments as $apt)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col transition hover:shadow-md">
                        <div class="p-6 flex-1">
                            <div class="flex items-start gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center overflow-hidden">
                                    @if($apt->client && $apt->client->profile_photo_url)
                                        <img src="{{ $apt->client->profile_photo_url }}" class="w-full h-full object-cover">
                                    @else
                                        <span
                                            class="text-slate-500 font-bold text-lg">{{ substr($apt->client->name ?? 'C', 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-gray-900">{{ $apt->client->name ?? 'Cliente' }}</h3>
                                    <div class="flex items-center gap-1 text-sm text-gray-500">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $apt->start_time->format('H:i') }}
                                    </div>
                                </div>
                            </div>

                            <div class="bg-slate-50 rounded-lg p-3 mb-4">
                                <div class="flex justify-between items-start">
                                    <p class="text-sm font-medium text-gray-700">{{ $apt->service->name ?? 'Servicio' }}</p>
                                    <span class="text-teal-600 font-bold text-sm">S/{{ number_format($apt->price, 2) }}</span>
                                </div>
                                @if($apt->notes)
                                    <p class="text-xs text-gray-500 mt-1 italic">"{{ Str::limit($apt->notes, 50) }}"</p>
                                @endif
                            </div>

                            <!-- Payment Status Badge -->
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-xs px-2 py-1 rounded-full font-medium
                                        {{ $apt->payment_status === 'paid' ? 'bg-green-100 text-green-700' :
                ($apt->payment_status === 'deposit' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                    @if($apt->payment_status === 'paid')
                                        ✓ Pagado
                                    @elseif($apt->payment_status === 'deposit')
                                        ⏳ Depósito: S/{{ number_format($apt->deposit_amount, 2) }}
                                    @else
                                        ⚠️ Sin depósito
                                    @endif
                                </span>
                                @if($apt->payment_status !== 'paid' && $apt->deposit_amount)
                                    <span class="text-xs text-gray-500">Pendiente:
                                        S/{{ number_format($apt->price - ($apt->payment_status === 'deposit' ? $apt->deposit_amount : 0), 2) }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-4 bg-gray-50 border-t border-gray-100">
                            @if($apt->status === 'Completed')
                                <button disabled
                                    class="w-full py-2.5 rounded-lg bg-green-100 text-green-700 font-medium text-sm flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                        </path>
                                    </svg>
                                    Completado
                                </button>
                            @elseif($apt->status === 'Cancelled')
                                <span class="block text-center text-sm text-red-500 py-2">Cancelado</span>
                            @else
                                <button @click="selectedAppointment = {{ $apt->id }}; openModal = true"
                                    class="w-full py-2.5 rounded-lg bg-slate-900 hover:bg-slate-800 text-white font-medium text-sm transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Finalizar Servicio
                                </button>
                            @endif
                        </div>
                    </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300">
                    <p class="text-gray-500">No tienes citas programadas para hoy.</p>
                </div>
            @endforelse
        </div>

        <!-- Section 2: Weekly Grid (Collapsed or below) -->
        <h2 class="text-lg font-semibold text-gray-900 mb-6">Calendario Semanal</h2>
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
            <div class="grid grid-cols-7 border-b border-gray-200 bg-gray-50">
                @foreach(['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'] as $day)
                    <div class="p-3 text-center text-xs font-semibold text-gray-500 uppercase">{{ $day }}</div>
                @endforeach
            </div>
            <div class="grid grid-cols-7 divide-x divide-gray-100">
                @php
                    $startOfWeek = now()->startOfWeek();
                @endphp
                @for($i = 0; $i < 7; $i++)
                    @php $currentDay = $startOfWeek->copy()->addDays($i); @endphp
                    <div class="min-h-[150px] p-2 {{ $currentDay->isToday() ? 'bg-teal-50/20' : '' }}">
                        <p
                            class="text-center text-sm mb-2 {{ $currentDay->isToday() ? 'font-bold text-teal-600' : 'text-gray-400' }}">
                            {{ $currentDay->format('d') }}
                        </p>
                        @foreach($appointments as $wApt)
                            @if($wApt->start_time->isSameDay($currentDay))
                                <div
                                    class="text-[10px] p-1 mb-1 rounded {{ $wApt->status == 'Confirmed' ? 'bg-teal-100 text-teal-800' : ($wApt->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $wApt->start_time->format('H:i') }} - {{ $wApt->client->name }}
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endfor
            </div>
        </div>

    </main>

    <!-- Modal Finalizar Cita -->
    <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="openModal = false"></div>

        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl max-w-2xl w-full p-0 shadow-2xl transform transition-all overflow-hidden"
                @click.stop>

                <!-- Modal Header -->
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Finalizar Cita</h2>
                        <p class="text-sm text-gray-500">Selecciona los productos vendidos</p>
                    </div>
                    <button @click="openModal = false"
                        class="text-gray-400 hover:text-gray-600 transition p-2 hover:bg-gray-100 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form x-bind:action="'/stylist/appointments/' + selectedAppointment + '/complete'" method="POST"
                    class="p-6">
                    @csrf

                    <!-- Search Product -->
                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text"
                            class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition shadow-sm placeholder-gray-400"
                            placeholder="Buscar producto por nombre..." x-model="searchQuery">
                    </div>

                    <!-- Product Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar"
                        x-data="{ searchQuery: '' }">
                        @foreach($products as $product)
                            <div class="flex items-center p-3 border border-gray-200 rounded-xl hover:border-teal-500 hover:shadow-md transition group bg-white"
                                x-data="{ count: 0 }"
                                x-show="searchQuery === '' || '{{ strtolower($product->name) }}'.includes(searchQuery.toLowerCase())">

                                <!-- Image with Fallback -->
                                <div
                                    class="w-16 h-16 rounded-lg bg-gray-100 flex-shrink-0 overflow-hidden border border-gray-100 relative">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="ml-4 flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 truncate pr-2">{{ $product->name }}</h4>
                                    <div class="flex justify-between items-center mt-1">
                                        <p class="text-xs text-gray-500 font-medium">Stock: {{ $product->stock_quantity }}
                                        </p>
                                        <p class="text-xs font-bold text-teal-600">S/{{ number_format($product->price, 2) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Counter -->
                                <div
                                    class="flex flex-col items-center gap-1 ml-2 bg-gray-50 p-1 rounded-lg border border-gray-100">
                                    <button type="button" @click="if(count < {{ $product->stock_quantity }}) count++"
                                        class="w-6 h-6 rounded bg-white hover:bg-teal-50 border border-gray-200 flex items-center justify-center text-teal-600 font-bold shadow-sm transition disabled:opacity-50"
                                        :disabled="count >= {{ $product->stock_quantity }}">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    </button>
                                    <span class="text-sm font-bold w-5 text-center text-gray-900" x-text="count">0</span>
                                    <button type="button" @click="if(count>0) count--"
                                        class="w-6 h-6 rounded bg-white hover:bg-red-50 border border-gray-200 flex items-center justify-center text-gray-500 font-bold shadow-sm transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <input type="hidden" :name="'products[{{ $product->id }}]'" :value="count">
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-end gap-3 pt-6 mt-2 border-t border-gray-100">
                        <button type="button" @click="openModal = false"
                            class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition">Cancelar</button>
                        <button type="submit"
                            class="px-6 py-2.5 text-sm font-bold text-white bg-gray-900 hover:bg-gray-800 rounded-xl flex items-center gap-2 shadow-lg shadow-gray-900/20 transform transition active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Confirmar y Finalizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
    </style>

</body>

</html>