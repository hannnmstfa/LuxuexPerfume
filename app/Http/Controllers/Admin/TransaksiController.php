<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RajaOngkirController;
use App\Mail\Pesanan;
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
        foreach ($trx->trackings->trackings_details as $trackLama) {
            $trackLama->delete();
        }
        $rajaongkir = new RajaOngkirController();
        $respon = $rajaongkir->cekResi($request->resi, $request->layanan, $trx->trackings->last_phone);
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
        $trx->trackings->update([
            'resi' => $request->resi,
            'ekspedisi' => $request->layanan,
            'status' => 'dalam pengiriman',
        ]);
        if ($respon['data']['delivered']) {
            $trx->trackings->update([
                'status' => 'pengiriman selesai'
            ]);
        }
        // $datas = file_get_contents(public_path('assets/contoh.json'));
        // $datas = json_decode($datas, true);
        // foreach ($datas['data']['manifest'] as $data) {
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
