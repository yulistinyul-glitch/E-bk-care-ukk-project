<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('gurubks', function (Blueprint $table) {
        $table->string('id_gurubk', 6)->primary();
        $table->string('id_pengguna', 6)->unique(); // FK ke users
        $table->char('NIP', 18)->unique();
        $table->string('nama_gurubk', 50);
        $table->enum('JK', ['L', 'P']);
        $table->string('no_telp', 20);
        $table->string('email', 100)->unique();
        $table->text('alamat');
        $table->timestamps();

        $table->foreign('id_pengguna')
            ->references('id_pengguna')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gurubks');
    }
};
