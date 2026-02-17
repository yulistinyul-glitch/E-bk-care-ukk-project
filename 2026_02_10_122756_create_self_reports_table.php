<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('self_reports', function (Blueprint $table) {
            $table->string('id_report', 8)->primary();

            $table->string('id_gurubk', 6);
            $table->dateTime('tanggal_lapor');

            $table->enum('kategori_masalah', [
                'bullying',
                'ancaman',
                'kekerasan',
                'konflik sosial',
                'masalah digital',
                'lingkungan sekolah',
                'pelanggaran'
            ]);

            $table->text('isi_laporan');

            $table->string('file')->nullable(); 
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'ditolak'])
                  ->default('menunggu');

            $table->timestamps();

            $table->foreign('id_gurubk')
                  ->references('id_gurubk')
                  ->on('gurubks')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('self_reports');
    }
};
