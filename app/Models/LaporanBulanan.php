<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
public $incrementing = true;

    protected $table = 'laporan_bulanans';

    protected $fillable = [
        'guru_bk_id', // Sesuai kolom di phpMyAdmin kamu
        'bulan', 
        'total_pelanggaran', 
        'total_saran', 
        'total_selfreport', 
        'total_konseling', 
        'status'
    ];

    public function guruBK()
    {
        // Relasi ke User menggunakan id_pengguna (BK001)
        return $this->belongsTo(User::class, 'guru_bk_id', 'id_pengguna');
    }
}