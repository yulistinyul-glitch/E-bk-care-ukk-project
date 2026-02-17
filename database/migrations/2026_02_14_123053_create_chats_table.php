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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('konseling_id', 8);
            $table->enum('sender_type', ['siswa', 'gurubk', 'bot']);
            $table->text('message');
            $table->boolean('is_read')->default(0);
            $table->timestamps();

            $table->foreign('konseling_id')
                  ->references('id_konseling')
                  ->on('konselings')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
