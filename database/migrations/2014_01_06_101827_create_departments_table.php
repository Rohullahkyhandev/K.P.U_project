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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('date', 100);
            $table->string('manger_name', 100);
            $table->string('manager_lname', 100);
            $table->string('photo');
            $table->string('photo_path');
            $table->string('description');
            $table->bigInteger('faculty_id')->nullable()->unsigned()->index();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
