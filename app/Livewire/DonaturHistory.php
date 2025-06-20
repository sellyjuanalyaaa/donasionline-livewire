<?php

namespace App\Livewire;

use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DonaturHistory extends Component
{
    use WithPagination;

    /**
     * Merender view dan mengirimkan data riwayat donasi.
     */
    public function render()
    {
        // Inisialisasi variabel $donations sebagai Paginator kosong untuk mencegah error.
        $donations = Donasi::where('id', -1)->paginate(10); 

        // Cek secara spesifik apakah yang login adalah seorang Donatur.
        if (Auth::guard('donatur')->check()) {
            // Jika ya, ambil data donasi HANYA milik donatur tersebut.
            $donations = Donasi::where('donatur_id', Auth::guard('donatur')->id())
                         ->with('kampanye')
                         ->latest()
                         ->paginate(10);
        }
        // Jika yang login adalah admin (guard 'web'), maka $donations akan tetap
        // menjadi Paginator kosong, sehingga tidak akan ada error saat memanggil ->links().

        return view('livewire.donatur-history', [
            'donations' => $donations,
        ]);
    }
}
