<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina - Salón de Belleza Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
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

<body class="bg-white" x-data="shopApp()" x-init="initCart()">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="/images/logo.png" alt="Lumina Logo" class="h-10 w-auto">
                <span class="text-xl font-bold text-gray-900">Lumina</span>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#servicios" class="text-gray-600 hover:text-teal-600 transition">Servicios</a>
                <a href="#tienda" class="text-gray-600 hover:text-teal-600 transition">Tienda</a>
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


    <!-- Tienda Section -->
    <section id="tienda" class="py-20 px-6 bg-white scroll-mt-20">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <p class="text-teal-600 font-semibold tracking-widest text-sm mb-3">LUMINA STORE</p>
                <h2 class="text-4xl font-bold text-gray-900">Cuidados Profesionales en Casa</h2>
            </div>

            <!-- Grid Productos -->
            @if(isset($products) && count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            <!-- Imagen -->
                            <div class="aspect-square bg-gray-50 relative overflow-hidden p-4 flex items-center justify-center">
                                @php
                                    $imgRaw = $product->image_url ?? $product->image;
                                    $imgSrc = null;
                                    if ($imgRaw) {
                                        if (str_starts_with($imgRaw, 'http')) {
                                            $imgSrc = $imgRaw;
                                        } elseif (str_starts_with($imgRaw, '/')) {
                                            $imgSrc = $imgRaw;
                                        } else {
                                            $imgSrc = asset('storage/' . $imgRaw);
                                        }
                                    }
                                @endphp
                                
                                @if ($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $product->name }}"
                                        class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-500"
                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <!-- Fallback visual si falla la carga de la imagen válida -->
                                    <div class="hidden absolute inset-0 items-center justify-center bg-gray-50 text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @else
                                    <div class="text-gray-300">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                @if ($product->stock_quantity < 5)
                                    <span
                                        class="absolute top-3 right-3 bg-red-100 text-red-700 text-xs font-bold px-2 py-1 rounded-full">
                                        Últimas {{ $product->stock_quantity }}
                                    </span>
                                @endif
                            </div>

                            <!-- Contenido -->
                            <div class="p-5 flex-1 flex flex-col">
                                <h3 class="font-bold text-gray-900 text-lg mb-1 leading-tight">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $product->description }}</p>

                                <div class="mt-auto flex items-center justify-between">
                                    <span
                                        class="text-xl font-bold text-teal-600">S/{{ number_format($product->price, 2) }}</span>
                                    <button
                                        @click="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $imgSrc ?? '' }}', {{ $product->stock_quantity }})"
                                        class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center hover:bg-teal-600 hover:scale-110 transition-all shadow-lg active:scale-95">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-gray-50 rounded-xl">
                    <p class="text-gray-500">Pronto agregaremos nuevos productos.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Botón Flotante Carrito -->
    <button x-show="cart.length > 0 && !cartOpen" @click="cartOpen = true"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-20 opacity-0"
        x-transition:enter-end="translate-y-0 opacity-100"
        class="fixed bottom-6 right-6 z-40 bg-slate-900 text-white px-6 py-4 rounded-full shadow-2xl flex items-center gap-3 hover:bg-slate-800 hover:scale-105 transition-all">
        <div class="relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <span
                class="absolute -top-2 -right-2 bg-teal-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-slate-900"
                x-text="cartTotalItems"></span>
        </div>
        <span class="font-bold">S/<span x-text="cartTotalAmount"></span></span>
    </button>

    <!-- Cart Drawer (Off-canvas) -->
    <div class="fixed inset-0 z-50 pointer-events-none" x-show="cartOpen" style="display: none;">
        <!-- Backdrop -->
        <div x-show="cartOpen" @click="cartOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm pointer-events-auto"></div>

        <!-- Panel -->
        <div x-show="cartOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="absolute right-0 top-0 bottom-0 w-full max-w-md bg-white shadow-2xl pointer-events-auto flex flex-col">

            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white">
                <h2 class="text-xl font-bold text-gray-900">Tu Cesta</h2>
                <button @click="cartOpen = false"
                    class="text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Items -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6">
                <template x-if="cart.length === 0">
                    <div class="text-center py-12">
                        <div
                            class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Tu cesta está vacía</p>
                        <button @click="cartOpen = false" class="mt-4 text-teal-600 font-bold hover:underline">Seguir
                            explorando</button>
                    </div>
                </template>

                <template x-for="item in cart" :key="item.id">
                    <div class="flex gap-4">
                        <!-- Imagen -->
                        <div
                            class="w-20 h-20 bg-gray-50 rounded-lg flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-100">
                            <template x-if="item.image">
                                <img :src="item.image" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!item.image">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </template>
                        </div>

                        <!-- Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-1">
                                <h4 class="font-bold text-gray-900 truncate pr-2" x-text="item.name"></h4>
                                <button @click="removeFromCart(item.id)"
                                    class="text-gray-400 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-teal-600 font-bold text-sm mb-2">S/<span
                                    x-text="item.price.toFixed(2)"></span></p>

                            <!-- Cantidad -->
                            <div class="flex items-center gap-3">
                                <div class="flex items-center border border-gray-200 rounded-lg bg-gray-50">
                                    <button class="px-2 py-1 text-gray-500 hover:text-teal-600"
                                        @click="updateQuantity(item.id, -1)">-</button>
                                    <span class="w-8 text-center text-sm font-bold bg-white"
                                        x-text="item.quantity"></span>
                                    <button class="px-2 py-1 text-gray-500 hover:text-teal-600"
                                        @click="updateQuantity(item.id, 1)">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Footer -->
            <div class="p-6 bg-gray-50 border-t border-gray-100" x-show="cart.length > 0">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-xl font-bold text-gray-900">S/<span x-text="cartTotalAmount"></span></span>
                </div>
                <button @click="checkout()"
                    class="w-full py-4 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg hover:shadow-teal-500/30 transition-all flex items-center justify-center gap-2">
                    <span>Proceder al Pago</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
                <p class="text-center text-xs text-gray-400 mt-4">Transacciones seguras y encriptadas</p>
            </div>
        </div>
    </div>

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