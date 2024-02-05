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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('Person ID', 100)->nullable();
            $table->string('Name', 100)->nullable();
            $table->string('Department', 100)->nullable();
            $table->string('Position', 100)->nullable();
            $table->string('Gender', 100)->nullable();
            $table->string('Date', 100)->nullable();
            $table->string('Week', 100)->nullable();
            $table->string('Timetable', 100)->nullable();
            $table->string('Check-in', 100)->nullable();
            $table->string('Check-out', 100)->nullable();
            $table->string('Work', 100)->nullable();
            $table->string('OT', 100)->nullable();
            $table->string('Attended', 100)->nullable();
            $table->string('Late', 100)->nullable();
            $table->string('Early', 100)->nullable();
            $table->string('Absent', 100)->nullable();
            $table->string('Leave', 100)->nullable();
            $table->string('Status', 100)->nullable();
            $table->string('Records', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
