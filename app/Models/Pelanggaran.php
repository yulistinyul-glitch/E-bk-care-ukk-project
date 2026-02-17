<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggarans';
    protected $primaryKey = 'id_pelanggaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pelanggaran',
        'kategori_pelanggaran',
        'jenis_kegiatan',
        'tingkatan',
        'poin_pelanggaran'
    ];
}
