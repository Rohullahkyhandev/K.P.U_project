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
        Schema::create('scholarships', function (Blueprint $table) {

            $table->id();
            $table->string('country_name', 100);
            $table->string('edu_degree', 100);
            $table->string('edu_maqta', 100);
            $table->string('sent_date', 100);
            $table->string('back_date', 100);
            $table->string('documents');
            $table->string('document_path');
            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->bigInteger('faculty_id')->unsigned()->index()->nullable();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('scholarships');
    }
};
