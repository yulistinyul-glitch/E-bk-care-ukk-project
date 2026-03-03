<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class CounselingRequest extends Model
{
    protected $table = 'counseling_requests';
    
    protected $guarded = []; 

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    public function session()
    {
        return $this->hasOne(CounselingSession::class, 'request_id');
    }
}