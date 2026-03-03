<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['konseling_id','sender_type','message', 'file_path', 'is_read'];

    public function konseling()
    {
        return $this->belongsTo(CounselingRequest::class, 'konseling_id', 'id');
    }
}
