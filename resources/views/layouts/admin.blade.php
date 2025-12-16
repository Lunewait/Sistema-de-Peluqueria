<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lumina Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col flex-shrink-0 transition-all duration-300">
        <!-- Logo -->
        <div class="h-20 flex items-center px-6 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="Lumina Logo"
                    class="w-10 h-10 rounded-full bg-white p-0.5 object-cover">
                <span class="text-xl font-bold tracking-tight">Lumina<span class="text-teal-400">Manager</span></span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-6">
            <ul class="space-y-1 px-4">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white shadow-lg shadow-teal-900/50' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>

                <li class="pt-4 pb-2">
                    <span class="text-xs uppercase font-semibold text-slate-600 px-3">Gestión</span>
                </li>

                <li>
                    <a href="{{ route('admin.appointments.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.appointments.*') ? 'bg-teal-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.appointments.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span class="font-medium">Citas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-teal-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span class="font-medium">Usuarios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.services.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.services.*') ? 'bg-teal-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.services.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z">
                            </path>
                        </svg>
                        <span class="font-medium">Servicios</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.products.*') ? 'bg-teal-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }} transition-all group">
                        <svg class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-slate-500 group-hover:text-white' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        <span class="font-medium">Productos</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- User Profile (Bottom) -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold shadow-lg">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400">Administrador</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-red-400 hover:text-white hover:bg-red-500/10 border border-transparent hover:border-red-500/20 rounded-lg transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-gray-50">
        <!-- Top Header Mobile Only -->
        <div class="md:hidden bg-white border-b border-gray-200 p-4 flex justify-between items-center">
            <span class="font-bold text-lg">Lumina</span>
            <button class="text-gray-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg></button>
        </div>

        <!-- Scrollable Content Area -->
        <div class="flex-1 overflow-auto">
            @yield('content')
        </div>
    </main>
</body>

</html>