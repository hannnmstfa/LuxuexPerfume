<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $keranjangs;
    public $ongkir = 15000;
    public $subtotal = 0;
    public $total = 0;
    public array $errorStok = [];
    public array $daftarProduk = [];

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
        $this->keranjangs = Keranjang::with(['produks'])->where(
            Auth::check() ? 'users_id' : 'sessions_id',
            Auth::check() ? Auth::id() : session()->getId()
        )->get();
        $this->subtotal = $this->keranjangs->sum(function ($item) {
            return ($item->produks->harga_diskon ? $item->produks->harga_diskon : $item->produks->harga) * $item->jumlah;
        });
        $this->total = $this->subtotal + $this->ongkir;
    }

    public function hapusKeranjang($id)
    {
        Keranjang::where('id', $id)->delete();
        $this->dispatch('keranjangDiupdate');
    }

    public function cek(){
        $this->errorStok = [];
        $this->daftarProduk = [];
        foreach($this->keranjangs as $item){
            $stok = $item->produks->stok;
            if($stok < 1 || $stok < $item->jumlah){
                $this->errorStok[] = $item->id;
            }else{
                $this->daftarProduk[] = $item->id;
            }
        }
        if($this->errorStok){
            return;
        }
        session()->put('checkout.produk');
        return to_route('checkout.index');
    }
    public function render()
    {
        return view('livewire.keranjang.index');
    }
}

