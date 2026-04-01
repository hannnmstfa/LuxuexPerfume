<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\TokoSetting;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index()
    {
        $cek = Keranjang::where('users_id', Auth::id())->get();
        $cek = $cek->filter(function ($item) {
            return $item->produks && (!isset($item->produks->deleted_at) || $item->produks->deleted_at === null);
        })->values();
        if ($cek->count() < 1) {
            Alert::warning('Keranjang Kosong !!!', 'Silahkan menambahkan beberapa produk kedalam keranjang terlebih dahulu.');
            return to_route('produk');
        }
        if (!TokoSetting::data() || !TokoSetting::data()->kode_area) {
            Alert::error('Gagal Checkout', 'Silahkan hubungi Customer Service jika masalah terus berlanjut');
            return to_route('keranjang');
        }
        $tripay = new TripayController();
        $payment = $tripay->getPayment();
        if (!$payment['success']) {
            Alert::error('Error Payment !!!', $payment['message']);
            return to_route('keranjang');
        }
        return view('afterlogin.checkout');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string',
            'no_penerima' => ['required', 'string', 'regex:/^08[0-9]{8,11}/'],
            'kode_area' => 'required|string',
            'alamat' => 'required|string',
            'ongkir' => 'required|integer',
            'payment_method' => 'required|string',
        ], [
            'kode_area.required' => 'Silahkan pilih area terlebih dahulu',
            'payment_method.required' => 'Silahkan Pilih metode pembayaran terlebih dahulu'
        ]);
        dd($request->all());
        $kodeTrx = 'LX' . date('YmdHis');
        $keranjangs = Keranjang::with('produks')->where('users_id', Auth::id())->get();
        $keranjangs = $keranjangs->filter(function ($chart) {
            return $chart->produks && (!isset($chart->produks->deleted_at) || $chart->produks->deleted_at === null);
        })->values();
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
            'users_id' => Auth::user()->id,
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
                    : $item->produks->harga * $item->jumlah,
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
