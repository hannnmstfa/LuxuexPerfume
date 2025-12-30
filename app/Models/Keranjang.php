<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Keranjang extends Model
{
    protected $fillable = [
        'users_id',
        'sessions_id',
        'produks_id',
        'jumlah',
    ];
    public function produks()
    {
        return $this->belongsTo(Produk::class, 'produks_id');
    }
    public static function updateKeranjang(string $session)
    {
        $data = self::where('sessions_id', $session)->get();
        foreach ($data as $keranjang) {
            $cek = self::where('users_id', auth()->id())
                ->where('produks_id', $keranjang->produks_id)->exists();
            if (!$cek) {
                $keranjang->update([
                    'users_id' => auth()->id(),
                    'sessions_id' => null,
                ]);
            }
        }
    }
}
