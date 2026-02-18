<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['konseling_id','sender_type','message','is_read'];

    public function konseling()
    {
        return $this->belongsTo(Konseling::class, 'konseling_id', 'id_konseling');
    }
}
