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
        Schema::table('chats', function (Blueprint $table) {
        // Tambah kolom file_path jika belum ada
        if (!Schema::hasColumn('chats', 'file_path')) {
            $table->string('file_path')->nullable()->after('message');
        }
        
        $table->string('sender_type')->change(); 
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chats', function (Blueprint $table) {
        $table->dropColumn('file_path');
     });
    }
};
