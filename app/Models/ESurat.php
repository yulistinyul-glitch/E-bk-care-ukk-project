<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ESurat extends Model
{
    // Nama tabel di database
    protected $table = 'e_surats';
    
    // Primary Key (jika bukan 'id')
    protected $primaryKey = 'id_surat';
    public $incrementing = false; // Karena id_surat pake string SR0001
    protected $keyType = 'string';

    // WAJIB ADA: Daftarkan semua kolom agar bisa disimpan
    protected $fillable = [
        'id_surat',
        'nomor_surat_resmi',
        'id_siswa',
        'id_gurubk',
        'id_template',
        'tanggal_terbit',
        'keterangan_tambahan',
        'file_generate',
        'status'
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    // Relasi ke Guru BK
    public function gurubk()
    {
        return $this->belongsTo(Gurubk::class, 'id_gurubk', 'id_gurubk');
    }
}