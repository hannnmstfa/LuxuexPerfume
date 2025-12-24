<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Livewire\Component;

class HandleKeranjang extends Component
{
    public $jumlah_keranjang = 0;
    protected $listeners = [
        'updateKeranjang',
        'addKeranjang',
    ];
    public function addKeranjang($productId, $jumlah = 1)
    {
        if (auth()->check()) {
            $cek = Keranjang::where('users_id', auth()->id())
                ->where('produks_id', $productId)
                ->first();
            if ($cek) {
                $cek->increment('jumlah', $jumlah);
            } else {
                Keranjang::create([
                    'users_id' => auth()->id(),
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
        $this->updateKeranjang();
    }
    public function mount()
    {
        $this->updateKeranjang();
    }

    public function updateKeranjang()
    {
        if (auth()->check()) {
            $this->jumlah_keranjang = Keranjang::where('users_id', auth()->id())->count();
        } else {
            $sessionId = session()->getId();
            $this->jumlah_keranjang = Keranjang::where('sessions_id', $sessionId)->count();
        }
    }

    public function render()
    {
        return view('livewire.keranjang.handle-keranjang');
    }
}