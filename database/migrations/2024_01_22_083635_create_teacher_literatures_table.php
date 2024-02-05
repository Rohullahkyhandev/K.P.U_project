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
        Schema::create('teacher_literatures', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 200);
            $table->string('date', 100);
            $table->string('publisher', 200);
            $table->$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_literatures');
    }
};
