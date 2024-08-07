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
        Schema::create('post_commits', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('director', 100);
            $table->string('faculty', 100);
            $table->string('metting_place', 100);
            $table->string('secretary_phone', 100);
            $table->string('secretary', 100);
            $table->string('metting_per_month', 100);
            $table->string('director_phone', 100);
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
        Schema::dropIfExists('post_commits');
    }
};
