<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RajaOngkirController;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function index()
    {
        $datas = Transaksi::with('users')
            ->with('trackings')
            ->orderByDesc('created_at')->get();
        return view('admin.transaksi.index', compact('datas'));
    }
    public function show($kodeTrx)
    {
        $trx = Transaksi::with(['transaksi_items', 'transaksi_details', 'trackings', 'users'])
            ->where('kodeTrx', $kodeTrx)->first();
        return view('admin.transaksi.detail', compact('trx'));
    }
    public function tracking(Request $request, $kodeTrx)
    {
        $request->validate([
            'layanan' => 'required|string',
            'resi' => 'required|string',
        ]);
        $trx = Transaksi::with(['trackings', 'transaksi_details'])
            ->where('kodeTrx', $kodeTrx)
            ->where('status_bayar', 'berhasil')
            ->firstOrFail();
        $rajaongkir = new RajaOngkirController();
        // $respon = $rajaongkir->cekResi($request->resi, $request->layanan, substr($trx->transaksi_details->no_penerima, -4));
        $respon = json_decode(file_get_contents(public_path('/assets/contoh.json')), true);
        // $respon = json_decode(file_get_contents(public_path('/assets/contoh_gagal.json')), true);
        if(!$respon['data']){
            Alert::error('Error !!!', $respon['meta']['message']);
            return back();
        }
        dd($respon);
    }
}
