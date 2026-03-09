<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title', 'tagline', 'desc_1', 'desc_2', 
        'visi_judul', 'visi_tagline', 'visi_desc', 'foto_visi',
        'misi_judul', 'misi_tagline', 'misi_desc', 'foto_misi'
    ];
}
