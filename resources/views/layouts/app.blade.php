<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bakuna Tracker')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 flex flex-col font-sans">
    <header class="bg-indigo-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-indigo-600 text-white font-bold text-lg shadow-inner">
                    BT
                </span>
                <span class="font-bold text-xl tracking-wide">Bakuna Tracker</span>
            </div>

            <nav class="flex items-center space-x-6">
                @if (Route::has('login'))
                    @auth
                        <a href="/dashboard" class="text-sm font-medium hover:text-indigo-200 transition">Dashboard</a>
                        <a href="/schedule" class="text-sm font-medium hover:text-indigo-200 transition">Schedule</a>
                        <div class="h-4 w-px bg-indigo-500"></div>
                        <span class="text-sm font-medium text-indigo-100">Hi, <strong class="text-white">{{ auth()->user()->name }}</strong></span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs uppercase tracking-wider font-semibold bg-indigo-800 hover:bg-indigo-900 px-3 py-1.5 rounded text-indigo-100 hover:text-white transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold bg-white text-indigo-700 hover:bg-indigo-50 px-4 py-2 rounded-lg shadow-sm transition">
                            Sign in
                        </a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs text-slate-500">
            &copy; 2026 Barangay Matina Crossing Health Center &bull; Bakuna Tracker
        </div>
    </footer>
</body>
</html>

