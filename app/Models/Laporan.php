<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'user_id', 'isi_laporan', 'lokasi', 'tglLaporan', 'jenis_laporan', 'status_validasi', 'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
