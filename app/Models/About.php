<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'vision', 
        'mission', 
        'hero_image', 
        'vision_image', 
        'mission_image'
    ];

    // Jika misi ingin disimpan sebagai array (untuk list poin-poin)
    protected $casts = [
        'mission' => 'array',
    ];
}