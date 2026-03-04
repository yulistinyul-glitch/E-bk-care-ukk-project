<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
        // Menghapus index unique pada id_gurubk
        $table->dropUnique(['id_gurubk']); 
    });
}

public function down(): void
{
    Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
        $table->unique('id_gurubk');
    });
}
};
