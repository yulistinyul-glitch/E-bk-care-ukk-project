<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KotakSurats extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_siswa', 
        'session_id', 
        'subject', 
        'judul',
        'message', 
        'is_read', 
        'type'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}