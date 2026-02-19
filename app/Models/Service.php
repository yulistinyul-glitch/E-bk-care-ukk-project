<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    // Nama tabel secara otomatis menjadi 'services'
    protected $fillable = ['title', 'icon', 'description', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            $service->slug = Str::slug($service->title);
        });
    }
}