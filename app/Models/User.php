<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_pengguna'; 
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_pengguna', 'username', 'password', 'role', 'image'];
    protected $hidden = ['password', 'remember_token'];

    public function siswa() {
        return $this->hasOne(Siswa::class, 'id_pengguna', 'id_pengguna');
    }

    public function admin() {
        return $this->hasOne(Admin::class, 'id_pengguna', 'id_pengguna');
    }

    public function gurubk() {
        return $this->hasOne(Gurubk::class, 'id_pengguna', 'id_pengguna');
    }

        public function getAuthIdentifierName()
    {
        return 'id_pengguna'; 
    }
    
    public function walikelas()
    {
        return $this->hasMany(Kelas::class, 'id_walikelas', 'id_pengguna');
    }
}
