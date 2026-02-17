<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfReport extends Model
{
    protected $table = 'self_reports';
    protected $primaryKey = 'id_report';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_report',
        'id_gurubk',
        'tanggal_lapor',
        'kategori_masalah',
        'isi_laporan',
        'file',
        'status_verifikasi'
    ];
}
