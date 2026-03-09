<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
        $table->id();
        $table->string('section'); 
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('icon')->nullable();
        $table->string('image')->nullable();
        $table->integer('order')->default(0);
        $table->timestamps();
        });
    }
};
