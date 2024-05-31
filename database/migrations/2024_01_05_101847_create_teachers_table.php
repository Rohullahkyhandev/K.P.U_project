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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('code_bast', 100);
            $table->string('education_field', 100);
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('fatherName', 100);
            $table->string('grandFathername', 100);
            $table->string('email', 100);
            $table->string('phone', 100);
            $table->string('gender', 100);
            $table->string('birth_date', 100);
            $table->string('main_address', 200);
            $table->string('current_address', 200);
            $table->string('hire_date', 100);
            $table->string('nic', 100);
            $table->string('status', 10)->default('1');
            $table->string('academic_rank', 100);
            $table->string('photo');
            $table->string('photo_path');
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
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
        Schema::dropIfExists('teachers');
    }
};
