<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Livewire\Component;

class Index extends Component
{
    public $keranjangs;
    public $ongkir = 15000;
    public $subtotal = 0;
    public $total = 0;

    protected $listeners = [
        'keranjangDiupdate' => 'viewKeranjangs',
    ];
    public function addJumlah($id)
    {
        $keranjang = Keranjang::find($id);
        $keranjang->increment('jumlah');
        $this->viewKeranjangs();
    }
    public function kurangJumlah($id)
    {
        $keranjang = Keranjang::find($id);
        if ($keranjang->jumlah > 1) {
            $keranjang->decrement('jumlah');
        }
        $this->viewKeranjangs();
    }

    public function mount()
    {
        $this->viewKeranjangs();
    }

    public function viewKeranjangs()
    {
        $this->keranjangs = Keranjang::where(
            auth()->check() ? 'users_id' : 'sessions_id',
            auth()->check() ? auth()->id() : session()->getId()
        )->get();
        $this->subtotal = $this->keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $this->total = $this->subtotal + $this->ongkir;
    }

    public function hapusKeranjang($id)
    {
        Keranjang::where('id', $id)->delete();

        // 🔥 refresh table & badge
        $this->dispatch('keranjangDiupdate');
    }

    public function render()
    {
        return view('livewire.keranjang.index');
    }
}

