<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    // Tambahkan 'excerpt' di sini
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'image', 'category', 'author', 'is_featured'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
        });
    }
}