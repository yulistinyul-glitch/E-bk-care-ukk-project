<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';
    public $timestamps = false;
    protected $primaryKey = 'id_log';
    public $incrementing = false;
    protected $keyType = 'string';

public static function catat($aktivitas, $keterangan = null)
{
    // Cek session, kalau tidak ada, cari id_gurubk yang ada di database kamu
    // Ganti 'BK001' dengan ID yang BENAR-BENAR ada di tabel users kamu saat ini
    $id_pengguna = Session::get('id_user') ?? Session::get('id_gurubk') ?? 'BK001';

    DB::table('log_aktivitas')->insert([
        'id_log'      => Str::upper(Str::random(8)),
        'id_pengguna' => $id_pengguna,
        'aktivitas'   => $aktivitas, 
        'keterangan'  => $keterangan, 
        'waktu_akses' => now(),
    ]);
}
}