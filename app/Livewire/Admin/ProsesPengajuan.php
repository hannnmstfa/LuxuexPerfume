<?php

namespace App\Livewire\Admin;

use App\Models\Catatan;
use Livewire\Component;

class ProsesPengajuan extends Component
{
    public $data;
    public $template = [];
    public string $tabAktif = 'manual';
    public function setTab(string $tab = 'manual'){
        if($tab == $this->tabAktif){
            return;
        }else{
            $this->tabAktif = $tab;
            if($this->tabAktif == 'template' && $tab == 'template'){
                $this->template = Catatan::orderBy('nama', 'asc')->get();
            }
        }
    }

    public function mount($data)
    {
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.admin.proses-pengajuan');
    }
}