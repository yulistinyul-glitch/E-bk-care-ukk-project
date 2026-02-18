<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;

    protected $table = 'walikelas'; 
    protected $primaryKey = 'id_walikelas';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    public $timestamps = true; 

    protected $fillable = [
        'id_walikelas',
        'id_kelas',
        'NIP', 
        'nama_guru', 
        'JK',
        'no_telp',
        'email',
        'alamat',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}