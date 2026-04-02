<?php

namespace App\Http\Controllers;

use App\Models\TokoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    protected string $apikey;
    protected string $baseurl;
    protected string $origin;
    public function __construct()
    {
        $this->apikey = env("KEY_API_CO_ID");
        $this->baseurl = env("URL_API_CO_ID");
        $this->origin = TokoSetting::data()->kode_area ?? 0;
    }
    public function cekOngkir($destinasi)
    {
        $response = Http::withHeaders([
            'x-api-co-id' => $this->apikey,
            'Accept' => 'application/json',
        ])->get($this->baseurl . '/expedition/shipping-cost', [
                    'origin_village_code' => str_replace('.', '', $this->origin),
                    'destination_village_code' => str_replace('.', '', $destinasi),
                    'weight' => 1,
                ]);

        $data = $response->json();
        if (!$data['is_success']) {
            return null;
        }
        $jt = collect($data['data']['couriers'])
        ->firstWhere('courier_code', 'JT');
        if (!$jt) {
            return null;
        }
        if($jt['price'] < 15000){
            return 18000;
        }else{
            return $jt['price'] + 3000;
        }
    }
}
