@extends('layouts.admin')

@section('title', 'Nuevo Servicio')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <a href="{{ route('admin.services.index') }}"
                class="text-gray-500 hover:text-teal-600 text-sm flex items-center gap-1 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a servicios
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Nuevo Servicio</h1>
        </div>

        <form action="{{ route('admin.services.store') }}" method="POST"
            class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del Servicio *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                    @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Precio ($) *</label>
                        <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duración (minutos) *</label>
                        <input type="number" name="duration_minutes" min="15" step="15"
                            value="{{ old('duration_minutes', 60) }}" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                    <input type="text" name="category" value="{{ old('category') }}"
                        placeholder="Ej: Cortes, Coloración, Tratamientos"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                        class="w-5 h-5 rounded text-teal-600 focus:ring-teal-500">
                    <label for="is_active" class="text-gray-700">Servicio activo (visible para clientes)</label>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl font-medium transition shadow-lg shadow-teal-600/20">
                    Guardar Servicio
                </button>
                <a href="{{ route('admin.services.index') }}"
                    class="px-6 py-3 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection