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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->string('resi')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->string('last_phone');
            $table->enum('status', ['sedang dikemas', 'dalam pengiriman', 'pengiriman selesai'])->default('sedang dikemas');
            $table->dateTime('received_at')->nullable();
            $table->timestamps();
        });

        Schema::create('tracking_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trackings_id')->constrained()->cascadeOnDelete();
            $table->longText('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
        Schema::dropIfExists('tracking_details');
    }
};
