<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanksis', function (Blueprint $table) {
            $table->string('id_sanksi', 8)->primary();

            $table->string('id_riwayat', 8)->unique();
            $table->string('nama_sanksi', 100);
            $table->enum('status_sanksi', ['diberikan', 'terselesaikan'])
                  ->default('diberikan');
            $table->dateTime('tanggal_diberikan')->nullable();

            $table->timestamps();

            $table->foreign('id_riwayat')
                  ->references('id_riwayat')
                  ->on('riwayat_pelanggarans')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanksis');
    }
};
