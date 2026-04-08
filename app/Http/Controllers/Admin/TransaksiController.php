<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RajaOngkirController;
use App\Mail\Pesanan;
use App\Models\Tracking;
use App\Models\TrackingDetails;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Storage\AlertSessionStore;

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
        // confirmDelete('sdfdfdf', 'fdfdfdfd');
        $trx = Transaksi::with(['transaksi_items', 'transaksi_details', 'trackings', 'users'])
            ->where('kodeTrx', $kodeTrx)->first();
        if (!$trx) {
            abort(404, 'Transaksi tidak ditemukan');
        }
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
            ->first();
        if ($trx->trackings) {
            foreach ($trx->trackings->trackings_details as $trackLama) {
                $trackLama->delete();
            }
        }
        $rajaongkir = new RajaOngkirController();
        $respon = $rajaongkir->cekResi($request->resi, $request->layanan, $trx->trackings->last_phone ?? substr($trx->transaksi_details->no_penerima, -5));
        // dd($respon);
        if (!$respon['data']) {
            $trx->trackings->update([
                'resi' => $request->resi,
                'ekspedisi' => $request->layanan,
                'status' => 'sedang dikemas',
            ]);
            Alert::error('Error: ' . $respon['meta']['message']);
            return back()->withInput();
        }
        if (!$trx->trackings) {
            Tracking::create([
                'transaksi_id' => $trx->id,
                'resi' => $request->resi,
                'ekspedisi' => $request->layanan,
                'status' => 'dalam pengiriman',
                'last_phone' => substr($trx->transaksi_details->no_penerima, -5),
            ]);
        } else {
            $trx->trackings->update([
                'resi' => $request->resi,
                'ekspedisi' => $request->layanan,
                'status' => 'dalam pengiriman',
            ]);
        }
        if ($respon['data']['delivered']) {
            if (isset($respon['data']['delivery_status'])) {
                if (str_contains($respon['data']['delivery_status']['pod_date'], ' ')) {
                    $datetime = $respon['data']['delivery_status']['pod_date'];
                } else {
                    $manifestTime = $respon['data']['delivery_status']['pod_time'] ?? '00:00:00';
                    $datetime = trim($respon['data']['delivery_status']['pod_date'] . ' ' . $manifestTime);
                }
            } else {
                $datetime = now();
            }
            $trx->trackings->update([
                'status' => 'pengiriman selesai',
                'received_at' => $datetime,
            ]);
        }
        foreach ($respon['data']['manifest'] as $data) {
            if (isset($data['manifest_date'])) {
                if (str_contains($data['manifest_date'], ' ')) {
                    $datetime = $data['manifest_date'];
                } else {
                    $manifestTime = $data['manifest_time'] ?? '00:00:00';
                    $datetime = trim($data['manifest_date'] . ' ' . $manifestTime);
                }
            } else {
                $datetime = now();
            }
            TrackingDetails::forceCreate([
                'trackings_id' => $trx->trackings->id,
                'deskripsi' => $data['manifest_description'],
                'created_at' => $datetime,
            ]);
        }

        Alert::success('Sukses', 'Berhasil menambahkan resi pengiriman');
        return back();
    }
}
