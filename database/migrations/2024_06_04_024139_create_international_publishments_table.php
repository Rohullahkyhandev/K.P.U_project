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
        Schema::create('international_publishments', function (Blueprint $table) {
            $table->id();
            $table->string('author', 100);
            $table->string('author_assesstance', 100);
            $table->string('title', 100);
            $table->string('journal_name', 100);
            $table->string('journal_link_website');
            $table->json('attachments');
            $table->json('attachment_paths');
            $table->bigInteger('faculty_id')->unsigned()->index();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade');
            $table->bigInteger('department_id')->unsigned()->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('international_publishments');
    }
};
