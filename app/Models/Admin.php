<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id_admin',
        'id_pengguna',
        'nama_admin',
        'JK',
        'no_telp',
        'email',
        'alamat'
    ];

    public function pengguna(){
        return $this->belongsTo(User::class, 'id_pengguna', 'id_pengguna');
    }
}
