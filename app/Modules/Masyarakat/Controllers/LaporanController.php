<?php

namespace App\Modules\Masyarakat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanController extends Controller
{
    public function create()
    {
        return view('Masyarakat::laporan.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
                'lokasi' => 'required',
                'tglLaporan' => 'required|date',
                'isi_laporan' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Max 2MB
            ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/laporan', 'public');
        }

        Laporan::create([
            'user_id' => auth()->id(),
            'isi_laporan' => $request->isi_laporan,
            'lokasi' => $request->lokasi,
            'tglLaporan' => $request->tglLaporan, // Menambahkan tanggal kejadian
            'jenis_laporan' => 'umum',
            'status_validasi' => 'pending',
            'foto' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Laporan telah dibuat');
    }

    public function index()
    {
        // Untuk halaman riwayat masyarakat
        $laporans = auth()->user()->laporans()->latest()->get();
        return view('Masyarakat::laporan.riwayat', compact('laporans'));
    }

public function detail($id)
{
    $laporan = Laporan::where('id', $id)
        ->where('user_id', auth()->id()) // security: cuma punya sendiri
        ->first();

    if (!$laporan) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    return response()->json([
        'lokasi'      => $laporan->lokasi,
        'tglLaporan'  => $laporan->tglLaporan
            ? \Carbon\Carbon::parse($laporan->tglLaporan)->format('d M Y')
            : '-',
        'isi_laporan' => $laporan->isi_laporan,
        'foto'        => $laporan->foto
            ? asset('storage/' . $laporan->foto)
            : null,
    ]);
}


    
}