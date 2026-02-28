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
        $keranjangs = Keranjang::with(['produks'])->where(
            Auth::check() ? 'users_id' : 'sessions_id',
            Auth::check() ? Auth::id() : session()->getId()
        )->get();

        // Filter hanya produk yang belum di-soft delete dan relasi tidak null
        $this->jumlah_keranjang = $keranjangs->filter(function ($item) {
            return $item->produks && (!isset($item->produks->deleted_at) || $item->produks->deleted_at === null);
        })->count();
    }

    public function render()
    {
        return view('livewire.keranjang.handle');
    }
}