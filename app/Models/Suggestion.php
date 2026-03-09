<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'section',
        'title',
        'description',
        'icon',
        'image',
        'order'
    ];

    public function scopeTeaser($query)
    {
        return $query->where('section', 'teaser');
    }

    public function scopeHowItWorks($query)
    {
        return $query->where('section', 'how_it_works');
    }
}