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
        Schema::create('teacher_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('education_', 100);
            $table->string('graduated_year', 100);
            $table->string('university', 100);
            $table->string('country', 100);
            $table->string('description');
            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->foreign('teacher_id')->references('id')->on('teachers');
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
        Schema::dropIfExists('teacher_qualifications');
    }
};
