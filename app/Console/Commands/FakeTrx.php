<?php

namespace App\Console\Commands;

use App\Http\Controllers\TripayController;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiItem;
use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;

class FakeTrx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trx:create {jumlah}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Buat fake transaksi untuk testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $products = Produk::all();
        $tripay = new TripayController();
        $paymentAll = $tripay->getPayment();
        $jumlah = (int) $this->argument('jumlah');
        $this->info("Membuat $jumlah transaksi fake...");
        $this->info("=====================================================");

        for ($i = 1; $i <= $jumlah; $i++) {
            $kodeTrx = 'LX' . date('YmdHis') . rand(1, 9);
            $jumlahProduk = rand(1, min(5, $products->count()));
            $user = $users->random();
            $payment = $paymentAll['data'][rand(0, count($paymentAll['data']) - 1)];
            $itemSelected = $products->random($jumlahProduk);

            $orderItems = [];
            $keranjang = [];
            $subtotal = 0;
            foreach ($itemSelected as $product) {
                $keranjang[] = [
                    'sku' => $product->id,
                    'name' => $product->nama,
                    'price' => $product->harga_diskon ?? $product->harga,
                    'quantity' => rand(1, 9),
                ];
                $subtotal = $subtotal + (($product->harga_diskon ?? $product->harga) * $keranjang[count($keranjang) - 1]['quantity']);

            }
            $ongkir = rand(15000, 50000);
            $orderItems = array_merge($keranjang, [
                [
                    'sku' => '9999',
                    'name' => 'Ongkir',
                    'price' => $ongkir,
                    'quantity' => 1,
                ]
            ]);
            $amount = $subtotal + $ongkir;
            $data_tripay = $tripay->createTrx($payment['code'], $kodeTrx, $amount, $orderItems);
            $trx = Transaksi::create([
                'users_id' => $user->id,
                'kodeTrx' => $kodeTrx,
                'subtotal' => $subtotal,
                'ongkir' => $ongkir,
                'total_harga' => $amount,
                'metode_bayar' => $data_tripay['data']['payment_name'],
                'fee_payment' => $data_tripay['data']['total_fee'],
                'tripay_ref' => $data_tripay['data']['reference'],
            ]);
            foreach ($keranjang as $item) {
                TransaksiItem::create([
                    'transaksi_id' => $trx->id,
                    'produks_id' => $item['sku'],
                    'harga' => $item['price'],
                    'jumlah' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }
            $faker = Factory::create('id_ID');
            TransaksiDetail::create([
                'transaksi_id' => $trx->id,
                'nama_penerima' => $faker->words(3, true),
                'no_penerima' => $faker->phoneNumber(),
                'kode_area' => '62.02.07.2003',
                'alamat_penerima' => $faker->address(),
            ]);
            $this->info("$i. $kodeTrx");
        }


        return Command::SUCCESS;
    }
}
