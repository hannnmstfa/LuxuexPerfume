<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AfterLoginController extends Controller
{
    public function checkout()
    {
        return view('afterlogin.checkout');
    }
}
