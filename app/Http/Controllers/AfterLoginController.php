<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfterLoginController extends Controller
{
    public function checkout()
    {
        $wilayah = new WilayahController();
        return view('afterlogin.checkout');
    }
}
