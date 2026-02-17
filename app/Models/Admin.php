<?php

namespace App\Http\Controllers;
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_admin';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'id_admin',
        'id_pengguna',
        'nama_admin',
        'username',  
        'password',
        'JK',
        'no_telp',
        'email',
        'alamat',
    ];

    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
