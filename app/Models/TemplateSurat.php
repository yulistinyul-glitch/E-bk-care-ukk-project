<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $table = 'template_surats';
    protected $primaryKey = 'id_template';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_template',
        'id_admin',
        'nama_template',
        'jenis_template',
        'file',
    ];
}
