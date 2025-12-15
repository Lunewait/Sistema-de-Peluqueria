<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Lumina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header with Logo -->
        <div class="bg-slate-900 p-8 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-teal-600/10 opacity-50 blur-3xl rounded-full -translate-y-1/2"></div>

            <div class="relative z-10 flex flex-col items-center">
                <div class="w-16 h-16 bg-white rounded-full p-1 mb-4 shadow-lg flex items-center justify-center">
                    <img src="/images/logo.png" alt="Lumina" class="w-full h-full object-cover rounded-full">
                </div>
                <h2 class="text-2xl font-bold text-white mb-1">Bienvenido a Lumina</h2>
                <p class="text-slate-400 text-sm">Gestiona tu salón con estilo</p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" required autofocus
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 text-sm transition-colors"
                            placeholder="nombre@ejemplo.com">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 text-sm transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember"
                            class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                        <span class="ml-2">Recordarme</span>
                    </label>
                    <a href="#" class="font-medium text-teal-600 hover:text-teal-500">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition-all transform hover:-translate-y-0.5">
                    Iniciar Sesión
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">
                    ¿Volver al sitio web?
                    <a href="{{ route('home') }}" class="font-medium text-teal-600 hover:text-teal-500">Ir al Inicio</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>