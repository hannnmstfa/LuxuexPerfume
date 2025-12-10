<?php

namespace App\Http\Controllers;

use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebpController extends Controller
{
    public static function convert($image, $path, $nama){
        $nama = Str::slug($nama);
        $newPath = '/storage/' . trim($path, '/');
        Storage::disk('public')->makeDirectory($newPath);
        if($image->extension() !== 'webp'){
            Webp::make($image)->save(public_path($newPath) . '/' . $nama . '.webp');
        }else{
            $image->move(public_path($newPath), $nama . '.webp');
        }
        return $newPath . '/' . $nama . '.webp';
    }
}
