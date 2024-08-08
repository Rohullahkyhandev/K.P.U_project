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
        Schema::create('experiment_details', function (Blueprint $table) {
            $table->id();
            $table->string('experiment_name');
            $table->string('related_part');
            $table->string('related_image');
            $table->string('related_image_path');
            $table->string('standard_id');
            $table->string('scope_part');
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
        Schema::dropIfExists('experiment_details');
    }
};
