@extends('layouts.masyarakat')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Dashboard Masyarakat</h2>
    <p class="text-sm text-slate-500 font-medium">Pantau kondisi terkini dan kelola laporan banjir Anda di sini.</p>
</div>

<div class="grid lg:grid-cols-3 gap-8 items-start">
    
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 bg-gradient-to-r from-red-600 to-red-500 text-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 p-2 rounded-xl backdrop-blur-md">
                        <i class="fas fa-bullhorn text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold leading-none">Informasi Banjir Resmi</h3>
                        <p class="text-[10px] text-red-100 font-medium uppercase tracking-widest mt-1 text-center">Update dari BPBD Bandung</p>
                    </div>
                </div>
                <span class="text-[10px] bg-white/20 px-2 py-1 rounded-full uppercase font-bold tracking-tighter">Live Update</span>
            </div>

            <div class="divide-y divide-slate-50 max-h-[500px] overflow-y-auto custom-scrollbar">
                @forelse($informasiResmi as $info)
                    <div onclick="showInfoDetail({{ $info->id }})" class="p-6 hover:bg-slate-50 transition-all cursor-pointer group">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-location-dot text-red-500 text-xs"></i>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-wider">
                                    {{ $info->lokasi }}
                                </span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded-md uppercase">
                                {{ $info->tglLaporan ? \Carbon\Carbon::parse($info->tglLaporan)->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <p class="text-sm text-slate-600 leading-relaxed font-medium">
                            "{{ Str::limit($info->isi_laporan, 120) }}"
                        </p>
                        <div class="mt-4 flex items-center gap-1 text-[11px] text-blue-600 font-black uppercase tracking-widest group-hover:gap-3 transition-all">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                @empty
                    <div class="py-20 text-center">
                        <div class="bg-slate-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-2xl">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest">Kondisi Aman</p>
                        <p class="text-xs text-slate-300 mt-1">Belum ada informasi resmi dari admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Laporan Saya</h3>
        
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 group hover:border-blue-500 transition-all">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                <i class="fas fa-file-lines"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Laporan</p>
                <p class="text-2xl font-black text-slate-800 leading-none">{{ auth()->user()->laporans->count() }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 group hover:border-yellow-500 transition-all">
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-yellow-600 group-hover:text-white transition-all">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1 text-center">Menunggu</p>
                <p class="text-2xl font-black text-yellow-600 leading-none">
                    {{ auth()->user()->laporans->where('status_validasi','pending')->count() }}
                </p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex items-center gap-4 group hover:border-green-500 transition-all">
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-green-600 group-hover:text-white transition-all">
                <i class="fas fa-circle-check"></i>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1 text-center">Divalidasi</p>
                <p class="text-2xl font-black text-green-600 leading-none text-center">
                    {{ auth()->user()->laporans->where('status_validasi','diterima')->count() }}
                </p>
            </div>
        </div>

            <a href="{{ route('masyarakat.laporan.create') }}" class="mt-4 flex items-center justify-center gap-3 bg-blue-600 text-white py-4 rounded-3xl font-black uppercase tracking-widest text-xs hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-200 transition-all">
                <i class="fas fa-plus-circle"></i> Buat Laporan Baru
            </a>
    </div>
</div>

<div id="modalInfo" class="fixed inset-0 bg-slate-900/60 hidden z-50 items-center justify-center p-4 backdrop-blur-md">
    <div class="bg-white rounded-[2rem] max-w-lg w-full max-h-[85vh] shadow-2xl overflow-hidden flex flex-col">
        <div class="p-6 border-b flex justify-between items-center bg-slate-50">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest">Detail Informasi</h3>
            </div>
            <button onclick="closeInfoModal()" class="w-8 h-8 flex items-center justify-center bg-white border border-slate-200 rounded-full text-slate-400 hover:text-red-500 transition-all shadow-sm">&times;</button>
        </div>

        <div id="modalInfoBody" class="p-6 overflow-y-auto flex-1">
            <div class="flex justify-center py-12">
                <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-red-600"></div>
            </div>
        </div>

        <div class="p-6 bg-slate-50 flex justify-end gap-3">
            <button onclick="closeInfoModal()" class="px-8 py-3 bg-white border border-slate-200 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-500 hover:bg-slate-100 transition-all shadow-sm">
                Selesai
            </button>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>

<script>
function showInfoDetail(id) {
    const modal = document.getElementById('modalInfo');
    const body  = document.getElementById('modalInfoBody');

    modal.classList.replace('hidden','flex');

    fetch(`/laporan/${id}/detail`)
        .then(res => res.json())
        .then(data => {
            body.innerHTML = `
                <div class="space-y-4">
                    ${data.foto ? `
                        <img src="${data.foto}" 
                            class="w-full max-h-48 object-cover rounded-xl border shadow-sm">
                    ` : `
                        <div class="w-full h-32 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 italic">
                            Tidak ada foto dokumentasi
                        </div>
                    `}

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-red-50 p-3 rounded-lg">
                            <span class="block text-xs text-gray-400 uppercase font-bold">Lokasi</span>
                            <span class="font-semibold text-sm text-gray-800">${data.lokasi}</span>
                        </div>
                        <div class="bg-red-50 p-3 rounded-lg">
                            <span class="block text-xs text-gray-400 uppercase font-bold">Tanggal</span>
                            <span class="font-semibold text-sm text-gray-800">${data.tglLaporan}</span>
                        </div>
                    </div>

                    <div>
                        <span class="block text-xs text-gray-400 uppercase font-bold mb-1">Isi Laporan</span>
                        <div class="bg-gray-50 p-4 rounded-lg text-sm italic text-gray-600 leading-relaxed">
                            "${data.isi_laporan}"
                        </div>
                    </div>
                </div>
            `;
        });
}

function closeInfoModal() {
    document.getElementById('modalInfo')
        .classList.replace('flex','hidden');
}
</script>
@endsection