<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
        // Menambahkan kolom poin dan status setelah id_gurubk
        $table->integer('poin')->after('id_gurubk')->nullable();
        $table->string('status', 50)->after('poin')->nullable();
    });
}

public function down(): void
{
    Schema::table('riwayat_pelanggarans', function (Blueprint $table) {
        $table->dropColumn(['poin', 'status']);
    });
}
};
