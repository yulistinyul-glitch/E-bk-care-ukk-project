<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::table('self_reports', function (Blueprint $table) {
            // Hapus ->after('id')
            $table->string('id_siswa'); 
        });
    }
};
