<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;
    protected $fillable = ['id_siswa', 'id_pengguna', 'id_kelas', 'nipd', 'nama_siswa'];
}
