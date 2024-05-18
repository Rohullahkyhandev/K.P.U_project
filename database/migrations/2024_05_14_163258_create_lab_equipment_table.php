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
        Schema::create('lab_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string("quantity");
            $table->string("entry_date");
            $table->string("status")->default(1);
            $table->bigInteger('lab_id')->unsigned()->index();
            $table->foreign('lab_id')->references('id')->on('laboratories')->onDelete("cascade");
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
        Schema::dropIfExists('lab_equipment');
    }
};
