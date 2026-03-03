<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('e_surats', function (Blueprint $table) {
            $table->string('id_surat', 10)->primary(); // Panjang ditambah agar aman
            $table->string('nomor_surat_resmi', 50);

            // TIPE DATA & PANJANG HARUS SAMA PERSIS DENGAN TABEL REFERENSI
            $table->string('id_siswa', 10);   
            $table->string('id_gurubk', 10);  
            $table->string('id_template', 10); 

            $table->dateTime('tanggal_terbit');
            $table->text('keterangan_tambahan')->nullable();
            $table->string('file_generate')->nullable(); 
            $table->enum('status', ['draft', 'sent', 'cetak_pdf'])->default('draft');

            $table->timestamps();
            
            // Relasi Siswa
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswas')
                  ->onDelete('cascade');

            // Relasi GuruBK
            $table->foreign('id_gurubk')
                  ->references('id_gurubk')
                  ->on('gurubks')
                  ->onDelete('cascade');

            // Relasi Template (PASTIKAN NAMA TABELNYA BENAR: 'templates' ATAU 'template_surats')
            $table->foreign('id_template')
                  ->references('id_template')
                  ->on('template_surats') // Ganti ke 'templates' jika nama tabelmu 'templates'
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('e_surats');
    }
};