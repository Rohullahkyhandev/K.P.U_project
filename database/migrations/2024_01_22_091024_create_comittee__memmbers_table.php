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
        Schema::create('comittee__memmbers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('phone', 100);
            $table->string('email', 100);
            $table->string('address', 200);
            $table->bigInteger('commitee_id')->unsigned()->index();
            $table->foreign('commitee_id')->references('id')->on('committees');
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
        Schema::dropIfExists('comittee__memmbers');
    }
};
