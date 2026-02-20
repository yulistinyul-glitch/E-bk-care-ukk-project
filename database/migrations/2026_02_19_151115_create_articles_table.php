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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');         // Judul Artikel
            $table->string('slug')->unique(); // URL SEO Friendly
            $table->text('excerpt');        // Ringkasan singkat
            $table->longText('content');    // Isi lengkap artikel
            $table->string('image')->nullable(); // Nama file gambar
            $table->boolean('is_featured')->default(false); // Penanda artikel utama (atas)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
