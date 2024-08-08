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
        Schema::create('research_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('scope_of_project');
            $table->string('related_image');
            $table->string('related_image_path');
            $table->text('description');
            $table->string('date', 100);
            $table->bigInteger('lab_id')->unsigned()->index();
            $table->foreign('lab_id')->references('id')->on('reasearch_labs')->onDelete('cascade');
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
        Schema::dropIfExists('research_projects');
    }
};
