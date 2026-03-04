<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('log_aktivitas', function (Blueprint $table) {
        // Menghapus aturan yang mewajibkan id_pengguna ada di tabel users
        $table->dropForeign(['id_pengguna']);
    });
}
};
