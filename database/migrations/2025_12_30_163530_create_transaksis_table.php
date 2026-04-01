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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained()->nullOnDelete();
            $table->string('kodeTrx')->unique()->index();
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('ongkir');
            $table->unsignedInteger('total_harga');
            $table->string('metode_bayar');
            $table->unsignedInteger('fee_payment');
            $table->string('tripay_ref');
            $table->enum('status_bayar', ['menunggu pembayaran', 'berhasil', 'kadaluarsa', 'gagal', 'refund'])->default('menunggu pembayaran');
            $table->dateTime('pay_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('transaksi_items', function(Blueprint $table){
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->foreignId('produks_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('harga');
            $table->unsignedInteger('jumlah');
            $table->unsignedInteger('subtotal');
            $table->timestamps();
        });
        Schema::create('transaksi_details', function(Blueprint $table){
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->cascadeOnDelete();
            $table->string('nama_penerima');
            $table->string('no_penerima');
            $table->String('kode_area')->nullable();
            $table->longText('alamat_penerima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('transaksi_items');
        Schema::dropIfExists('transaksi_details');
    }
};
