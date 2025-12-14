@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-8">
            <a href="{{ route('admin.users.index') }}"
                class="text-gray-500 hover:text-teal-600 text-sm flex items-center gap-1 mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Volver a usuarios
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Editar Usuario</h1>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST"
            class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña (dejar en blanco para
                        mantener)</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                    <select name="role_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Especialidad</label>
                    <input type="text" name="specialty" value="{{ old('specialty', $user->specialty) }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 outline-none">
                </div>

                <div class="flex items-center gap-3">
                    <input type="checkbox" name="active" id="active" value="1" {{ $user->active ? 'checked' : '' }}
                        class="w-5 h-5 rounded text-teal-600">
                    <label for="active" class="text-gray-700">Usuario activo</label>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-xl font-medium transition">Actualizar
                    Usuario</button>
                <a href="{{ route('admin.users.index') }}"
                    class="px-6 py-3 rounded-xl font-medium text-gray-600 hover:bg-gray-100 transition">Cancelar</a>
            </div>
        </form>
    </div>
@endsection