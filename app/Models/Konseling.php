<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konseling extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_konseling';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_konseling','id_siswa','id_gurubk','tanggal_konseling',
        'status_metode','jenis_konseling','topik_masalah',
        'hasil_konseling','status_konseling'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'id_siswa','id_siswa');
    }

    public function gurubk()
    {
        return $this->belongsTo(GuruBK::class,'id_gurubk','id_gurubk');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class,'konseling_id','id_konseling')->orderBy('created_at','asc');
    }
}
