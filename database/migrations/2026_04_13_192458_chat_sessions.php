<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->enum('user_role', ['customer', 'admin'])->default('customer');
            $table->integer('session_version')->default(1);
            $table->longText('last_message')->nullable();
            $table->dateTime('context_reset_at')->nullable();
            $table->timestamps();
        });
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->integer('session_version')->default(1)->nullable();
            $table->enum('sender_type', ['user', 'assistant']);
            $table->longText('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
        Schema::dropIfExists('chat_messages');
    }
};
