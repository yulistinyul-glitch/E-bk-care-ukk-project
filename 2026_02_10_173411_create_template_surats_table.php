<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('template_surats', function (Blueprint $table) {

            $table->string('id_template', 8)->primary();

            $table->string('id_admin', 6);
            $table->string('nama_template', 100);
            $table->string('jenis_template', 10);
            $table->string('file'); 

            $table->timestamps();

            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admins')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('template_surats');
    }
};
