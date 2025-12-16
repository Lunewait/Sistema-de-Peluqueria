<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina - Salón de Belleza Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-text {
            background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="bg-white">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="/images/logo.png" alt="Lumina Logo" class="h-10 w-auto">
                <span class="text-xl font-bold text-gray-900">Lumina</span>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#servicios" class="text-gray-600 hover:text-teal-600 transition">Servicios</a>
                <a href="#testimonios" class="text-gray-600 hover:text-teal-600 transition">Testimonios</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    {{-- Si está logueado, mostrar link a su panel --}}
                    @if(auth()->user()->role_id == 1)
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-gray-600 hover:text-teal-600 font-medium text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"></path>
                            </svg>
                            Panel Admin
                        </a>
                    @elseif(auth()->user()->role_id == 2)
                        <a href="{{ route('stylist.dashboard') }}"
                            class="text-gray-600 hover:text-teal-600 font-medium text-sm flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Mi Agenda
                        </a>
                    @endif
                @else
                    {{-- Si no está logueado, mostrar link discreto de Staff --}}
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-teal-600 text-sm font-medium">
                        Staff
                    </a>
                @endauth
                <a href="{{ route('booking.step1') }}"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2.5 rounded-full font-medium transition-all shadow-lg shadow-teal-600/20">
                    Reservar Ahora
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div
                    class="inline-flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm mb-6">
                    <span class="w-2 h-2 bg-teal-500 rounded-full animate-pulse"></span>
                    NUEVO SISTEMA DE RESERVAS
                </div>
                <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                    Belleza que desafía<br>
                    <span class="gradient-text">la gravedad.</span>
                </h1>
                <p class="text-lg text-gray-500 mb-8 max-w-md">
                    Experimenta un cuidado personal elevado. En Lumina, combinamos arte, tecnología y bienestar para
                    revelar tu mejor versión.
                </p>
                <div class="flex gap-4 mb-10">
                    <a href="{{ route('booking.step1') }}"
                        class="bg-gray-900 hover:bg-gray-800 text-white px-6 py-3 rounded-full font-medium flex items-center gap-2 transition-all">
                        Agendar Cita
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                    <a href="#servicios"
                        class="border border-gray-300 hover:border-gray-400 text-gray-700 px-6 py-3 rounded-full font-medium transition-all">
                        Ver Servicios
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <img src="https://i.pravatar.cc/40?img=1" class="w-10 h-10 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/40?img=5" class="w-10 h-10 rounded-full border-2 border-white">
                        <img src="https://i.pravatar.cc/40?img=8" class="w-10 h-10 rounded-full border-2 border-white">
                    </div>
                    <span class="text-gray-600"><strong class="text-gray-900">500+</strong> Clientes felices este
                        mes</span>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Salón" class="rounded-3xl shadow-2xl w-full object-cover h-[500px] grayscale">
                <div class="absolute bottom-6 right-6 bg-white rounded-xl px-4 py-3 shadow-lg flex items-center gap-3">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Top Rated Salon</p>
                        <p class="text-sm text-gray-500">4.9/5 en Google Reviews</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Section -->
    <section id="servicios" class="py-20 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <p class="text-teal-600 font-semibold tracking-widest text-sm mb-3">NUESTRA ESENCIA</p>
                <h2 class="text-4xl font-bold text-gray-900">Experiencias Diseñadas para Ti</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $servicios = [
                        ['num' => '01', 'name' => 'Corte Estilizado & Lavado', 'desc' => 'Experiencia completa de lavado relajante con masaje capilar, seguido de un corte personalizado.', 'price' => 45],
                        ['num' => '02', 'name' => 'Coloración Completa', 'desc' => 'Aplicación de tinte premium sin amoniaco para un brillo duradero y cobertura perfecta.', 'price' => 85],
                        ['num' => '03', 'name' => 'Tratamiento de Keratina', 'desc' => 'Alisado y reparación profunda para eliminar el frizz y devolver la vitalidad.', 'price' => 120],
                    ];
                @endphp
                @foreach($servicios as $servicio)
                    <div
                        class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:border-teal-200 transition-all group">
                        <span
                            class="text-teal-600 font-bold text-lg border border-teal-200 rounded-lg px-3 py-1 inline-block mb-6">{{ $servicio['num'] }}</span>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $servicio['name'] }}</h3>
                        <p class="text-gray-500 mb-6">{{ $servicio['desc'] }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gray-900">S/{{ $servicio['price'] }}</span>
                            <a href="{{ route('booking.step1') }}"
                                class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center group-hover:bg-teal-600 group-hover:border-teal-600 group-hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- CTA Section (reemplaza sección de productos) -->
    <section class="py-20 px-6 bg-gradient-to-br from-teal-600 to-teal-700">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-6">¿Lista para un nuevo look?</h2>
            <p class="text-teal-100 text-lg mb-8 max-w-2xl mx-auto">
                Reserva tu cita hoy y déjanos transformar tu imagen. Nuestro equipo de expertos está listo para
                atenderte.
            </p>
            <a href="{{ route('booking.step1') }}"
                class="inline-flex items-center gap-2 bg-white hover:bg-gray-100 text-teal-700 px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-xl">
                Reservar Cita Ahora
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3">
                    </path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Testimonios Section -->
    <section id="testimonios" class="py-20 px-6 bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-bold text-white text-center mb-16 italic">Lo que dicen nuestros clientes</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @php
                    $testimonios = [
                        ['name' => 'Carla Morrison', 'role' => 'Cliente Frecuente', 'text' => '"El ambiente es simplemente mágico. Desde que entras sientes una paz increíble. Y mi cabello nunca ha lucido mejor."', 'img' => 'https://i.pravatar.cc/60?img=5'],
                        ['name' => 'Diana Prince', 'role' => 'Modelo', 'text' => '"Necesitaba un cambio radical para una sesión y el equipo de Lumina superó todas mis expectativas. Profesionales de otro nivel."', 'img' => 'https://i.pravatar.cc/60?img=9'],
                        ['name' => 'Elena Gilbert', 'role' => 'Estudiante', 'text' => '"Me encanta poder reservar desde mi celular en segundos. El sistema es súper fácil y siempre me recuerdan mi cita."', 'img' => 'https://i.pravatar.cc/60?img=16'],
                    ];
                @endphp
                @foreach($testimonios as $t)
                    <div class="bg-slate-800/50 border border-slate-700 rounded-2xl p-8">
                        <div class="flex gap-1 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-gray-300 italic mb-6">{{ $t['text'] }}</p>
                        <div class="flex items-center gap-4">
                            <img src="{{ $t['img'] }}" alt="{{ $t['name'] }}" class="w-12 h-12 rounded-full">
                            <div>
                                <p class="text-white font-semibold">{{ $t['name'] }}</p>
                                <p class="text-gray-500 text-sm">{{ $t['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 px-6 border-t border-gray-100">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col items-center gap-4 mb-8">
                <img src="/images/logo.png" alt="Lumina Logo" class="h-12 w-auto">
                {{-- <span class="text-xl font-bold text-gray-900">Lumina.</span> --}}
            </div>
            <p class="text-gray-500 text-sm">© 2024 Lumina Salon System. All rights reserved.</p>
            <div class="flex gap-4">
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-100 hover:bg-teal-100 flex items-center justify-center text-gray-600 hover:text-teal-600 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="#"
                    class="w-10 h-10 rounded-full bg-gray-100 hover:bg-teal-100 flex items-center justify-center text-gray-600 hover:text-teal-600 transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>



</body>

</html>