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
        Schema::create('counseling_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('counseling_requests')->onDelete('cascade');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('location_link')->nullable();
            $table->enum('status', ['dijadwalkan', 'selesai', 'dibatalkan', 'absen'])->default('dijadwalkan');
            $table->text('note_guru')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counseling_sessions');
    }
};
