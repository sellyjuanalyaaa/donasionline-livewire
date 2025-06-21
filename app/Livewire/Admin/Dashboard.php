<?php

namespace App\Livewire\Admin;

use App\Models\Donasi;
use App\Models\Kampanye;
use App\Models\Donatur;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $totalKampanye;
    public $totalDonatur;
    public $totalDonasiTerkumpul;
    public $totalKategori; 

    public function mount()
    {
        $this->totalKampanye = Kampanye::count();
        $this->totalDonatur = Donatur::count();
        $this->totalDonasiTerkumpul = Donasi::sum('jumlah');
        $this->totalKategori = Kategori::count(); 
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
