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
        Schema::create('teacher_in__committees', function (Blueprint $table) {
            $table->id();
            $table->string('documents');
            $table->string('document_path');
            $table->bigInteger('committee_id')->unsigned()->index();
            $table->bigInteger('teacher_id')->unsigned()->index();
            $table->foreign('committee_id')->references('id')->on('committees')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
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
        Schema::dropIfExists('teacher_in__committees');
    }
};
