<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodSense | Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

<nav class="bg-blue-600 text-white px-6 py-4 flex justify-between items-center shadow-md">
    <div class="flex items-center gap-2">
        <a href="/admin/dashboard" class="flex items-center gap-2">
            <img src="{{ asset('images/logo3.png') }}" alt="FloodSense Logo" class="h-10 w-auto">
            <span class="font-bold">ADMIN</span>
        </a>
    </div>

    <div class="flex items-center gap-6">
        <a href="/admin/dashboard" class="hover:text-blue-200 transition font-medium">Dashboard</a>
        <a href="/admin/laporan/create" class="hover:text-blue-200 transition font-medium">Laporan Resmi</a>
        <a href="/admin/laporan/validasi" class="hover:text-blue-200 transition font-medium">Laporan Umum</a>
        
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="hover:text-blue-200 transition focus:outline-none font-medium">
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