@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-6 text-gray-800">Validasi Laporan Masyarakat</h2>

<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <table class="w-full text-left border-collapse">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-4 text-sm font-semibold uppercase">Pelapor</th>
                <th class="p-4 text-sm font-semibold uppercase">Lokasi</th>
                <th class="p-4 text-sm font-semibold uppercase text-center">Status</th>
                <th class="p-4 text-sm font-semibold uppercase text-center">Aksi & Validasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $l)
            <tr class="border-b hover:bg-gray-50 transition">
                <td class="p-4">
                    <div class="font-medium text-gray-900">{{ $l->user->name }}</div>
                    <div class="text-[10px] text-gray-400 italic">{{ $l->created_at->format('d/m/Y H:i') }}</div>
                </td>
                <td class="p-4 text-gray-600 text-sm">{{ $l->lokasi }}</td>
                
                <td class="p-4 text-center">
                    @if($l->status_validasi == 'diterima')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-[10px] font-bold uppercase">Diterima</span>
                    @elseif($l->status_validasi == 'ditolak')
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-[10px] font-bold uppercase">Ditolak</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-[10px] font-bold uppercase">Pending</span>
                    @endif
                </td>

                <td class="p-4">
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" onclick="showDetailValidasi({{ $l->id }})" class="text-blue-600 hover:text-blue-800 transition" title="Lihat Detail">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>

                        @if($l->status_validasi == 'pending') 
                            <form method="POST" action="{{ route('admin.laporan.updateStatus', $l->id) }}">
                                @csrf 
                                @method('PATCH')
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" class="bg-green-100 text-green-700 px-3 py-1 rounded-lg text-xs font-bold hover:bg-green-500 hover:text-white transition">
                                    Terima
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.laporan.updateStatus', $l->id) }}">
                                @csrf 
                                @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="bg-red-100 text-red-700 px-3 py-1 rounded-lg text-xs font-bold hover:bg-red-500 hover:text-white transition">
                                    Tolak
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-[10px] font-medium italic bg-gray-100 px-2 py-1 rounded">
                                Selesai divalidasi
                            </span>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold">Detail Laporan Masyarakat</h3>
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
    function showDetailValidasi(id) {
        const modal = document.getElementById('modalDetail');
        const body = document.getElementById('modalBody');
        
        modal.classList.replace('hidden', 'flex');
        body.innerHTML = '<div class="flex justify-center py-10 text-gray-400">Memuat detail...</div>';

        fetch(`/admin/laporan/${id}/detail`)
            .then(response => response.json())
            .then(data => {
                body.innerHTML = `
                    <div class="space-y-4 text-sm text-left">
                        ${data.foto ? `<img src="${data.foto}" class="w-full h-56 object-cover rounded-xl border shadow-sm">` : '<div class="w-full h-32 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 italic">Tidak ada foto dokumentasi</div>'}
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <span class="block text-gray-400 text-[10px] uppercase font-bold tracking-wider">Pelapor</span>
                                <span class="font-semibold text-gray-800">${data.pelapor}</span>
                            </div>
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <span class="block text-gray-400 text-[10px] uppercase font-bold tracking-wider">Lokasi</span>
                                <span class="font-semibold text-gray-800">${data.lokasi}</span>
                            </div>
                        </div>
                        <div class="border-t pt-4">
                            <span class="block text-gray-400 text-[10px] uppercase font-bold mb-1 tracking-wider">Isi Laporan Masyarakat</span>
                            <div class="bg-gray-50 p-4 rounded-lg border italic text-gray-600 leading-relaxed">
                                "${data.isi_laporan}"
                            </div>
                        </div>
                    </div>
                `;
            });
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.replace('flex', 'hidden');
    }
</script>
@endsection