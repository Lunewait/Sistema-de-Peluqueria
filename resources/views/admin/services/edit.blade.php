@extends('layouts.admin')

@section('title', 'Editar Servicio - Lumina Admin')

@section('content')
    <div class="max-w-3xl mx-auto px-8 py-6">
        <div class="mb-6 flex items-center gap-4">
            <a href="{{ route('admin.services.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Editar Servicio</h1>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Imagen -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Imagen del Servicio</label>
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-dashed border-gray-300 overflow-hidden"
                                id="preview-container">
                                @if($service->image_url)
                                    <img src="{{ $service->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>
                            <input type="file" name="image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100"
                                onchange="previewImage(event)">
                        </div>
                    </div>

                    <!-- Info Básica -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Servicio</label>
                            <input type="text" name="name" value="{{ $service->name }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                            <select name="category"
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                                <option {{ $service->category == 'Corte' ? 'selected' : '' }}>Corte</option>
                                <option {{ $service->category == 'Coloración' ? 'selected' : '' }}>Coloración</option>
                                <option {{ $service->category == 'Tratamiento' ? 'selected' : '' }}>Tratamiento</option>
                                <option {{ $service->category == 'Peinado' ? 'selected' : '' }}>Peinado</option>
                                <option {{ $service->category == 'Manicura' ? 'selected' : '' }}>Manicura</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Precio (S/.)</label>
                            <input type="number" step="0.01" name="price" value="{{ $service->price }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Duración (minutos)</label>
                            <input type="number" name="duration_minutes" value="{{ $service->duration_minutes }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="description" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-teal-500 focus:ring-teal-500">{{ $service->description }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active"
                            class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded" {{ $service->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Activo (Visible en reservas)</label>
                    </div>

                    <div class="border-t border-gray-100 pt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.services.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Cancelar</a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow">Actualizar
                            Servicio</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('preview-container');
                output.innerHTML = `<img src="${reader.result}" class="w-full h-full object-cover">`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection