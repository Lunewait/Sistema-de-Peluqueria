@extends('layouts.admin')

@section('title', 'Gestión de Citas - Lumina Admin')

@section('content')
    <div class="px-8 py-6" x-data="appointmentManager()">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestión de Citas</h1>
            <a href="{{ route('admin.appointments.create') }}"
                class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Nueva Cita
            </a>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
            <form method="GET" class="flex gap-4">
                <input type="text" name="search" placeholder="Buscar cliente..." value="{{ request('search') }}"
                    class="flex-1 rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                <select name="status" class="rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                    <option value="">Todos los Estados</option>
                    <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmadas</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pendientes</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Canceladas</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completadas</option>
                </select>
                <button type="submit"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-sm font-medium">Filtrar</button>
            </form>
        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-3 font-medium">ID</th>
                            <th class="px-6 py-3 font-medium">Cliente</th>
                            <th class="px-6 py-3 font-medium">Servicio</th>
                            <th class="px-6 py-3 font-medium">Estilista</th>
                            <th class="px-6 py-3 font-medium">Fecha</th>
                            <th class="px-6 py-3 font-medium">Estado</th>
                            <th class="px-6 py-3 font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-6 py-4 text-gray-500">#{{ $appointment->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $appointment->client->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-400">{{ $appointment->client->email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $appointment->service->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $appointment->employee->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $appointment->start_time->format('d M, Y') }}<br>
                                    <span class="text-xs text-gray-400">{{ $appointment->start_time->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                    {{ $appointment->status == 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                                    {{ $appointment->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                                    {{ $appointment->status == 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                                                    {{ $appointment->status == 'Completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                        {{ $appointment->status }}
                                    </span>
                                    @if ($appointment->payment_status == 'paid')
                                        <span
                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                            Pagado
                                        </span>
                                    @elseif($appointment->payment_status == 'deposit')
                                        <span
                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                            Depósito
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if ($appointment->status != 'Completed' && $appointment->status != 'Cancelled')
                                            <!-- Botón de Cobrar -->
                                            <button @click="openPaymentModal({{ $appointment->id }})" title="Finalizar y Cobrar"
                                                class="p-1 hover:bg-teal-50 rounded text-teal-600 hover:text-teal-800 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </button>
                                        @endif

                                        <a href="{{ route('admin.appointments.edit', $appointment) }}" title="Editar"
                                            class="p-1 hover:bg-gray-100 rounded text-blue-600 hover:text-blue-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Eliminar"
                                                class="p-1 hover:bg-red-50 rounded text-red-600 hover:text-red-800">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    No se encontraron citas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($appointments instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>

        <!-- Modal de Pago y Finalización -->
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="openModal = false">
            </div>

            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="relative bg-white rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden" @click.stop>
                    <div
                        class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-slate-900 text-white">
                        <h3 class="text-lg font-bold">Finalizar y Cobrar Cita</h3>
                        <button @click="openModal = false" class="text-slate-400 hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form x-bind:action="'/admin/appointments/' + selectedId + '/complete'" method="POST" class="p-6">
                        @csrf

                        <!-- Resumen Dinámico -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mb-6">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase">Cliente</span>
                                    <span class="font-bold text-gray-900" x-text="currentAppointment.client"></span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase">Servicio</span>
                                    <span class="font-bold text-gray-900" x-text="currentAppointment.service"></span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase">Precio Total</span>
                                    <span class="font-bold text-teal-600">S/<span
                                            x-text="currentAppointment.price"></span></span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase">Depósito Pagado</span>
                                    <span class="font-bold text-teal-600">S/<span
                                            x-text="currentAppointment.deposit"></span></span>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-gray-200 flex justify-between items-center">
                                <span class="font-semibold text-gray-700">Monto Pendiente a Cobrar:</span>
                                <span class="text-xl font-bold text-gray-900">S/<span
                                        x-text="(currentAppointment.price - (currentAppointment.payment_status === 'deposit' ? currentAppointment.deposit : 0)).toFixed(2)"></span></span>
                            </div>
                        </div>

                        <!-- Método de Pago -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-3">Método de Pago</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="cash" checked class="peer sr-only">
                                    <div
                                        class="p-3 border rounded-lg text-center peer-checked:bg-teal-50 peer-checked:border-teal-500 transition hover:bg-gray-50">
                                        <span class="block text-lg">💵</span>
                                        <span class="text-xs font-medium">Efectivo</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="card" class="peer sr-only">
                                    <div
                                        class="p-3 border rounded-lg text-center peer-checked:bg-teal-50 peer-checked:border-teal-500 transition hover:bg-gray-50">
                                        <span class="block text-lg">💳</span>
                                        <span class="text-xs font-medium">Tarjeta</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="yape" class="peer sr-only">
                                    <div
                                        class="p-3 border rounded-lg text-center peer-checked:bg-teal-50 peer-checked:border-teal-500 transition hover:bg-gray-50">
                                        <span class="block text-lg">📱</span>
                                        <span class="text-xs font-medium">Yape</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="plin" class="peer sr-only">
                                    <div
                                        class="p-3 border rounded-lg text-center peer-checked:bg-teal-50 peer-checked:border-teal-500 transition hover:bg-gray-50">
                                        <span class="block text-lg">💜</span>
                                        <span class="text-xs font-medium">Plin</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Productos (Opcional) -->
                        <div class="mb-6" x-data="{ searchQuery: '' }">
                            <h4 class="text-sm font-bold text-gray-700 mb-2">Venta de Productos (Opcional)</h4>
                            <input type="text" x-model="searchQuery" placeholder="Buscar producto..."
                                class="w-full mb-3 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500">

                            <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-lg p-2 space-y-2">
                                @foreach($products as $product)
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded"
                                        x-show="searchQuery === '' || '{{ strtolower($product->name) }}'.includes(searchQuery.toLowerCase())"
                                        x-data="{ count: 0 }">
                                        <div class="flex items-center gap-3">
                                            @if($product->image_url)
                                                <img src="{{ $product->image_url }}" class="w-8 h-8 rounded object-cover">
                                            @else
                                                <div class="w-8 h-8 bg-gray-200 rounded"></div>
                                            @endif
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                                <p class="text-xs text-teal-600 font-bold">S/{{ $product->price }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="text-gray-400 hover:text-teal-600"
                                                @click="if(count > 0) count--">-</button>
                                            <input type="number" readonly
                                                class="w-8 text-center text-sm border-none bg-transparent font-bold"
                                                x-model="count">
                                            <button type="button" class="text-gray-400 hover:text-teal-600"
                                                @click="if(count < {{ $product->stock_quantity }}) count++">+</button>
                                            <input type="hidden" :name="'products[{{ $product->id }}]'" :value="count">
                                        </div>
                                    </div>
                                @endforeach
                                @if($products->isEmpty())
                                    <p class="text-center text-gray-400 text-xs py-2">No hay productos activos en stock.</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <button type="button" @click="openModal = false"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-bold text-white bg-slate-900 rounded-lg hover:bg-slate-800 flex items-center gap-2 shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Confirmar Pago
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function appointmentManager() {
            return {
                openModal: false,
                selectedId: null,
                currentAppointment: {
                    client: '', service: '', price: 0, deposit: 0, payment_status: ''
                },
                paymentDetails: {},
                appointments: {
                    @foreach ($appointments as $appointment)
                                {{ $appointment->id }}: {
                            id: {{ $appointment->id }},
                            client: '{{ addslashes($appointment->client->name ?? 'Cliente') }}',
                            service: '{{ addslashes($appointment->service->name ?? 'Servicio') }}',
                            price: {{ $appointment->price ?? 0 }},
                            deposit: {{ $appointment->deposit_amount ?? 0 }},
                            status: '{{ $appointment->status }}',
                            payment_status: '{{ $appointment->payment_status }}'
                        },
                    @endforeach
                    },
        openPaymentModal(id) {
            this.selectedId = id;
            if (this.appointments[id]) {
                this.currentAppointment = this.appointments[id];
                this.openModal = true;
            }
        }
                }
            }
    </script>
@endsection