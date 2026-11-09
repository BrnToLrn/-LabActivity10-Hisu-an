<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Barangay Bulletin – Purok Hisu-an')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Kalam:wght@700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .corkboard-bg {
            background-color: #8c6747;
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(60, 36, 18, 0.22) 15%, transparent 16%),
                radial-gradient(circle at 20% 30%, rgba(45, 25, 10, 0.25) 10%, transparent 11%),
                radial-gradient(circle at 80% 70%, rgba(70, 42, 22, 0.2) 12%, transparent 13%),
                radial-gradient(circle at 35% 85%, rgba(50, 28, 12, 0.2) 14%, transparent 15%);
            background-size: 70px 70px, 95px 95px, 80px 80px, 105px 105px;
        }
        .board-frame {
            background-color: #9e7552;
            box-shadow: 
                inset 0 0 40px rgba(35, 18, 6, 0.7),
                inset 0 0 10px rgba(20, 10, 3, 0.8),
                0 15px 35px -5px rgba(0, 0, 0, 0.45);
            border: 14px solid #4a2810;
            outline: 3px solid #2e1605;
        }
        .pin-head {
            filter: drop-shadow(1px 2px 2px rgba(0, 0, 0, 0.4));
        }
    </style>
</head>
<body class="min-h-screen corkboard-bg text-stone-900 flex flex-col font-sans antialiased">
    <header class="bg-[#341b0b] border-b-4 border-[#221004] text-amber-50 shadow-xl sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-amber-600/30 border-2 border-amber-400 text-amber-300 text-xl font-bold shadow-inner">
                    📌
                </span>
                <div>
                    <span class="font-black text-xl sm:text-2xl tracking-wide text-amber-100 uppercase drop-shadow">
                        Barangay Bulletin Board
                    </span>
                    <p class="text-xs sm:text-sm text-amber-300/90 font-medium">Purok Hisu-an Public Notices</p>
                </div>
            </div>

            <nav class="flex items-center space-x-4">
                <a href="{{ route('posts.index') }}" class="text-sm font-bold text-amber-100 hover:text-white bg-[#221004] px-4 py-2 rounded-lg border border-amber-700/60 transition">
                    📋 All Notices
                </a>
                @if (Route::has('login'))
                    @auth
                        <span class="text-xs text-amber-200">Hi, <strong class="text-amber-100">{{ auth()->user()->name }}</strong></span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-xs uppercase tracking-wider font-semibold bg-[#1a0c03] hover:bg-black px-3 py-1.5 rounded text-amber-200 hover:text-white transition cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-wider bg-amber-500 hover:bg-amber-400 text-stone-950 px-3.5 py-2 rounded shadow transition">
                            Sign in
                        </a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-[96rem] w-full mx-auto px-2 sm:px-4 lg:px-6 py-6">
        @yield('content')
    </main>

    <footer class="bg-[#2a1507] text-amber-200/80 border-t-4 border-[#1c0c03] py-4 mt-auto">
        <div class="max-w-[96rem] mx-auto px-4 sm:px-6 lg:px-8 text-center text-xs sm:text-sm">
            &copy; 2026 Barangay Bulletin &bull; Purok Hisu-an Official Community Notice Board &bull; Open for Public Viewing
        </div>
    </footer>
</body>
</html>
