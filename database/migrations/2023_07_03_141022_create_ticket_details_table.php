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
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->uuid();
            $table->timestamps();
            $table->foreignid('ticket_id');
            $table->foreign('ticket_id')->references('support_ticket')->on('id')->onDelete('cascade');
            $table->string('action', 1)->default('M'); //L - log M - message
            $table->text('message');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('users')->on('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_details');
    }
};
