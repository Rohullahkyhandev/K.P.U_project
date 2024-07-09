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
        Schema::create('farward_documents', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default(0); // not seen yet
            $table->unsignedBigInteger('user_id')->index();
            $table->string('farwarded_part');
            $table->unsignedBigInteger('document_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farward_documents');
    }
};
