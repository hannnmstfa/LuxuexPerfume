<?php

namespace App\Http\Controllers;

use Buglinjo\LaravelWebp\Facades\Webp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebpController extends Controller
{
    public static function convert($image, $path, $nama)
    {
        $nama = Str::slug($nama) . '-' . Str::random(10);
        $path = trim($path, '/');

        Storage::disk('public')->makeDirectory($path);

        $fullPath = storage_path('app/public/' . $path . '/' . $nama . '.webp');

        if ($image->extension() !== 'webp') {
            Webp::make($image)->save($fullPath);
        } else {
            $image->move(storage_path('app/public/' . $path), $nama . '.webp');
        }

        return '/storage/' . $path . '/' . $nama . '.webp';
    }
}
