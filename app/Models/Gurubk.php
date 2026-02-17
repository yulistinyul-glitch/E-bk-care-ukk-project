<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gurubk extends Model
{
    protected $primaryKey = 'id_gurubk';
    public $incrementing = false;
    protected $fillable = ['id_gurubk', 'id_pengguna', 'NIP', 'nama_gurubk'];
}
