<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingSession extends Model
{
    protected $fillable = ['request_id', 'scheduled_date', 'scheduled_time', 'location_link', 'status', 'note_guru' ];

    public function request()
    {
        return $this->belongsTo(CounselingRequest::class, 'request_id');
    }
}
