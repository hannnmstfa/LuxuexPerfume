<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokoSetting extends Model
{
    protected $fillable = [
        'path_logo',
        'nama_toko',
        'email_toko',
        'phone_toko',
        'kode_area',
        'alamat_toko',
    ];
    public static function data()
    {
        return cache()->remember('toko_setting', 3600, function () {
            return self::first();
        });
    }
}
