<?php

namespace App\Livewire\Keranjang;

use App\Models\Keranjang;
use Livewire\Component;

class Index extends Component
{
    public $keranjangs;

    protected $listeners = [
        'keranjangDiupdate' => 'viewKeranjangs',
    ];

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

