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
        Schema::create('teacher_in__workshops', function (Blueprint $table) {
            $table->id();
            $table->string('document');
            $table->string('department_type', 100);
            $table->string('document_path');
            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->bigInteger('workshop_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->unsignedBigInteger('faculty_id')->index()->nullable();
            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_in__workshops');
    }
};
