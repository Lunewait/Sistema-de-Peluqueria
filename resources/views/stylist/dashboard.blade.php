<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylist Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        accent: '#06B6D4',
                        'accent-light': '#ECFEFF',
                        'accent-hover': '#0891b2',
                    }
                }
            }
        }
    </script>
    <style>
        /* Hide scrollbar for cleaner look */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: 60px repeat(7, 1fr);
            grid-template-rows: 50px repeat(11, 80px);
            /* 11 hours: 9am - 7pm */
        }

        .event-card {
            transition: all 0.2s ease;
        }

        .event-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex flex-col overflow-hidden">

    <!-- Top Navigation -->
    <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 flex-shrink-0 z-10">
        <div class="flex items-center space-x-4">
            <h1 class="text-xl font-bold text-gray-800 tracking-tight">Salon<span class="text-accent">Manager</span>
            </h1>
            <div class="h-6 w-px bg-gray-200 mx-2"></div>
            <nav class="flex space-x-4 text-sm font-medium text-gray-500">
                <a href="#" class="text-gray-900 border-b-2 border-accent px-1 py-5">Calendario</a>
                <a href="#" class="hover:text-gray-900 px-1 py-5 transition-colors">Clientes</a>
                <a href="#" class="hover:text-gray-900 px-1 py-5 transition-colors">Servicios</a>
            </nav>
        </div>
        <div class="flex items-center space-x-4">
            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-full hover:bg-gray-100 relative">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
                <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
            </button>
            <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                <img src="https://ui-avatars.com/api/?name=Ana+Martinez&background=06B6D4&color=fff"
                    class="w-8 h-8 rounded-full" alt="Profile">
                <span class="text-sm font-medium text-gray-700">Ana Martínez</span>
            </div>
        </div>
    </header>

    <!-- Main Content Grid -->
    <div class="flex-1 flex overflow-hidden">

        <!-- Main Calendar Area (Left) -->
        <main
            class="flex-1 flex flex-col min-w-0 bg-white shadow-sm m-4 rounded-xl border border-gray-200 overflow-hidden">

            <!-- Calendar Toolbar -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
                <div class="flex items-center space-x-4">
                    <h2 class="text-lg font-semibold text-gray-900">Diciembre 2024</h2>
                    <div class="flex items-center bg-gray-100 rounded-lg p-1">
                        <button class="p-1 hover:bg-white rounded shadow-sm text-gray-600 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button class="px-3 py-1 text-xs font-medium text-gray-600">Hoy</button>
                        <button class="p-1 hover:bg-white rounded shadow-sm text-gray-600 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <select
                        class="text-sm border-none bg-gray-50 rounded-lg px-3 py-2 text-gray-600 focus:ring-0 cursor-pointer">
                        <option>Vista Semanal</option>
                        <option>Vista Diaria</option>
                        <option>Vista Mensual</option>
                    </select>
                    <button
                        class="bg-accent hover:bg-accent-hover text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Nueva Cita
                    </button>
                </div>
            </div>

            <!-- Calendar Grid View -->
            <div class="flex-1 overflow-y-auto no-scrollbar relative">
                <div class="calendar-grid w-full">
                    <!-- Header Row: Days -->
                    <div
                        class="sticky top-0 bg-white z-10 border-b border-gray-100 col-span-8 grid grid-cols-[60px_repeat(7,1fr)]">
                        <div class="border-r border-gray-100 p-3 text-xs text-gray-400 font-medium text-center pt-8">
                            GMT-5</div>

                        <div class="p-3 text-center border-r border-gray-50">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Lun</span>
                            <span class="block text-lg text-gray-900 font-semibold">9</span>
                        </div>
                        <div class="p-3 text-center border-r border-gray-50 bg-accent-light/30">
                            <span class="block text-xs text-accent font-bold uppercase mb-1">Mar</span>
                            <span
                                class="block text-lg text-accent font-bold h-8 w-8 rounded-full bg-accent-light mx-auto flex items-center justify-center">10</span>
                        </div>
                        <div class="p-3 text-center border-r border-gray-50">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Mié</span>
                            <span class="block text-lg text-gray-900 font-semibold">11</span>
                        </div>
                        <div class="p-3 text-center border-r border-gray-50">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Jue</span>
                            <span class="block text-lg text-gray-900 font-semibold">12</span>
                        </div>
                        <div class="p-3 text-center border-r border-gray-50">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Vie</span>
                            <span class="block text-lg text-gray-900 font-semibold">13</span>
                        </div>
                        <div class="p-3 text-center border-r border-gray-50">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Sáb</span>
                            <span class="block text-lg text-gray-900 font-semibold">14</span>
                        </div>
                        <div class="p-3 text-center">
                            <span class="block text-xs text-gray-400 font-medium uppercase mb-1">Dom</span>
                            <span class="block text-lg text-gray-900 font-semibold">15</span>
                        </div>
                    </div>

                    <!-- Time Slots & Grid Lines (Background) -->
                    <!-- 9:00 AM -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">9 AM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full"></div> <!-- Mon -->
                        <div class="border-r border-gray-50 h-full relative group"> <!-- Tue -->
                            <!-- Event 1 (Tue 9:30) -->
                            <div
                                class="absolute top-[50%] left-1 right-1 h-[90%] rounded bg-purple-50 border-l-4 border-purple-400 p-1.5 cursor-pointer event-card z-10">
                                <p class="text-xs font-semibold text-purple-900 truncate">Laura S.</p>
                                <p class="text-[10px] text-purple-700 truncate">Corte + Peinado</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full"></div> <!-- Wed -->
                        <div class="border-r border-gray-50 h-full"></div> <!-- Thu -->
                        <div class="border-r border-gray-50 h-full"></div> <!-- Fri -->
                        <div class="border-r border-gray-50 h-full"></div> <!-- Sat -->
                        <div class="h-full"></div> <!-- Sun -->
                    </div>

                    <!-- 10:00 AM -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">10 AM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative"></div>
                        <!-- Tue continues previous event -->
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative">
                            <!-- Event Fri 10:00 -->
                            <div
                                class="absolute top-1 left-1 right-1 h-[180%] rounded bg-pink-50 border-l-4 border-pink-400 p-1.5 cursor-pointer event-card z-10">
                                <p class="text-xs font-semibold text-pink-900 truncate">Sofía M.</p>
                                <p class="text-[10px] text-pink-700 truncate">Coloración</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="h-full"></div>
                    </div>

                    <!-- 11:00 AM -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">11 AM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full relative">
                            <!-- Event Mon 11:00 -->
                            <div
                                class="absolute top-1 left-1 right-1 h-[90%] rounded bg-green-50 border-l-4 border-green-400 p-1.5 cursor-pointer event-card z-10">
                                <p class="text-xs font-semibold text-green-900 truncate">Pedro P.</p>
                                <p class="text-[10px] text-green-700 truncate">Corte Caballero</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full relative">
                            <!-- Current Active Event (Tue 11:00) -->
                            <div
                                class="absolute top-1 left-1 right-1 h-[180%] rounded bg-accent-light border-l-4 border-accent p-1.5 cursor-pointer event-card z-10 shadow-sm ring-2 ring-accent/20">
                                <div class="flex justify-between items-start">
                                    <p class="text-xs font-bold text-gray-900 truncate">Maria García</p>
                                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse"></span>
                                </div>
                                <p class="text-[10px] text-cyan-700 truncate">Coloración Completa</p>
                                <p class="text-[10px] text-cyan-600 mt-1">11:00 - 13:00</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative"></div> <!-- Fri continues -->
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="h-full"></div>
                    </div>

                    <!-- 12:00 PM -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">12 PM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative"></div> <!-- Tue continues -->
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="h-full"></div>
                    </div>

                    <!-- 1:00 PM (Lunch) -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">1 PM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 bg-gray-50/50 grid grid-cols-7 h-20">
                        <!-- Lunch break shading -->
                        <div
                            class="border-r border-gray-100 h-full flex items-center justify-center text-[10px] text-gray-300">
                            Lunch</div>
                        <div class="border-r border-gray-100 h-full"></div>
                        <div class="border-r border-gray-100 h-full"></div>
                        <div class="border-r border-gray-100 h-full"></div>
                        <div class="border-r border-gray-100 h-full"></div>
                        <div class="border-r border-gray-100 h-full"></div>
                        <div class="h-full"></div>
                    </div>

                    <!-- 2:00 PM -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">2 PM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full relative">
                            <!-- Event Mon 2:00 -->
                            <div
                                class="absolute top-1 left-1 right-1 h-[90%] rounded bg-orange-50 border-l-4 border-orange-400 p-1.5 cursor-pointer event-card z-10">
                                <p class="text-xs font-semibold text-orange-900 truncate">Ana R.</p>
                                <p class="text-[10px] text-orange-700 truncate">Manicure</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative">
                            <!-- Event Wed 2:30 -->
                            <div
                                class="absolute top-[50%] left-1 right-1 h-[90%] rounded bg-blue-50 border-l-4 border-blue-400 p-1.5 cursor-pointer event-card z-10">
                                <p class="text-xs font-semibold text-blue-900 truncate">Julia T.</p>
                                <p class="text-[10px] text-blue-700 truncate">Spa Facial</p>
                            </div>
                        </div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="h-full"></div>
                    </div>

                    <!-- More rows... -->
                    <div class="border-r border-gray-100 text-xs text-gray-400 text-center py-2 relative -top-3">3 PM
                    </div>
                    <div class="col-span-7 border-b border-gray-50 grid grid-cols-7 h-20">
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full relative"></div> <!-- Wed continues -->
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="border-r border-gray-50 h-full"></div>
                        <div class="h-full"></div>
                    </div>
                </div>

                <!-- Current Time Indicator -->
                <div class="absolute left-0 right-0 border-t-2 border-red-400 z-20 pointer-events-none"
                    style="top: 340px;"> <!-- Approximate position -->
                    <div class="absolute -left-1 -top-1.5 w-3 h-3 rounded-full bg-red-500"></div>
                </div>
            </div>
        </main>

        <!-- Sidebar: Today's Agenda (Right) -->
        <aside class="w-80 bg-white shadow-sm m-4 ml-0 rounded-xl border border-gray-200 flex flex-col flex-shrink-0">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Agenda de Hoy</h3>
                <p class="text-sm text-gray-500 mt-1">Martes, 10 Diciembre</p>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-4">

                @forelse($todaysAppointments as $appointment)
                    <div class="flex items-start space-x-3 relative">
                        <!-- Connector Line -->
                        @if(!$loop->last)
                            <div class="absolute left-[23px] top-10 bottom-[-20px] w-0.5 bg-gray-100 -z-10"></div>
                        @endif

                        <div class="w-12 text-center pt-1">
                            <span
                                class="block text-sm font-bold text-gray-700">{{ $appointment->start_time->format('H:i') }}</span>
                            <span class="block text-xs text-gray-400">{{ $appointment->start_time->format('A') }}</span>
                        </div>

                        @if($appointment->status == 'Confirmed')
                            <div class="flex-1 bg-white rounded-lg p-4 border border-accent shadow-sm ring-4 ring-accent/5">
                                <div class="flex justify-between items-start mb-2">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-accent-light text-accent">
                                        En Curso
                                    </span>
                                </div>
                                <h4 class="text-base font-bold text-gray-900">{{ $appointment->client->name }}</h4>
                                <p class="text-xs text-gray-500 font-medium mb-3">{{ $appointment->service->name }}</p>

                                <div class="flex items-center text-xs text-gray-500 mt-2 pt-2 border-t border-gray-100">
                                    <span>Cliente frecuente</span>
                                </div>
                            </div>
                        @else
                            <div
                                class="flex-1 bg-white rounded-lg p-3 border border-gray-100 hover:border-gray-300 transition-colors group">
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-accent">
                                    {{ $appointment->client->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $appointment->service->name }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        <p>No hay citas para hoy</p>
                    </div>
                @endforelse

            </div>

            <!-- Quick Stats -->
            <div class="bg-gray-50 p-4 border-t border-gray-200 mt-auto rounded-b-xl">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center">
                        <span class="block text-2xl font-bold text-gray-800">5</span>
                        <span class="text-xs text-gray-500 font-medium uppercase">Citas Hoy</span>
                    </div>
                    <div class="text-center border-l border-gray-200">
                        <span class="block text-2xl font-bold text-gray-800">95%</span>
                        <span class="text-xs text-gray-500 font-medium uppercase">Ocupación</span>
                    </div>
                </div>
            </div>
        </aside>

    </div>

</body>

</html>