@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Dashboard Admin BPBD</h2>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Total Laporan Umum</p>
        <p class="text-3xl font-bold">
            {{ \App\Models\Laporan::where('jenis_laporan','umum')->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Pending Validasi</p>
        <p class="text-3xl font-bold text-yellow-500">
            {{ \App\Models\Laporan::where('status_validasi','pending')->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Laporan Resmi</p>
        <p class="text-3xl font-bold text-red-600">
            {{ \App\Models\Laporan::where('jenis_laporan','resmi')->count() }}
        </p>
    </div>
</div>
@endsection
