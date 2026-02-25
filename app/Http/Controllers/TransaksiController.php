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
        $respon = $tripay->detailTrx($trx->tripay_ref);
        if(!$respon['success']){
            Alert::error($respon['message']);
            return to_route('trx.show', $kodeTrx);
        }
        $tripay = (object) $respon['data'];
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
}
