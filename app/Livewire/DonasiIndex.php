<?php

namespace App\Livewire;

use App\Models\Donasi;
use App\Models\Kampanye;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DonasiIndex extends Component
{
    use WithPagination;

    public $totalSeluruhDonasi;

    public function mount()
    {
        $this->totalSeluruhDonasi = Donasi::sum('jumlah');
    }
    public function render()
    {
        $kampanyes = Kampanye::withSum('donasis as terkumpul', 'jumlah')
                            ->withCount('donasis as jumlah_transaksi')
                            ->latest()
                            ->paginate(10);

        return view('livewire.donasi-index', [
            'kampanyes' => $kampanyes,
        ]);
    }
}
