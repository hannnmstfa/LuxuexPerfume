<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;

class Laporan extends Component
{
    public $bulan;
    public $laporans = [];
    public function updatedBulan()
    {
        $this->laporans = Transaksi::where('created_at', 'like', $this->bulan . '%')
            ->where('status_bayar', 'berhasil')
            ->orderBy('created_at', 'asc')
            ->get();
        $this->dispatch('datatable:reload');
    }
    public function mount()
    {
        $this->bulan = now()->format('Y-m');
        $this->updatedBulan();
    }
    public function render()
    {
        return view('livewire.admin.laporan');
    }
}
