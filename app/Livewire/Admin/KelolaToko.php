<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\WilayahController;
use App\Models\TokoSetting;
use Livewire\Component;

class KelolaToko extends Component
{
    public $provinsi = '';
    public $kota = '';
    public $kecamatan = '';
    public $desa = '';
    public $kodearea = null;
    public $dataProv = [];
    public $dataKota = [];
    public $dataKec = [];
    public $dataDesa = [];
    public $toko = [];
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
    public function mount(){
        $wilayah = app(WilayahController::class);
        $this->dataProv = $wilayah->provinsi();
        $this->toko = TokoSetting::first();
        if($this->toko && $this->toko->kode_area !== null){
            $this->kodearea = $this->toko->kode_area ?? null;
            $kode_area = explode('.', $this->kodearea);
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
    public function render()
    {
        return view('livewire.admin.kelola-toko');
    }
}
