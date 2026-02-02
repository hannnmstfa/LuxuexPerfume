<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function trxPayment($kodeTrx){
        $trx = Transaksi::where('kodeTrx', $kodeTrx)->firstOrfail();
        $tripay = new TripayController();
        $detail_tripay = $tripay->detailTrx($trx->tripay_ref);
        if(!$detail_tripay['success']){
            Alert::error($detail_tripay['message']);
        }
        return view('afterlogin.transaksi.bayar', compact('trx', 'detail_tripay'));
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
}
