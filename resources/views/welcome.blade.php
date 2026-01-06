<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FloodSense - Monitoring Banjir Bandung</title>

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo4.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
    </head>
    <body class="bg-slate-50 text-slate-900 font-sans antialiased">
        
        <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-slate-100">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 flex h-20 items-center justify-between">
                <div class="flex items-center">
                    <a href="/" class="hover:opacity-90 transition-opacity">
                        <img src="{{ asset('images/logo1.png') }}" alt="FloodSense Logo" class="h-12">
                    </a>
                </div>

                <div class="flex items-center gap-6">
                    @if (Route::has('login'))
                        <div class="flex gap-4 items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 uppercase tracking-wider">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 transition uppercase tracking-wider">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-full text-xs font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 uppercase tracking-wider">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <header class="relative overflow-hidden bg-white pt-16 pb-24 lg:pt-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
                <div class="z-10 text-center lg:text-left">
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-[1.2] mb-6 tracking-tight">
                        Pantau Banjir Bandung <br>
                        <span class="text-blue-600">Secara Real-Time.</span>
                    </h1>
                    <p class="text-base text-slate-600 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0 font-medium">
                        FloodSense membantu warga Bandung mendapatkan informasi banjir lebih cepat dan terpercaya.
                    </p>
                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="#features" class="bg-blue-600 text-white px-7 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                            Lihat Fitur
                        </a>
                        <a href="#" class="bg-slate-100 text-slate-700 px-7 py-3 rounded-xl text-sm font-bold hover:bg-slate-200 transition">
                            Download App
                        </a>
                    </div>
                </div>

                <div class="relative flex justify-center lg:justify-end">
                    <div class="bg-blue-50/50 rounded-[2.5rem] p-6 lg:p-10 aspect-video flex items-center justify-center border border-blue-100 shadow-xl relative overflow-hidden w-full max-w-xl">
                        
                        <img src="{{ asset('images/banjirfoto2.jpg') }}" alt="Flood Background" class="absolute inset-0 w-full h-full object-cover opacity-70 ">
                        <div class="absolute inset-0 bg-blue-600 opacity-30 "></div>
                        
                        
                        <div class="bg-white rounded-2xl shadow-xl p-6 z-10 w-full max-w-xs transform hover:scale-105 transition-transform duration-500">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-red-100 text-red-600 rounded-xl flex items-center justify-center text-sm">
                                    <i class="fas fa-triangle-exclamation"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm uppercase">Peringatan Dini!</div>
                                    <div class="text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-none">Sistem IoT</div>
                                </div>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-xl border border-slate-100 mb-3 text-[11px] leading-relaxed text-slate-600 font-semibold">
                                "Status <span class="text-red-600">Siaga 1</span>: Wilayah Dayeuhkolot terpantau kenaikan debit air."
                            </div>
                            <div class="flex justify-between items-center text-[9px] text-slate-400 font-bold uppercase tracking-wider">
                                <span>Terpantau: Barusan</span>
                                <span class="flex items-center gap-1"><i class="fas fa-location-dot"></i> Bandung</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="features" class="py-24 bg-blue-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-blue-600 font-bold tracking-[0.15em] uppercase text-[11px] mb-3 text-center">Keunggulan Utama</h2>
                    <p class="text-2xl lg:text-3xl font-extrabold text-black">Mengapa FloodSense?</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:border-blue-400 hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner text-xl">
                            <i class="fas fa-satellite-dish"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-slate-900">Sensor IoT Akurat</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">Terhubung langsung dengan CCTV dan sensor air di berbagai titik strategis di Bandung.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:border-blue-400 hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner text-xl">
                            <i class="fas fa-users-rays"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-slate-900">Laporan Warga</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">Warga dapat berkontribusi melaporkan kondisi banjir di lokasi secara langsung dengan bukti foto.</p>
                    </div>

                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 hover:border-blue-400 hover:shadow-xl transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner text-xl">
                            <i class="fas fa-bell"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-3 text-slate-900">Push Notification</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">Dapatkan notifikasi instan di HP Anda saat sistem mendeteksi potensi banjir di wilayah sekitar.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-white border-t border-slate-100 py-12">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <div class="flex justify-center gap-6 mb-8 text-slate-300">
                    <a href="#" class="hover:text-pink-500 transition-colors"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="hover:text-slate-900 transition-colors"><i class="fab fa-github text-2xl"></i></a>
                    <a href="#" class="hover:text-blue-700 transition-colors"><i class="fab fa-linkedin text-2xl"></i></a>
                </div>
                <p class="text-slate-400 text-[11px] font-bold tracking-widest uppercase">&copy; 2026 FloodSense Project</p>
                <div class="mt-4 flex items-center justify-center gap-2 text-slate-200">
                    <div class="h-px w-6 bg-slate-100"></div>
                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-300">Telkom University Student Project</p>
                    <div class="h-px w-6 bg-slate-100"></div>
                </div>
            </div>
        </footer>

    </body>
</html>