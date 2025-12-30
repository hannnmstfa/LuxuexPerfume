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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->string('kodeTrx')->unique()->index();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('transaksi_details', function(Blueprint $table){
            $table->id();
            $table->foreignId('transaksis_id')->constrained()->cascadeOnDelete();
            $table->string('nama_penerima');
            $table->
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
