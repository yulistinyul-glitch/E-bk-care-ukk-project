<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true; 

    protected $fillable = [
        'id_kelas',
        'id_walikelas', 
        'nama_kelas',  
        'jurusan',      
        'nomor_ruang',  
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

    public function walikelas()
    {
        return $this->hasOne(Walikelas::class, 'id_kelas', 'id_kelas');
    }

    public function getNamaLengkapAttribute()
    {
        $romawi = [10 => 'X', 11 => 'XI', 12 => 'XII'];
        $tingkat = $romawi[$this->nama_kelas] ?? $this->nama_kelas;
        $jurusan = explode(' ', trim($this->jurusan))[0];
        return "{$tingkat} {$jurusan} {$this->nomor_ruang}";
    }

}