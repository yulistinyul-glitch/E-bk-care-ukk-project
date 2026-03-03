<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_surats', function (Blueprint $table) {
            // 1. Primary Key
            $table->string('id_template', 8)->primary();

            // 2. Data Template (Hanya 3 kolom utama sesuai permintaanmu)
            $table->string('nama_template', 100);
            $table->string('jenis_template', 10);
            $table->string('file'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_surats');
    }
};