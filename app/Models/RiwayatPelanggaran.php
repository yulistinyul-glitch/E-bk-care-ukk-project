<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPelanggaran extends Model
{
    protected $table = 'riwayat_pelanggarans'; 
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    protected $fillable = [
        'id_siswa', 
        'id_pelanggaran',
        'id_gurubk', 
        'tanggal_kejadian', 
        'keterangan', 
        'bukti_foto'
    ];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}