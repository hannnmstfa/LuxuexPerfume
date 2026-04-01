<?php

namespace App\Livewire;

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
    public $ongkir = 1;
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
        $this->total = $this->subtotal + $this->ongkir;
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
    // public function hitungPayment(int $flat = 0, float $percent = 0){
    //     $this->fee_payment = 0;
    //     $this->fee_payment = (($this->subtotal + $this->ongkir) * $percent / 100) + $flat;
    //     $this->total = $this->subtotal + $this->ongkir + $this->fee_payment;
    // }
    public function updatedProvinsi($code_prov){
        $wilayah = app(WilayahController::class);
        $this->dataKota = $wilayah->kota($code_prov);
        $this->kota = '';
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataKec = [];
        $this->dataDesa = [];
        $this->kodearea = null;
    }
    public function updatedKota($code_kota){
        $wilayah = app(WilayahController::class);
        $this->dataKec = $wilayah->kecamatan($code_kota);
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataDesa = [];
        $this->kodearea = null;
    }
    public function updatedKecamatan($code_kec){
        $wilayah = app(WilayahController::class);
        $this->dataDesa = $wilayah->desa($code_kec);
        $this->desa = '';
        $this->kodearea = null;
    }
    public function updatedDesa($code_desa){
        $this->kodearea = $code_desa;
    }
    
    public function render()
    {
        return view('livewire.checkout');
    }
}
