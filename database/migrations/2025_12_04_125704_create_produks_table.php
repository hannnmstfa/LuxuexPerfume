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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();
            $table->string('nama');
            $table->enum('kategori', ['pria', 'wanita']);
            $table->longText('deskripsi');
            $table->integer('harga');
            $table->integer('harga_diskon')->nullable();
            $table->longText('path_foto');
            $table->timestamps();
        });

        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produks_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
        Schema::dropIfExists('stocks');
    }
};
