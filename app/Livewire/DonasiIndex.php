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

    /**
     * Menghitung total seluruh donasi saat komponen dimuat.
     */
    public function mount()
    {
        $this->totalSeluruhDonasi = Donasi::sum('jumlah');
    }

    /**
     * Merender view dengan data ringkasan per kampanye.
     */
    public function render()
    {
        // Ambil data kampanye beserta:
        // 1. Total donasi terkumpul (dengan alias 'terkumpul')
        // 2. Jumlah transaksi donasi yang masuk
        $kampanyes = Kampanye::withSum('donasis as terkumpul', 'jumlah')
                            ->withCount('donasis as jumlah_transaksi')
                            ->latest()
                            ->paginate(10);

        return view('livewire.donasi-index', [
            'kampanyes' => $kampanyes,
        ]);
    }
}
