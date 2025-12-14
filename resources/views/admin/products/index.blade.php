@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Productos</h1>
            <p class="text-gray-500 mt-1">Gestiona el catálogo de productos</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-3 rounded-xl font-medium flex items-center gap-2 transition shadow-lg shadow-teal-600/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Nuevo Producto
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr class="text-left text-sm text-gray-600">
                    <th class="px-6 py-4 font-medium">Producto</th>
                    <th class="px-6 py-4 font-medium">Categoría</th>
                    <th class="px-6 py-4 font-medium">Precio</th>
                    <th class="px-6 py-4 font-medium">Stock</th>
                    <th class="px-6 py-4 font-medium">Estado</th>
                    <th class="px-6 py-4 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->category ?? '-' }}</td>
                        <td class="px-6 py-4 font-semibold text-gray-900">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $product->stock }}</td>
                        <td class="px-6 py-4">
                            @if($product->is_active)
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">Activo</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="text-teal-600 hover:text-teal-800 font-medium text-sm">Editar</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                                onsubmit="return confirm('¿Eliminar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-800 font-medium text-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">No hay productos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection