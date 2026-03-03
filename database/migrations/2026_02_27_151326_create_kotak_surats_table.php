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
        Schema::create('kotak_surats', function (Blueprint $table) {
            $table->id();
            $table->string('id_siswa', 6);
            $table->foreignId('session_id')->nullable()->constrained('counseling_sessions')->onDelete('cascade');
            $table->string('subject'); 
            $table->text('message');  
            $table->timestamp('read_at')->nullable(); 
            $table->enum('type', ['info', 'warning', 'success'])->default('info');
            $table->timestamps();
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kotak_surats');
    }
};
