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
        Schema::create('teacher_research', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('fname', 100);
            $table->string('academic_rank', 100);
            $table->string('education_degree', 100);
            $table->string('research_title');
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_research');
    }
};
