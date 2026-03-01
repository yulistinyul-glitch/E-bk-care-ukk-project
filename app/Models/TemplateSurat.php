<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateSurat extends Model
{
    use SoftDeletes;

    protected $table = 'template_surats';
    protected $primaryKey = 'id_template';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_template',
        'nama_template',
        'jenis_template',
        'file',
    ];
}
