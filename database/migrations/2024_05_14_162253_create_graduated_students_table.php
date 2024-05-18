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
        Schema::create('graduated_students', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("lname");
            $table->string("fname");
            $table->string("phone");
            $table->string("email");
            $table->string("address");
            $table->string("nic");
            $table->string("guide_thesis");
            $table->string("thesis_mark");
            $table->string("admission_year");
            $table->string("graduated_year");
            $table->string("percentage");
            $table->string("diplome_id");
            $table->string("status")->default(2);
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
        Schema::dropIfExists('graduated_students');
    }
};
