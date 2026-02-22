<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // WAJIB: Untuk fitur History

class Siswa extends Model
{
    use SoftDeletes; 

    protected $table = 'siswas';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'id_siswa',
        'id_pengguna',
        'id_kelas',
        'nama_siswa',
        'NIPD',
        'NISN',
        'JK',
        'tempat_lahir',
        'tanggal_lahir', 
        'no_telp',
        'alamat',
    ];

    protected $dates = ['deleted_at'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }
}