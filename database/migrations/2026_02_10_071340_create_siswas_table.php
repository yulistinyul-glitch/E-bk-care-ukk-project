<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->string('id_siswa', 6)->primary();

            $table->string('id_pengguna', 6)->unique();
            $table->string('id_kelas', 6); 

            $table->string('nama_siswa', 50);
            $table->char('NIPD', 9);
            $table->char('NISN', 10);
            $table->enum('JK', ['L', 'P']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('no_telp', 20);
            $table->text('alamat');

            $table->timestamps();

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_kelas')
                  ->references('id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
