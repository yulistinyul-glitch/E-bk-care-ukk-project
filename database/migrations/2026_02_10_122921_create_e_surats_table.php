<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_surats', function (Blueprint $table) {
            $table->string('id_surat', 6)->primary();

            $table->string('nomor_surat_resmi', 50)->unique();

            $table->string('id_siswa', 6);
            $table->string('id_gurubk', 6);
            $table->string('id_template', 8);

            $table->dateTime('tanggal_terbit');
            $table->text('keterangan_tambahan')->nullable();

            $table->timestamps();
            
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswas')
                  ->onDelete('cascade');

            $table->foreign('id_gurubk')
                  ->references('id_gurubk')
                  ->on('gurubks')
                  ->onDelete('cascade');

            $table->foreign('id_template')
                  ->references('id_template')
                  ->on('templates')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_surats');
    }
};
