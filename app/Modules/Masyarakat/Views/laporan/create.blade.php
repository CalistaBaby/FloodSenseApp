@extends('layouts.masyarakat')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center gap-3 mb-6">
        <div class="bg-blue-600 p-2 rounded-lg text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Buat Laporan Banjir</h2>
            <p class="text-sm text-gray-500">Sampaikan kondisi banjir di sekitar Anda untuk respon cepat.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form method="POST" action="/masyarakat/laporan" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <input name="lokasi" type="text" 
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" 
                            placeholder="Contoh: Jl. Telekomunikasi No. 1, Bojongsoang" required>
                    </div>
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                    <input type="date" name="tglLaporan" 
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm text-gray-600" required>
                </div>

                <div>
                    <label class="block mb-1.5 text-sm font-semibold text-gray-700">Detail Kondisi Banjir</label>
                    <textarea name="isi_laporan" rows="4" 
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition text-sm" 
                        placeholder="Ceritakan ketinggian air, arus, atau bantuan yang dibutuhkan..." required></textarea>
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

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform active:scale-95">
                        Kirim Laporan Sekarang
                    </button>
                </div>
            </form>
        </div>
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100">
            <p class="text-[10px] text-gray-400 text-center uppercase tracking-widest font-bold">Laporan Anda akan divalidasi oleh tim FloodSense Bandung</p>
        </div>
    </div>
</div>

<script>
    const fileInput = document.getElementById('file-upload');
        const dropzone = fileInput.closest('.group'); // Ambil container box-nya

        fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                const fileName = this.files[0].name;
                // Ubah teks "seret gambar ke sini" menjadi nama file
                dropzone.querySelector('p.pl-1').innerHTML = `<strong>${fileName}</strong> terpilih`;
                dropzone.classList.add('border-blue-500', 'bg-blue-50');
            }
        });
</script>
@endsection