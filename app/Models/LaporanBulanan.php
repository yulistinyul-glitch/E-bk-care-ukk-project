<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_bk_id', 'bulan', 'total_pelanggaran', 
        'total_saran', 'total_selfreport', 'total_konseling', 'status'
    ];

    public function guruBK()
    {
        return $this->belongsTo(\App\Models\GuruBK::class, 'guru_bk_id', 'id_gurubk');
    }
}