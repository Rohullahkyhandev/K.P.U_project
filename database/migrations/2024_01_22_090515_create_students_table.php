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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('lname', 100);
            $table->string('fname', 100);
            $table->string('phone', 100);
            $table->string('email', 100);
            $table->string('kankor_id', 100);
            $table->string('kankor_mark', 100);
            $table->string('bachelor_field', 100);
            $table->string('status')->default(1);
            $table->string('nic', 100);
            $table->string('address', 100);
            $table->string('admission_year', 100);
            $table->string('blood_group', 100);
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('program_id')->unsigned()->index();
            $table->foreign('program_id')->references('id')->on('post_graduated_programs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
