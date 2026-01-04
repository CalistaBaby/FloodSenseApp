<?php

namespace App\Modules\Admin\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class AdminLaporanController extends Controller
{
    public function create()
    {
        $laporans = Laporan::where('jenis_laporan', 'resmi')
                           ->latest()
                           ->get();

        
        return view('Admin::laporan.create', compact('laporans'));
    }

    public function store(Request $request)
    {
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/laporan', 'public');
        }

        Laporan::create([
            'user_id'       => auth()->id(),
            'isi_laporan'   => $request->isi_laporan,
            'lokasi'        => $request->lokasi,
            'tglLaporan'    => $request->tglLaporan,
            'jenis_laporan' => 'resmi',
            'status_validasi' => null,
            'foto'          => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Laporan resmi dibuat');
    }
    public function validasi(){
        $laporans = Laporan::where('jenis_laporan','umum')->get();
        return view('Admin::laporan.validasi', compact('laporans'));
    }

    public function updateStatus(Request $request, $id){
        Laporan::where('id',$id)->update([
            'status_validasi' => $request->status
        ]);

        return back();
    }

    /*public function showDetail($id)
    {
        // Mengambil data laporan berdasarkan ID
        $laporan = Laporan::find($id);

        // Jika data tidak ada, kirim error JSON
        if (!$laporan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Mengirim data ke JavaScript dalam format JSON
        return response()->json([
            'lokasi'      => $laporan->lokasi,
            'tglLaporan'  => $laporan->tglLaporan ? \Carbon\Carbon::parse($laporan->tglLaporan)->format('d M Y') : '-',
            'isi_laporan' => $laporan->isi_laporan,
            'foto'        => $laporan->foto ? asset('storage/' . $laporan->foto) : null,
        ]);
    }*/

    public function showDetail($id) {
    // Mengambil data laporan beserta relasi user (pelapor)
    $laporan = Laporan::with('user')->find($id);
    
    if (!$laporan) return response()->json(['message' => 'Data tidak ditemukan'], 404);

    return response()->json([
        'pelapor'     => $laporan->user ? $laporan->user->name : 'Anonim',
        'lokasi'      => $laporan->lokasi,
        'tglLaporan'  => $laporan->tglLaporan,
        'isi_laporan' => $laporan->isi_laporan,
        'foto'        => $laporan->foto ? asset('storage/' . $laporan->foto) : null,
        'tglBuat'     => $laporan->created_at->format('d M Y H:i'),
    ]);
}

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $data = $request->only(['lokasi', 'isi_laporan', 'tglLaporan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/laporan', 'public');
        }

        $laporan->update($data);

        return redirect()->back()->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->back()->with('success', 'Laporan berhasil dihapus');
    }

}
