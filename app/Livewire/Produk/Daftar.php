<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class Daftar extends Component
{
    use WithPagination;
    public $kategori = 'all';
    public $sortBy = 'nama';
    public $sortDirection = 'asc';
    protected $listeners = ['keranjangDitambahkan'];
    public array $success = [];
    public function keranjangDitambahkan($payload)
    {
        $this->success[$payload['productId']] = true;
    }

    public function sort($sortBy, $sortDirection)
    {
        $this->sortBy = $sortBy;
        $this->sortDirection = $sortDirection;
        $this->resetPage();
    }

    public function render()
    {
        $products = Produk::with('stocks')
            ->when($this->kategori !== 'all', function ($q) {
                $q->where('kategori', $this->kategori);
            })
            ->when($this->sortBy === 'harga', function ($q) {
                $q->orderByRaw(
                    'COALESCE(harga_diskon, harga) ' . $this->sortDirection
                );
            }, function ($q) {
                $q->orderBy($this->sortBy, $this->sortDirection);
            })
            ->paginate(9)
            ->onEachSide(1);

        return view('livewire.produk.daftar', compact('products'));
    }
}
