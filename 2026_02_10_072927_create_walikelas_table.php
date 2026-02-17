<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('walikelas', function (Blueprint $table) {
            $table->string('id_walikelas', 6)->primary();

            $table->string('id_kelas', 6)->unique(); 
            $table->char('NIP', 18)->unique();
            $table->string('nama_guru', 50);
            $table->enum('JK', ['L', 'P']);
            $table->string('no_telp', 20);
            $table->string('email', 100)->unique();
            $table->text('alamat');

            $table->timestamps();

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('walikelas');
    }
};
