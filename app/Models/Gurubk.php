<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gurubk extends Model
{
    use HasFactory;

    protected $table = 'gurubks';

    protected $primaryKey = 'id_gurubk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_gurubk',
        'id_pengguna',
        'NIP',
        'nama_gurubk',
        'JK',
        'no_telp',
        'email',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function laporanBulanan()
    {
        return $this->hasMany(LaporanBulanan::class, 'guru_bk_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'guru_bk_id');
    }
}
