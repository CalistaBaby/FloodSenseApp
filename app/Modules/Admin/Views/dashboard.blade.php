@extends('layouts.admin')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Dashboard Admin BPBD</h2>
        <p class="text-sm text-slate-500 font-medium">Selamat datang kembali. Berikut ringkasan pantauan FloodSense hari ini.</p>
    </div>
    <div class="px-4 py-2 bg-white rounded-lg shadow-sm border border-slate-200 inline-flex items-center gap-2">
        <span class="w-2 h-2 bg-green-500 rounded-full animate-ping"></span>
        <span class="text-xs font-bold text-slate-600 uppercase tracking-widest" id="current-date">
            {{ now()->format('d M Y | H:i') }} WIB
        </span>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group border-l-4 border-l-blue-900">
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em] mb-1">Total Laporan Umum</p>
                <p class="text-4xl font-black text-slate-800">
                    {{ \App\Models\Laporan::where('jenis_laporan','umum')->count() }}
                </p>
            </div>

        </div>
    </div>

    <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group border-l-4 border-l-yellow-600">
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em] mb-1 text-yellow-600/70">Pending Validasi</p>
                <p class="text-4xl font-black text-yellow-500">
                    {{ \App\Models\Laporan::where('status_validasi','pending')->count() }}
                </p>
            </div>

        </div>
    </div>

    <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group border-l-4 border-l-red-600">
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.1em] mb-1 text-red-600/70">Laporan Resmi</p>
                <p class="text-4xl font-black text-red-600">
                    {{ \App\Models\Laporan::where('jenis_laporan','resmi')->count() }}
                </p>
            </div>
        </div>
    </div>

</div>

<div class="mt-8 p-4 bg-blue-600 rounded-2xl text-white flex items-center justify-between shadow-lg shadow-blue-200">
    <div class="flex items-center gap-4">
        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-md">
            <i class="fas fa-circle-info text-xl"></i>
        </div>
        <div>
            <p class="font-bold">Tips Validasi</p>
            <p class="text-xs text-blue-100">Pastikan foto laporan warga sesuai dengan titik koordinat sensor IoT sebelum divalidasi menjadi 'Resmi'.</p>
        </div>
    </div>

</div>
@endsection