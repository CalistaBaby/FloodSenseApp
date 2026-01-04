<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodSense | Masyarakat</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-blue-50 min-h-screen">

<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md">
    <div class="flex items-center">
        <a href="/masyarakat/dashboard">
            <img src="{{ asset('images/logo3.png') }}" alt="FloodSense Logo" class="h-10 w-auto">
        </a>
    </div>

    <div class="flex items-center gap-6">
        <a href="/masyarakat/dashboard" class="hover:text-blue-200 transition">Dashboard</a>
        <a href="/masyarakat/laporan/create" class="hover:text-blue-200 transition">Lapor</a>
        <a href="/masyarakat/laporan" class="hover:text-blue-200 transition">Riwayat</a>

        
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="hover:text-blue-200 transition focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</nav>

<main class="p-8">
    @yield('content')
</main>

</body>
</html>