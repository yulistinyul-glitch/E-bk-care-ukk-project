<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {

            $table->string('id_kelas', 6)->primary();
            $table->string('nama_kelas', 50);
            $table->unsignedInteger('nomor_ruang');
            $table->enum('jurusan', ['BRP', 'PPLG', 'DKV']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
