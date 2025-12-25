<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';
    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 1) {
            $searchResults = Produk::search($this->search)->get();
        }
        return view('livewire.produk.search', compact('searchResults'));
    }
}
