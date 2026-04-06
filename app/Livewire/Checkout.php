<?php

namespace App\Livewire;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\TripayController;
use App\Http\Controllers\WilayahController;
use App\Models\Keranjang;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Component;

class Checkout extends Component
{
    public $keranjangs;
    public $payment_method;
    public $ongkir = null;
    public $fee_payment = null;
    public $payment_fee_flat = 0;
    public $payment_fee_percent = 0;
    public $subtotal = 0;
    public $total = 0;
    public $provinsi = '';
    public $kota = '';
    public $kecamatan = '';
    public $desa = null;
    public $kodearea = null;
    public $dataProv = [];
    public $dataKota = [];
    public $dataKec = [];
    public $dataDesa = [];
    public $payment = [];
    public function mount(){
        $wilayah = app(WilayahController::class);
        $this->dataProv = $wilayah->provinsi();
        $payment = app(TripayController::class);
        $this->payment = $payment->getPayment();
        $this->payment_method = old('payment_method');
        if ($this->payment_method) {
            $this->setSelectedPaymentFee($this->payment_method);
        }
        $this->hitungTotal();
        if(old('kode_area')){
            $kode_area = explode('.', old('kode_area'));
            $this->provinsi = $kode_area[0];
            $this->updatedProvinsi($this->provinsi);
            $this->kota = $kode_area[0] . '.' .$kode_area[1];
            $this->updatedKota($this->kota);
            $this->kecamatan = $kode_area[0] . '.' .$kode_area[1] . '.' . $kode_area[2];
            $this->updatedKecamatan($this->kecamatan);
            $this->desa = $kode_area[0] . '.' .$kode_area[1] . '.' . $kode_area[2] . '.' . $kode_area[3];
            $this->updatedDesa($this->desa);
        }
    }
    public function hitungTotal(){
        $keranjangs = Keranjang::with(['produks'])->where(
            FacadesAuth::check() ? 'users_id' : 'sessions_id',
            FacadesAuth::check() ? FacadesAuth::id() : session()->getId()
        )->get();
        // Filter hanya produk yang belum di-soft delete dan relasi tidak null
        $this->keranjangs = $keranjangs->filter(function ($item) {
            return $item->produks && (!isset($item->produks->deleted_at) || $item->produks->deleted_at === null);
        })->values();
        $this->subtotal = $this->keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $this->hitungPayment();
        $this->total = $this->subtotal + $this->ongkir + $this->fee_payment;
    }

    public function hitungPayment(){
        if (!$this->payment_method) {
            $this->fee_payment = null;
            return;
        }

        $ongkir = $this->ongkir ?? 0;
        $this->fee_payment = (($this->subtotal + $ongkir) * $this->payment_fee_percent / 100) + $this->payment_fee_flat;
    }

    public function updatedPaymentMethod($paymentMethod)
    {
        $this->setSelectedPaymentFee($paymentMethod);
        $this->hitungTotal();
    }

    protected function setSelectedPaymentFee($paymentMethod)
    {
        $selectedPayment = collect($this->payment['data'] ?? [])->firstWhere('code', $paymentMethod);

        if (!$selectedPayment) {
            $this->payment_fee_flat = 0;
            $this->payment_fee_percent = 0;
            $this->fee_payment = null;
            return;
        }

        $this->payment_fee_flat = (int) ($selectedPayment['total_fee']['flat'] ?? 0);
        $this->payment_fee_percent = (float) ($selectedPayment['total_fee']['percent'] ?? 0);
    }

    public function updatedProvinsi($code_prov){
        $wilayah = app(WilayahController::class);
        $this->dataKota = $wilayah->kota($code_prov);
        $this->kota = '';
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataKec = [];
        $this->dataDesa = [];
        $this->kodearea = null;
        $this->ongkir = null;
        $this->hitungTotal();
    }
    public function updatedKota($code_kota){
        $wilayah = app(WilayahController::class);
        $this->dataKec = $wilayah->kecamatan($code_kota);
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataDesa = [];
        $this->kodearea = null;
        $this->ongkir = null;
        $this->hitungTotal();
    }
    public function updatedKecamatan($code_kec){
        $wilayah = app(WilayahController::class);
        $this->dataDesa = $wilayah->desa($code_kec);
        $this->desa = '';
        $this->kodearea = null;
        $this->ongkir = null;
        $this->hitungTotal();
    }
    public function updatedDesa($code_desa){
        $this->kodearea = $code_desa;
        $cekOngkir = app(ApiController::class);
        $this->ongkir = $cekOngkir->cekOngkir($code_desa);
        $this->hitungTotal();
    }
    
    public function render()
    {
        return view('livewire.checkout');
    }
}
