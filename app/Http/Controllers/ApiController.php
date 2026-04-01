<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected string $apikey;
    public function __construct()
    {
        $this->apikey = env("X-API-CO-ID");
    }
}
