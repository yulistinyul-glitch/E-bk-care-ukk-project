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
            $table->string('title')->nullable();
            $table->text('tagline')->nullable();
            $table->text('desc_1')->nullable();
            $table->text('desc_2')->nullable();
            $table->string('visi_judul')->nullable();
            $table->text('visi_tagline')->nullable();
            $table->text('visi_desc')->nullable();
            $table->string('misi_judul')->nullable();
            $table->text('misi_tagline')->nullable();
            $table->text('misi_desc')->nullable();
            $table->string('foto_visi')->nullable();
            $table->string('foto_misi')->nullable();
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
