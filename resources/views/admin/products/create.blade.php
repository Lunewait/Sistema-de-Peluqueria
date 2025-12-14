@extends('layouts.admin')
@section('title', isset($product) ? 'Editar Producto' : 'Nuevo Producto')
@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <a href="{{ route('admin.products.index') }}"
                class="text-gray-500 hover:text-teal-600 text-sm flex items-center gap-1 mb-4">← Volver</a>
            <h1 class="text-3xl font-bold text-gray-900">{{ isset($product) ? 'Editar' : 'Nuevo' }} Producto</h1>
        </div>
        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}"
            method="POST" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            @csrf
            @if(isset($product)) @method('PUT') @endif
            <div class="space-y-6">
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                    <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm font-medium text-gray-700 mb-2">Precio *</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-2">Stock *</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div><label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                        <input type="text" name="category" value="{{ old('category', $product->category ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                    <div><label class="block text-sm font-medium text-gray-700 mb-2">Marca</label>
                        <input type="text" name="brand" value="{{ old('brand', $product->brand ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                    </div>
                </div>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ (isset($product) ? $product->is_active : true) ? 'checked' : '' }}
                            class="w-5 h-5 rounded text-teal-600"> Activo</label>
                    <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ (isset($product) && $product->is_featured) ? 'checked' : '' }}
                            class="w-5 h-5 rounded text-teal-600"> Destacado</label>
                </div>
            </div>
            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl font-medium transition">Guardar</button>
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition">Cancelar</a>
            </div>
        </form>
    </div>
@endsection