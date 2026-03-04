<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
            // Menghapus index unique agar satu jenis pelanggaran bisa diinput berkali-kali
            $table->dropUnique(['id_pelanggaran']);
        });
    }

    public function down(): void
    {
        Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
            // Jika ingin dikembalikan (rollback), dia akan jadi unique lagi
            $table->unique('id_pelanggaran');
        });
    }
};