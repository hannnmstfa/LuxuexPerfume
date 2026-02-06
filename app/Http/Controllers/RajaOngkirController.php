<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected string $apikey;
    protected string $endpoint;
    public function __construct()
    {
        $this->apikey = config('rajaongkir.apikey');
        $this->endpoint = config('rajaongkir.url');
    }
    public function cekResi($resi, $kurir, $last_phone = null)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint . "/track/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'awb' => $resi,
                'courier' => $kurir,
                'last_phone_number' => $last_phone,
            ]),
            CURLOPT_HTTPHEADER => array('key: ' . $this->apikey),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }
}
