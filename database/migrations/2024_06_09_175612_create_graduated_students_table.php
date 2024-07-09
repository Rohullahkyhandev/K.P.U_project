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
        Schema::create('graduated_students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('fname');
            $table->string('percentage', 10);
            $table->string('diplome_id', 20);
            $table->string('graduated_year', 100);
            $table->string('thesis_mark', 10);
            $table->string('thesis_guide_teacher');
            $table->string('attribute');
            $table->bigInteger('program_id')->unsigned()->index();
            $table->foreign('program_id')->references('id')->on('post_graduated_programs')->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduated_students');
    }
};
