<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index(){
        $cek = Keranjang::where('users_id', auth()->id())->exists();
        if (!$cek) {
            Alert::warning('Keranjang Kosong !!!', 'Silahkan menambahkan beberapa produk kedalam keranjang terlebih dahulu.');
            return to_route('produk');
        }
        return view('afterlogin.checkout.index');
    }
    public function store(Request $request){
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_penerima' => ['required', 'string', 'regex:/^08[0-9]{8,11}/'],
            'kode_area' => 'required|string',
            'alamat' => 'required|string',
            'payment_method' => 'required|string',
        ], [
            'payment_method.required' => 'Silahkan Pilih metode pembayaran terlebih dahulu'
        ]);
        $kodeTrx = 'LX' . date('YmdHis');
        $keranjangs = Keranjang::where('users_id', auth()->id())->get();
        $orderItems = [];
        foreach ($keranjangs as $item) {
            $orderItems[] = [
                'name' => $item->produks->nama,
                'price' => $item->produks->harga_diskon
                    ? $item->produks->harga_diskon
                    : $item->produks->harga,
                'quantity' => $item->jumlah,
            ];
        }
        $orderItems[] = [
            'name' => 'Ongkir',
            'price' => 15000,
            'quantity' => 1,
        ];
        $subtotal = $keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $ongkir = 15000;
        $amount = $subtotal + $ongkir;
        $tripay = new TripayController();
        $data_tripay = $tripay->createTrx($request->payment_method, $kodeTrx, $amount, $orderItems);
        $trx = Transaksi::create([
            'users_id' => auth()->id(),
            'kodeTrx' => $kodeTrx,
            'subtotal' => $subtotal,
            'ongkir' => $ongkir,
            'total_harga' => $amount,
            'metode_bayar' => $data_tripay['data']['payment_name'],
            'fee_payment' => $data_tripay['data']['total_fee'],
            'tripay_ref' => $data_tripay['data']['reference'],
        ]);
        foreach ($keranjangs as $item) {
            TransaksiItem::create([
                'transaksi_id' => $trx->id,
                'produks_id' => $item->produks_id,
                'harga' => $item->produks->harga_diskon
                    ? $item->produks->harga_diskon
                    : $item->produks->harga,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->produks->harga_diskon
                    ? $item->produks->harga_diskon
                    : $item->produks->harga + $item->jumlah,
            ]);
            $item->delete();
        }
        TransaksiDetail::create([
            'transaksi_id' => $trx->id,
            'nama_penerima' => $request->nama_penerima,
            'no_penerima' => $request->no_penerima,
            'kode_area' => $request->kode_area,
            'alamat_penerima' => $request->alamat,
        ]);
        Alert::success('Pesanan Dibuat', 'Selesaikan pembayaran agar pesananmu segera diproses');
        return to_route('trx.pay', $kodeTrx);
    }
}
