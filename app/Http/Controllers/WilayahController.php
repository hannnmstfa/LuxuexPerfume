<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WilayahController extends Controller
{
    public function provinsi()
    {
        return Http::get('https://wilayah.id/api/provinces.json')->json();
    }
    public function kota($code_prov){
        return Http::get('https://wilayah.id/api/regencies/'. $code_prov .'.json')->json();
    }
    public function kecamatan($code_kec){
        return Http::get('https://wilayah.id/api/districts/'. $code_kec .'.json')->json();
    }
    public function desa($code_desa){
        return Http::get('https://wilayah.id/api/villages/'. $code_desa .'.json')->json();
    }
}
