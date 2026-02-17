<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    use HasFactory;
    
    protected $table = 'pelanggaran'; 

    protected $primaryKey = 'id_pelanggaran';

    protected $fillable = [
        'id_pelanggaran',
        'nama_pelanggaran',
        'kategori',
        'poin_pelanggaran',
    ];
}