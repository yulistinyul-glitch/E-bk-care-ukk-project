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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('vision');           // Untuk menyimpan teks Visi
            $table->text('mission');          // Untuk menyimpan teks Misi (bisa dalam format JSON atau teks panjang)
            $table->string('hero_image');     // Gambar latar belakang header
            $table->string('vision_image');   // Gambar di samping teks Visi
            $table->string('mission_image');  // Gambar di samping teks Misi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
