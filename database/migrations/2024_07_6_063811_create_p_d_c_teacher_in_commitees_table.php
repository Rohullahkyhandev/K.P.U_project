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
        Schema::create('p_d_c_teacher_in_commitees', function (Blueprint $table) {
            $table->id();
            $table->string('department_type', 100)->nullable();
            $table->bigInteger('commit_id')->unsigned()->index();
            $table->unsignedBigInteger('faculty_id')->index()->nullable();
            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('commit_id')->references('id')->on('p_d__committees')->onDelete('cascade');
            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->string("attachment");
            $table->string("attachment_path");
            $table->bigInteger("user_id")->unsigned()->index();
            $table->foreign("user_id")->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_d_c_teacher_in_commitees');
    }
};
