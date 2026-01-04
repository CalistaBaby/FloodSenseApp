@extends('layouts.admin')

@section('content')
@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-blue-600 p-2 rounded-lg text-white shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Laporan Resmi Banjir</h2>
                <p class="text-sm text-gray-500">Publikasikan informasi valid untuk konsumsi masyarakat.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-10">
            <div class="p-8">
                <form method="POST" action="/admin/laporan" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <input name="lokasi" type="text" class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" placeholder="Contoh: Bojongsoang" required>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                            <input type="date" name="tglLaporan" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-600" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-700">Isi Laporan Resmi</label>
                        <textarea name="isi_laporan" rows="3" class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" placeholder="Detail informasi resmi..." required></textarea>
                    </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Unggah Foto Dokumentasi</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition cursor-pointer bg-gray-50 group">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="file-upload" class="relative cursor-pointer font-medium text-blue-600 hover:text-blue-500">
                                    <span>Pilih file</span>
                                    <input id="file-upload" name="foto" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">atau seret gambar ke sini</p>
                            </div>
                            <p class="text-xs text-gray-400">PNG, JPG, JPEG hingga 2MB</p>
                        </div>
                    </div>
                </div>

                    <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-10 py-3 rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition transform active:scale-95 font-bold">
                        Publikasikan Laporan
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-5 bg-gray-50 border-b flex items-center justify-between">
                <h3 class="font-bold text-gray-700 uppercase text-xs tracking-wider">Riwayat Laporan Resmi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-[10px] tracking-widest font-bold">
                            <th class="p-4">No</th>
                            <th class="p-4 text-center">Foto</th>
                            <th class="p-4">Lokasi</th>
                            <th class="p-4">Isi Laporan</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($laporans as $index => $laporan)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-400">{{ $index + 1 }}</td>
                            <td class="p-4 text-center">
                                @if($laporan->foto)
                                    <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-12 h-12 object-cover rounded-lg mx-auto shadow-sm">
                                @else
                                    <span class="text-[10px] text-gray-300 italic">No Photo</span>
                                @endif
                            </td>
                            <td class="p-4 font-semibold text-gray-800">
                                {{ $laporan->lokasi }}
                                <div class="text-[10px] text-gray-400 font-normal">
                                    {{ $laporan->tglLaporan ? \Carbon\Carbon::parse($laporan->tglLaporan)->format('d/m/Y') : '-' }}
                                </div>
                            </td>
                            <td class="p-4 text-gray-500">{{ Str::limit($laporan->isi_laporan, 50) }}</td>
                            <td class="p-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button onclick="showDetail({{ $laporan->id }})" class="p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-800 hover:text-white transition shadow-sm" title="Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                    </button>
                                    <button onclick="editLaporan({{ $laporan->id }})" class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-500 hover:text-white transition shadow-sm" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    <form action="/admin/laporan/{{ $laporan->id }}" method="POST" onsubmit="return confirm('Hapus laporan?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition shadow-sm" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-10 text-center text-gray-400 font-medium">Belum ada laporan resmi yang dibuat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DETAIL -->
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-gray-200">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">Detail Laporan</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 text-2xl transition">&times;</button>
        </div>
        <div id="modalBody" class="p-6">
            <div class="flex justify-center py-10">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-red-600"></div>
            </div>
        </div>
        <div class="p-4 bg-gray-50 text-right">
            <button onclick="closeModal()" class="px-5 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">Tutup</button>
        </div>
    </div>
</div>

<!-- EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black bg-opacity-60 hidden z-50 items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-lg w-full shadow-2xl overflow-hidden border border-gray-200">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-800">Edit Laporan</h3>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-red-500 text-2xl transition">&times;</button>
        </div>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">Lokasi</label>
                    <input type="text" name="lokasi" id="editLokasi" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Tanggal Kejadian</label>
                    <input type="date" name="tglLaporan" id="editTgl" class="w-full border rounded p-2 text-sm" required>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Isi Laporan</label>
                    <textarea name="isi_laporan" id="editIsi" class="w-full border rounded p-2 text-sm" rows="3" required></textarea>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">Ganti Foto (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full border rounded p-2 text-sm">
                </div>
            </div>
            <div class="p-4 bg-gray-50 text-right space-x-2">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2 bg-white border rounded-lg text-sm font-semibold">Batal</button>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>

    const fileInput = document.getElementById('file-upload');
        const dropzone = fileInput.closest('.group'); 

        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const fileName = this.files[0].name;
                
                dropzone.querySelector('p.pl-1').innerHTML = `<strong>${fileName}</strong> terpilih`;
                dropzone.classList.add('border-blue-500', 'bg-blue-50');
            }
        });
    function showDetail(id) {
        const modal = document.getElementById('modalDetail');
        const body = document.getElementById('modalBody');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex'); 

        fetch(`/admin/laporan/${id}/detail`)
            .then(response => response.json())
            .then(data => {
                body.innerHTML = `
                    <div class="space-y-4 text-left">
                        ${data.foto ? `<img src="${data.foto}" class="w-full h-56 object-cover rounded-xl border">` : ''}
                        <p><strong>Lokasi:</strong> ${data.lokasi}</p>
                        <p><strong>Tanggal:</strong> ${data.tglLaporan}</p>
                        <p class="bg-gray-50 p-3 rounded"><strong>Isi:</strong> ${data.isi_laporan}</p>
                    </div>`;
            })
            .catch(error => {
                body.innerHTML = '<p class="text-red-500">Gagal memuat data laporan.</p>';
            });
    }

    function closeModal() {
        const modal = document.getElementById('modalDetail');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function editLaporan(id) {
        const modal = document.getElementById('modalEdit');
        const form = document.getElementById('formEdit');
        

        form.action = `/admin/laporan/${id}`;


        fetch(`/admin/laporan/${id}/detail`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('editLokasi').value = data.lokasi;
                document.getElementById('editIsi').value = data.isi_laporan;
                

                if(data.tglRaw) {
                    document.getElementById('editTgl').value = data.tglRaw;
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
    }

    function closeEditModal() {
        const modal = document.getElementById('modalEdit');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>   
@endsection




