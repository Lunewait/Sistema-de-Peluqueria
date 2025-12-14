<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lumina Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-md">
        <div class="text-center mb-8">
            <div
                class="w-14 h-14 bg-teal-600 rounded-xl flex items-center justify-center text-white text-2xl font-bold mx-auto mb-4">
                L</div>
            <h1 class="text-2xl font-bold text-gray-900">Bienvenido a Lumina</h1>
            <p class="text-gray-500 mt-2">Ingresa tus credenciales para continuar</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-6">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition">
            </div>
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="rounded text-teal-600 focus:ring-teal-500">
                    Recordarme
                </label>
            </div>
            <button type="submit"
                class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold py-3 rounded-xl transition shadow-lg shadow-teal-600/20">
                Iniciar Sesión
            </button>
        </form>
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-teal-600 text-sm">← Volver al inicio</a>
        </div>
    </div>
</body>

</html>