<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use robertogallea\LaravelPython\Services\LaravelPython;

class AnalisisController extends Controller
{
    public function index(){
        $python = new LaravelPython();
        $test = $python->run(public_path('/assets/evaluasi.py'));
        return view('guest.analisis.index', compact('test'));
    }
}
