<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReportGen') - Precision Engine</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#FCFAF8] text-neutral-900 min-h-screen font-sans">
    
@auth
    <nav class="sticky top-0 z-50 glass-premium border-b border-primary-100/30">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-accent-500 rounded-xl shadow-lg shadow-primary-600/20"></div>
                <span class="text-xl font-black text-slate-900 tracking-tighter">Report<span class="text-primary-600 font-extrabold">Plus</span></span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm font-bold text-slate-500 hover:text-red-500 transition-colors flex items-center gap-2">
                    Logout
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </nav>
@endauth

    <main>
        @yield('content')
    </main>

    <footer class="text-center py-12 text-neutral-400 text-xs font-bold uppercase tracking-widest">
        &copy; {{ date('Y') }} ReportGen Precision Engine. All rights reserved.
    </footer>

    @stack('scripts')
</body>
</html>
