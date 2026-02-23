<?php

namespace App\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;

class DashboardChart extends Component
{
    public $tanggal = [];
    public $jumlah_trx = [];
    public $bulan;
    public $chartData = [];
    public function getDataChart()
    {
        $this->chartData = Transaksi::where('created_at', 'like', $this->bulan . '%')
            ->where('status_bayar', 'berhasil')
            ->orderBy('created_at', 'asc')
            ->get();
            $this->tanggal = $this->chartData->pluck('created_at')->map(fn($date) => \Carbon\Carbon::parse($date)->format('Y-m-d'))->toArray();
            // dd($this->tanggal);
        $this->jumlah_trx = $this->chartData->pluck('total_harga')->toArray();
    }
    public function updatedBulan()
    {
        $this->getDataChart();
    }
    public function mount()
    {
        $this->bulan = now()->format('Y-m');
        $this->getDataChart();
    }
    public function render()
    {
        return view('livewire.admin.dashboard-chart');
    }
}
