<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumina - Reserva tu Momento</title>

    <!-- Tailwind via CDN for stability without npm -->
    <!-- Tailwind via CDN for stability without npm -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6', // Main accent
                            600: '#0d9488',
                            700: '#0f766e',
                        },
                        accent: '#14b8a6',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Header -->
    <header class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Lumina Logo" class="h-16 w-auto object-contain">
            </div>
            <nav class="flex items-center gap-6">
                <a href="{{ route('booking.step1') }}"
                    class="text-sm font-medium text-gray-600 hover:text-teal-600 transition">reserva</a>
                <a href="{{ route('shop.index') }}"
                    class="text-sm font-medium text-gray-600 hover:text-teal-600 transition">tienda</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>