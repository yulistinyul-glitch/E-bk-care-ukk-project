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
        Schema::table('users', function(Blueprint $table) {
            //email tidak digunakan
            $table->string('email')->nullable()->change();

            $table->string('nipd')->unique();
            $table->string('role')->default('siswa');
            $table->boolean('is_first_login')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
