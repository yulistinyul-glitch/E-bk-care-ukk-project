<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'foto',
        'NIPD',
        'NISN',
        'JK',
        'tempat_lahir',
        'tanggal_lahir',
        'no_telp',
        'alamat',
    ];
    
    // relasi

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }

    public function riwayatPelanggaran()
    {
        return $this->hasMany(RiwayatPelanggaran::class, 'id_siswa', 'id_siswa');
    }

    public function getTotalPoinAttribute()
    {
        return $this->riwayatPelanggaran->sum('poin') ?? 0;
    }

    public function getStatusSpAttribute()
    {
        $poin = $this->total_poin;

        if ($poin >= 100) return 'DROP OUT';
        if ($poin >= 76)  return 'SP 3';
        if ($poin >= 51)  return 'SP 2';
        if ($poin >= 16)  return 'SP 1';
        
        return 'Normal / Pembinaan';
    }

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'deleted_at' => 'datetime',
        ];
    }
}