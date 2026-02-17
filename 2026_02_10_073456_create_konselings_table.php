<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konselings', function (Blueprint $table) {
            $table->string('id_konseling', 8)->primary();

            $table->string('id_siswa', 6);
            $table->string('id_gurubk', 6);

            $table->dateTime('tanggal_konseling');
            $table->enum('status_metode', ['online', 'offline']);
            $table->enum('jenis_konseling', ['akademik', 'pribadi', 'karir', 'sosial']);
            $table->text('topik_masalah');
            $table->text('hasil_konseling')->nullable();
            $table->enum('status_konseling', ['diajukan', 'disetujui', 'selesai'])
                  ->default('diajukan');

            $table->timestamps();

            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswas')
                  ->onDelete('cascade');

            $table->foreign('id_gurubk')
                  ->references('id_gurubk')
                  ->on('gurubks')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konselings');
    }
};
