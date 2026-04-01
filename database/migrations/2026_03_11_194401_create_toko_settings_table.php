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
        Schema::create('toko_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko')->nullable();
            $table->string('email_toko')->nullable();
            $table->string('phone_toko')->nullable();
            $table->longText('path_logo')->nullable();
            $table->string('kode_area')->nullable();
            $table->longText('alamat_toko')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toko_settings');
    }
};
