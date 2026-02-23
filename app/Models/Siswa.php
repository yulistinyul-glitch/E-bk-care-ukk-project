<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $table = 'siswas';

    protected $primaryKey = 'id_siswa';

    public $incrementing = false; // karena ID kamu bukan auto increment
    protected $keyType = 'string'; // karena id_siswa varchar

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

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }
}