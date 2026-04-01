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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->unique('transaksi_id');
            $table->longText('deskripsi');
            $table->longText('video_unboxing');
            $table->json('foto_pendukung')->nullable();
            $table->longText('catatan')->nullable();
            $table->enum('status', ['ditinjau','diterima', 'ditolak'])->default('ditinjau');
            $table->enum('type', ['pengembalian dana','kirim barang baru']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
