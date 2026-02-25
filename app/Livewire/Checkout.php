<?php

namespace App\Livewire;

use App\Http\Controllers\TripayController;
use App\Http\Controllers\WilayahController;
use App\Models\Keranjang;
use Livewire\Component;

class Checkout extends Component
{
    public $keranjangs;
    public $payment_method;
    public $ongkir = 15000;
    // public $fee_payment = 0;
    public $subtotal = 0;
    public $total = 0;
    public $provinsi = '';
    public $kota = '';
    public $kecamatan = '';
    public $desa = '';
    public $kodearea = null;
    public $dataProv = [];
    public $dataKota = [];
    public $dataKec = [];
    public $dataDesa = [];
    public $payment = [];
    public function mount(){
        $wilayah = app(WilayahController::class);
        $tripay = app(TripayController::class);
        $this->payment = $tripay->getPayment();
        $this->dataProv = $wilayah->provinsi();
        $this->keranjangs = Keranjang::with(['produks'])->where('users_id', auth()->id())->get();
        $this->subtotal = $this->keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $this->total = $this->subtotal + $this->ongkir;
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
