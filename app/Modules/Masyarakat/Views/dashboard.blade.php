@extends('layouts.masyarakat')

@section('content')
<h2 class="text-2xl font-bold mb-6 text-gray-800">Dashboard Masyarakat</h2>


<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-10">
    <div class="p-4 bg-red-600 text-white font-bold flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
        </svg>
        Informasi Banjir Resmi
    </div>

    <div class="divide-y divide-gray-100">
        @forelse($informasiResmi as $info)
            <div
                onclick="showInfoDetail({{ $info->id }})"
                class="p-5 hover:bg-gray-50 transition cursor-pointer"
            >
                <div class="flex justify-between items-center mb-2">
                    <span class="text-xs font-bold text-red-600 uppercase tracking-wider">
                        {{ $info->lokasi }}
                    </span>
                    <span class="text-[10px] text-gray-400 italic">
                        {{ $info->tglLaporan ? \Carbon\Carbon::parse($info->tglLaporan)->format('d M Y') : '-' }}
                    </span>
                </div>
                <p class="text-sm text-gray-600 italic">
                    "{{ Str::limit($info->isi_laporan, 100) }}"
                </p>
                <p class="text-[10px] text-blue-600 mt-2 font-semibold">
                    Klik untuk lihat detail →
                </p>
            </div>
        @empty
            <p class="p-10 text-center text-gray-400 text-sm">
                Belum ada informasi resmi dari admin.
            </p>
        @endforelse
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm font-medium uppercase">Total Laporan Saya</p>
        <p class="text-3xl font-bold">{{ auth()->user()->laporans->count() }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-yellow-500">
        <p class="text-gray-500 text-sm font-medium uppercase">Pending</p>
        <p class="text-3xl font-bold text-yellow-500">
            {{ auth()->user()->laporans->where('status_validasi','pending')->count() }}
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-green-500">
        <p class="text-gray-500 text-sm font-medium uppercase">Diterima</p>
        <p class="text-3xl font-bold text-green-600">
            {{ auth()->user()->laporans->where('status_validasi','diterima')->count() }}
        </p>
    </div>
</div>


<div id="modalInfo" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden max-h-[90vh] flex flex-col">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">Detail Informasi Banjir</h3>
            <button onclick="closeInfoModal()" class="text-gray-400 hover:text-red-500 text-2xl">&times;</button>
        </div>

        <div id="modalInfoBody" class="p-6">
            <div class="flex justify-center py-10">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-600"></div>
            </div>
        </div>

        <div class="p-4 bg-gray-50 text-right">
            <button onclick="closeInfoModal()" class="px-4 py-2 border rounded-lg text-sm font-semibold hover:bg-gray-100">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- ================= AJAX SCRIPT ================= --}}
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
                        <img src="${data.foto}" class="w-full h-56 object-cover rounded-xl border shadow-sm">
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
