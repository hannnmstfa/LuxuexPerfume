<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
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
}
