<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->string('id_notifikasi', 8)->primary();

            $table->string('id_pengguna', 6);
            $table->string('judul_pesan', 100);
            $table->text('isi_pesan');
            $table->dateTime('tanggal_kirim')->useCurrent();

            $table->enum('status_baca', ['unread', 'read'])
                  ->default('unread');

            $table->timestamps();

            $table->foreign('id_pengguna')
                  ->references('id_pengguna')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
