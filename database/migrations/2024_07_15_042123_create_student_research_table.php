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
        Schema::create('student_research', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('date');
            $table->string('description');
            $table->bigInteger('program_id')->unsigned()->index();
            $table->foreign('program_id')->references('id')->on('post_graduated_programs')->onDelete('cascade');

            $table->bigInteger('student_id')->unsigned()->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('attachment');
            $table->string('attachment_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_research');
    }
};
