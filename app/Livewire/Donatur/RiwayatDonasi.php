<?php

namespace App\Livewire\Donatur;

use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RiwayatDonasi extends Component
{
    use WithPagination;

    public function render()
    {
        // Ambil donasi HANYA untuk donatur yang sedang login
        $donasis = Donasi::where('donatur_id', Auth::guard('donatur')->id())
                        ->with('kampanye')
                        ->latest()
                        ->paginate(10);

        return view('livewire.donatur.riwayat-donasi', [
            'donasis' => $donasis
        ]);
    }
}
