<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_pelanggarans', function (Blueprint $table) {

            $table->string('id_riwayat', 8)->primary();

            $table->string('id_siswa', 6);
            $table->string('id_pelanggaran', 8);
            $table->string('id_gurubk', 6);

            $table->dateTime('tanggal_kejadian');
            $table->text('keterangan')->nullable();

            $table->string('file')->nullable();

            $table->timestamps();

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswas')
                  ->onDelete('cascade');

            $table->foreign('id_pelanggaran')
                  ->references('id_pelanggaran')
                  ->on('pelanggarans')
                  ->onDelete('cascade');

            $table->foreign('id_gurubk')
                  ->references('id_gurubk')
                  ->on('gurubks')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pelanggarans');
    }
};
