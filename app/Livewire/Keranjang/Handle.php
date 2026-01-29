<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Handle extends Component
{
    public $jumlah_keranjang = 0;
    protected $listeners = [
    'keranjangDiupdate' => 'updateKeranjang',
    'addKeranjang',
];

    public function addKeranjang($productId, $jumlah = 1)
    {
        if (Auth::check()) {
            $cek = Keranjang::where('users_id', Auth::user()->id)
                ->where('produks_id', $productId)
                ->first();
            if ($cek) {
                $cek->increment('jumlah', $jumlah);
            } else {
                Keranjang::create([
                    'users_id' => Auth::user()->id,
                    'produks_id' => $productId,
                    'jumlah' => $jumlah,
                ]);
            }
        } else {
            $cek = Keranjang::where('sessions_id', session()->getId())
                ->where('produks_id', $productId)
                ->first();
            if ($cek) {
                $cek->increment('jumlah', $jumlah);
            } else {
                Keranjang::create([
                    'sessions_id' => session()->getId(),
                    'produks_id' => $productId,
                    'jumlah' => $jumlah,
                ]);
            }
        }
        $this->dispatch('keranjangDitambahkan', [
            'productId' => $productId,
        ]);
        $this->dispatch('keranjangDiupdate');
    }
    public function mount()
    {
        $this->updateKeranjang();
    }

    public function updateKeranjang()
    {
        if (Auth::check()) {
            $this->jumlah_keranjang = Keranjang::where('users_id', Auth::user()->id)->count();
        } else {
            $sessionId = session()->getId();
            $this->jumlah_keranjang = Keranjang::where('sessions_id', $sessionId)->count();
        }
    }

    public function render()
    {
        return view('livewire.keranjang.handle');
    }
}