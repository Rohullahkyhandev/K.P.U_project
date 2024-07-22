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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('fname', 100);
            $table->string('position', 100);
            $table->string('salary', 100);
            $table->string('main_address', 100);
            $table->string('current_address', 100);
            $table->string('nic', 100);
            $table->string('email', 100)->nullable();
            $table->string('phone', 100);
            $table->string('hire_date', 100);
            $table->string('gender', 100);
            $table->string('photo');
            $table->string('photo_path');
            $table->string('date_of_birth', 100);
            $table->string('status')->default('active');
            $table->string('fire_date')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
