@extends('layouts.app')

@section('content')
    <div x-data="shopApp()" x-init="initCart()">
        <!-- Hero Section de la Tienda -->
        <div class="bg-slate-900 text-white py-16 px-6 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-teal-900 to-slate-900 opacity-50"></div>
            <div class="max-w-6xl mx-auto relative z-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Lumina Store</h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">Productos profesionales seleccionados por nuestros
                    estilistas para el cuidado de tu belleza en casa.</p>
            </div>
        </div>

        <!-- Catálogo -->
        <div class="max-w-6xl mx-auto py-12 px-6">
            @if(count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                            <!-- Imagen -->
                            <div class="aspect-square bg-gray-50 relative overflow-hidden p-4 flex items-center justify-center">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                        class="object-contain w-full h-full group-hover:scale-105 transition-transform duration-500">
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
                                    <span class="text-xl font-bold text-teal-600">S/{{ number_format($product->price, 2) }}</span>
                                    <button
                                        @click="addToCart({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image_url }}', {{ $product->stock_quantity }})"
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
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Catálogo Vacío</h3>
                    <p class="text-gray-500 mt-2">Pronto agregaremos nuevos productos.</p>
                </div>
            @endif
        </div>

        <!-- Botón Flotante Carrito (Solo visible si hay items y el drawer está cerrado) -->
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
        <div class="fixed inset-0 z-50 pointer-events-none" x-show="cartOpen">
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
                                    <span class="text-xs text-gray-400" x-text="'Stock: ' + item.stock"></span>
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
                        <span>Proceder al Pago en WhatsApp</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">Transacciones seguras y encriptadas</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function shopApp() {
            return {
                cartOpen: false,
                cart: [],

                initCart() {
                    const stored = localStorage.getItem('lumina_cart');
                    if (stored) {
                        this.cart = JSON.parse(stored);
                    }
                    this.$watch('cart', (val) => {
                        localStorage.setItem('lumina_cart', JSON.stringify(val));
                    });
                },

                get cartTotalItems() {
                    return this.cart.reduce((acc, item) => acc + item.quantity, 0);
                },

                get cartTotalAmount() {
                    return this.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0).toFixed(2);
                },

                addToCart(id, name, price, image, stock) {
                    const existing = this.cart.find(i => i.id === id);
                    if (existing) {
                        if (existing.quantity < stock) {
                            existing.quantity++;
                        } else {
                            alert('No hay más stock disponible de este producto.');
                        }
                    } else {
                        this.cart.push({
                            id, name, price, image, stock, quantity: 1
                        });
                    }
                    this.cartOpen = true; // Open drawer for feedback
                },

                removeFromCart(id) {
                    this.cart = this.cart.filter(i => i.id !== id);
                },

                updateQuantity(id, change) {
                    const item = this.cart.find(i => i.id === id);
                    if (!item) return;

                    const newQty = item.quantity + change;
                    if (newQty > 0 && newQty <= item.stock) {
                        item.quantity = newQty;
                    }
                },

                checkout() {
                    let message = "Hola *Lumina*, quisiera realizar el siguiente pedido web:%0A%0A";
                    this.cart.forEach(item => {
                        message += `• ${item.quantity}x ${item.name} - S/${(item.price * item.quantity).toFixed(2)}%0A`;
                    });
                    message += `%0A*Total a Pagar: S/${this.cartTotalAmount}*%0A%0AMi nombre es: `;

                    // Reemplazar número con el del negocio real
                    window.open(`https://wa.me/51900000000?text=${message}`, '_blank');
                }
            }
        }
    </script>
@endsection