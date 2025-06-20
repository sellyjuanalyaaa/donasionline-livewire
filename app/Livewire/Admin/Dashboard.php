<?php

namespace App\Livewire\Admin;

use App\Models\Donasi;
use App\Models\Kampanye;
use App\Models\Donatur;
use App\Models\Kategori; // 1. Tambahkan model Kategori
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $totalKampanye;
    public $totalDonatur;
    public $totalDonasiTerkumpul;
    public $totalKategori; // 2. Tambahkan properti baru

    /**
     * Mount hook untuk menginisialisasi data statistik.
     */
    public function mount()
    {
        $this->totalKampanye = Kampanye::count();
        $this->totalDonatur = Donatur::count();
        $this->totalDonasiTerkumpul = Donasi::sum('jumlah');
        $this->totalKategori = Kategori::count(); // 3. Hitung jumlah kategori
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
