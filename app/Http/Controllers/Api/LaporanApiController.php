<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;

class LaporanApiController extends Controller
{
    public function index(Request $request)
    {
        return Laporan::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request) {
        $laporan = Laporan::create([
            'user_id' => $request->user()->id, // Mengambil ID dari token
            'lokasi' => $request->lokasi, 
            'isi_laporan' => $request->isi_laporan,
            'tglLaporan' => now(),
            'status_validasi' => 'pending'
        ]);
        return response()->json($laporan, 201);
    }
}

