<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan_bulanans', function (Blueprint $table) {
            $table->id();
            $table->string('guru_bk_id'); 
            $table->string('bulan'); 
            $table->integer('total_pelanggaran')->default(0);
            $table->integer('total_saran')->default(0);
            $table->integer('total_selfreport')->default(0);
            $table->integer('total_konseling')->default(0);
            $table->enum('status',['pending','terkirim','diterima'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanans');
    }
};
