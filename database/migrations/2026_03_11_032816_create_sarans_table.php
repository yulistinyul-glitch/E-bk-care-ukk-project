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
        if (!Schema::hasTable('sarans')) {
        Schema::create('sarans', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa', 6)->nullable();
            $table->string('target');
            $table->text('message');
            $table->boolean('is_anonymous')->default(true);
            $table->enum('status', ['unread', 'read', 'archived'])->default('unread');
            $table->timestamps();

            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('set null');
        });

        } 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarans');
    }
};

