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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('position', 100);
            $table->string('photo');
            $table->string('photo_path');
            $table->string('user_type', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('is_admin')->default('1');
            $table->bigInteger('dep_id')->unsigned()->nullable()->index();
            $table->foreign('dep_id')->references('id')->on('chance__amiryats')->onDelete("cascade");
            $table->bigInteger('faculty_id')->nullable()->unsigned()->index();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->bigInteger('department_id')->nullable()->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
