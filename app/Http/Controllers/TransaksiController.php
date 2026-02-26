<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function trxPayment($kodeTrx){
        $trx = Transaksi::where('kodeTrx', $kodeTrx)->firstOrfail();
        if($trx->status_bayar == 'berhasil'){
            Alert::success('Pembayaran Berhasil', 'Pesanan anda akan segera diproses.');
            return to_route('trx.show', $kodeTrx);
        }
        $tripay = new TripayController();
        $respon = $tripay->detailTrx($trx->tripay_ref);
        if(!$respon['success']){
            Alert::error($respon['message']);
            return to_route('trx.show', $kodeTrx);
        }
        $tripay = (object) $respon['data'];
        // dd($tripay);
        return view('afterlogin.transaksi.bayar', compact('trx', 'tripay'));
    }
    public function index(){
        $datas = Transaksi::where('users_id', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('afterlogin.transaksi.index', compact('datas'));
    }
    public function show($kodeTrx){
        $trx = Transaksi::with(['transaksi_items', 'transaksi_details', 'trackings'])
        ->where('kodeTrx', $kodeTrx)
        ->firstOrFail();
        return view('afterlogin.transaksi.detail', compact('trx'));
    }
    public function downloadQris($kodeTrx){
        $trx = Transaksi::where('kodeTrx', $kodeTrx)->firstOrfail();
        $tripay = new TripayController();
        $tripay = $tripay->detailTrx($trx->tripay_ref);
        $response = Http::get($tripay['data']['qr_url']);
        $fileName = config('app.name') . '_qris_' . time() . '.png';
        return response($response->body(), 200)
        ->header('Content-Type', 'image/png')
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
