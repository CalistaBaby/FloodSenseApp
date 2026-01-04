@extends('layouts.masyarakat')

@section('content')
<h2 class="text-xl font-bold mb-6">Riwayat Laporan Saya</h2>

<div class="bg-white rounded-xl shadow overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="p-4 text-sm font-semibold">Foto</th>
                <th class="p-4 text-sm font-semibold">Tanggal Kejadian</th>
                <th class="p-4 text-sm font-semibold">Lokasi</th>
                <th class="p-4 text-sm font-semibold text-center">Status</th>
                <th class="p-4 text-sm font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($laporans as $laporan)
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="p-4">
                    @if($laporan->foto)
                        <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-16 h-12 object-cover rounded shadow-sm">
                    @else
                        <span class="text-gray-400 text-[10px] italic">Tidak ada foto</span>
                    @endif
                </td>
                <td class="p-4 text-sm text-gray-600">
                    {{ $laporan->tglLaporan ? \Carbon\Carbon::parse($laporan->tglLaporan)->format('d/m/Y') : '-' }}
                </td>
                <td class="p-4 text-sm font-medium text-gray-800">{{ $laporan->lokasi }}</td>
                <td class="p-4 text-center">
                    @if($laporan->status_validasi == 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Menunggu</span>
                    @elseif($laporan->status_validasi == 'diterima')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Diterima</span>
                    @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Ditolak</span>
                    @endif
                </td>
                <td class="p-4 text-center">
                    <button onclick="showRiwayatDetail({{ $laporan->id }})" class="text-blue-600 hover:text-blue-800 transition transform hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0Z" />
                        </svg>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-10 text-center text-gray-500 italic">Kamu belum pernah mengirim laporan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">Detail Laporan Saya</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 text-2xl transition">&times;</button>
        </div>
        <div id="modalBody" class="p-6">
            <div class="flex justify-center py-10">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600"></div>
            </div>
        </div>
        <div class="p-4 bg-gray-50 text-right">
            <button onclick="closeModal()" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">Tutup</button>
        </div>
    </div>
</div>

<script>
    function showRiwayatDetail(id) {
        const modal = document.getElementById('modalDetail');
        const body = document.getElementById('modalBody');
        
        modal.classList.replace('hidden', 'flex');

        // Mengambil data dari endpoint detail yang sudah ada
        fetch(`/masyarakat/laporan/${id}/detail`)
            .then(res => {
                if (!res.ok) throw new Error('Error fetch');
                return res.json();
            })
            .then(data => {
                body.innerHTML = `
                    <div class="space-y-4">
                        ${data.foto
                            ? `<img src="${data.foto}" class="w-full h-56 object-cover rounded-xl">`
                            : `<div class="h-32 flex items-center justify-center text-gray-400 italic">Tidak ada foto</div>`
                        }
                        <p><strong>Lokasi:</strong> ${data.lokasi}</p>
                        <p><strong>Tanggal:</strong> ${data.tglLaporan}</p>
                        <div class="bg-gray-50 p-4 rounded">
                            ${data.isi_laporan}
                        </div>
                    </div>
                `;
            })
            .catch(() => {
                body.innerHTML = `
                    <p class="text-center text-red-600 font-semibold">
                        Gagal memuat detail laporan
                    </p>
                `;
            });

    }

    function closeModal() {
        document.getElementById('modalDetail').classList.replace('flex', 'hidden');
    }
</script>
@endsection