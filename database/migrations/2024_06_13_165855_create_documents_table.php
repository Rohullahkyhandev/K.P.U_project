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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('title');
            $table->string('source');
            $table->string('destination');
            $table->string('type');
            $table->string('date', 100);
            $table->string('attachment');
            $table->string('attachment_path');
            $table->string('description', 100)->nullable();
            $table->string('remark', 100);
            $table->string('part_type', 100)->nullable();
            $table->bigInteger('dep_id')->unsigned()->nullable()->index();
            $table->foreign('dep_id')->references('id')->on('chance__amiryats')->onDelete("cascade");
            $table->bigInteger('faculty_id')->nullable()->unsigned()->index();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->bigInteger('department_id')->nullable()->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('documents');
    }
};
