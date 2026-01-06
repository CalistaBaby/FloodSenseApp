<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodSense | Masyarakat</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo4.png') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-[#F0F7FF] font-sans antialiased text-slate-900">

    <aside class="fixed left-0 top-0 h-screen w-64 bg-[#144cce] border-r border-white/10 z-50 flex flex-col">
        
        <div class="h-20 flex items-center px-8 border-b border-white/10 shrink-0">
            <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-10 w-auto brightness-0 invert">
        </div>

        <nav class="flex-1 p-4 space-y-2 mt-4">
            <a href="/masyarakat/dashboard" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->is('masyarakat/dashboard') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <i class="fas fa-house text-lg w-6 text-center"></i>
                <span class="text-xs font-black uppercase tracking-widest">Dashboard</span>
            </a>

            <a href="/masyarakat/laporan/create" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->is('masyarakat/laporan/create') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <i class="fas fa-plus-circle text-lg w-6 text-center"></i>
                <span class="text-xs font-black uppercase tracking-widest">Lapor</span>
            </a>

            <a href="/masyarakat/laporan" 
               class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all {{ request()->is('masyarakat/laporan') ? 'bg-white/20 text-white' : 'text-blue-100 hover:bg-white/10' }}">
                <i class="fas fa-clock-rotate-left text-lg w-6 text-center"></i>
                <span class="text-xs font-black uppercase tracking-widest">Riwayat</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl text-blue-100 hover:bg-red-500/20 hover:text-white transition-all group text-left">
                    <i class="fas fa-right-from-bracket text-lg w-6 text-center group-hover:translate-x-1 transition-transform"></i>
                    <span class="text-xs font-black uppercase tracking-widest">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="ml-64 min-h-screen flex flex-col">
        
        <header class="h-20 bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b border-blue-100 px-10 flex items-center justify-between">
            <div>
                <span class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em]">Selamat Datang!</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-[10px] font-black text-slate-400 uppercase leading-none mb-1">Masyarakat</p>
                    <p class="text-sm font-bold text-blue-900 leading-none">{{ auth()->user()->name }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-black text-sm border-2 border-white shadow-sm">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <main class="p-8 lg:p-12">
            <div class="max-w-6xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>