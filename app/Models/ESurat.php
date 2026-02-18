<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ESurat extends Model
{
    protected $table = 'e_surats';
    protected $primaryKey = 'id_surat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_surat',
        'nomor_surat_resmi',
        'id_siswa',
        'id_gurubk',
        'id_template',
        'tanggal_terbit',
        'keterangan_tambahan',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function gurubk()
    {
        return $this->belongsTo(Gurubk::class, 'id_gurubk');
    }

    public function templatesurat()
    {
        return $this->belongsTo(TemplateSurat::class, 'id_template');
    }
}
