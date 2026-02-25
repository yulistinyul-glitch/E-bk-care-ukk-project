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
        Schema::table('pelanggarans', function (Blueprint $table) {
            // Menambahkan kolom deleted_at untuk fitur Soft Delete
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggarans', function (Blueprint $table) {
            // Menghapus kolom deleted_at jika migration di-rollback
            $table->dropSoftDeletes();
        });
    }
};