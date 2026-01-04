<?php

namespace App\Modules\Masyarakat\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan; //

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = auth()->user();

        // Mengambil laporan resmi terbaru dari admin untuk section informasi
        $informasiResmi = Laporan::where('jenis_laporan', 'resmi')
                                 ->latest()
                                 ->take(5)
                                 ->get();

        // Kita kirim data ke view dashboard
        return view('Masyarakat::dashboard', compact('informasiResmi'));
    }
}