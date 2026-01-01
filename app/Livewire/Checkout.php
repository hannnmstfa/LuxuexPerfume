<?php

namespace App\Livewire;

use App\Http\Controllers\WilayahController;
use App\Models\Keranjang;
use Livewire\Component;

class Checkout extends Component
{
    public $keranjangs;
    public $ongkir = 15000;
    public $subtotal = 0;
    public $total = 0;
    public $provinsi = '';
    public $kota = '';
    public $kecamatan = '';
    public $desa = '';
    public $dataProv = [];
    public $dataKota = [];
    public $dataKec = [];
    public $dataDesa = [];
    public function mount(){
        $wilayah = app(WilayahController::class);
        $this->dataProv = $wilayah->provinsi();
        $this->keranjangs = Keranjang::with(['produks'])->where('users_id', auth()->id())->get();
        $this->subtotal = $this->keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $this->total = $this->subtotal + $this->ongkir;
    }
    public function updatedProvinsi($code_prov){
        $wilayah = app(WilayahController::class);
        $this->dataKota = $wilayah->kota($code_prov);
        $this->kota = '';
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataKec = [];
        $this->dataDesa = [];
    }
    public function updatedKota($code_kota){
        $wilayah = app(WilayahController::class);
        $this->dataKec = $wilayah->kecamatan($code_kota);
        $this->kecamatan = '';
        $this->desa = '';
        $this->dataDesa = [];
    }
    public function updatedKecamatan($code_kec){
        $wilayah = app(WilayahController::class);
        $this->dataDesa = $wilayah->desa($code_kec);
        $this->desa = '';
    }
    
    public function render()
    {
        return view('livewire.checkout');
    }
}
