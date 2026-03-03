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
    Schema::create('counseling_requests', function (Blueprint $table) {
        $table->id();

        $table->string('id_siswa', 6);
        $table->enum('kategori', ['Pribadi', 'Akademik', 'Karier', 'Sosial']);
        $table->enum('pilihan_metode', ['online', 'offline']);
        $table->text('deskripsi')->nullable();
        $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
        
        $table->timestamps();
        $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_requests');
    }
};
