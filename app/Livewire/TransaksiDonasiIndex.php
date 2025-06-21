<?php

namespace App\Livewire;

use App\Models\TransaksiDonasi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class TransaksiDonasiIndex extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        // Mulai dengan query dasar untuk mengambil semua transaksi beserta relasinya.
        $query = TransaksiDonasi::with(['donatur', 'kampanye']);

        $query->when($this->search, function ($q) {
            return $q->whereHas('donatur', function ($subQuery) {
                $subQuery->where('nama', 'like', '%' . $this->search . '%');
            })
            ->orWhereHas('kampanye', function ($subQuery) {
                $subQuery->where('judul', 'like', '%' . $this->search . '%');
            });
        });

        $transaksis = $query->latest()->paginate(15);

        return view('livewire.transaksi-donasi-index', [
            'transaksis' => $transaksis,
        ]);
    }
}
