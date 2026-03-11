<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;
    protected $table = 'sarans';
    protected $guarded = [];

    protected $fillable = ['id_siswa', 'target', 'message', 'is_anonymous', 'status'];
    protected $attributes = [
        'status' => 'unread', 
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa'); return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
