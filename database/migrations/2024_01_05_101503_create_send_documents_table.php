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
        Schema::create('send_documents', function (Blueprint $table) {
            $table->id();
            $table->string('source', 200);
            $table->string('serial_no', 200);
            $table->string('destination', 200);
            $table->string('description');
            $table->string('remark');
            $table->string('perform_branch', 200);
            $table->string('attachment_branch', 200);
            $table->string('date_of_sent', 100);
            $table->string('document_date', 100);
            $table->text('pages_no', 100);
            $table->string('volume', 100);
            $table->string('attachment');
            $table->string('attachment_path');
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
        Schema::dropIfExists('send_documents');
    }
};
