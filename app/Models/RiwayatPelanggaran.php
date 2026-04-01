<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPelanggaran extends Model
{
    protected $table = 'riwayat_pelanggarans'; 
    protected $primaryKey = 'id_riwayat';
    public $timestamps = false;

    public $incrementing = false; // Karena ID kita bukan angka auto-increment
    protected $keyType = 'string';

protected $fillable = [
    'id_riwayat',
    'id_siswa',
    'id_pelanggaran',
    'id_gurubk',
    'poin',
    'status',
    'tanggal_kejadian',
    'keterangan',
    'bukti',
    'file'
];

    public function siswa() {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
        
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran', 'id_pelanggaran');
    }
}