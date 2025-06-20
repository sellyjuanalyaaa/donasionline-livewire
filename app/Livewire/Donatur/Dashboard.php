<?php

namespace App\Livewire\Donatur;

use App\Models\Kampanye;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    use WithPagination;

    public $namaDonatur;
    public $totalDonasi;
    public $jumlahTransaksi;
    public $recentDonations; // Properti untuk menyimpan donasi terkini

    // Properti untuk filter dan pencarian
    public $filterKategori = ''; 
    public $search = '';

    public function mount()
    {
        $donatur = Auth::guard('donatur')->user();
        $this->namaDonatur = $donatur->nama;
        $this->totalDonasi = $donatur->donasis()->sum('jumlah');
        $this->jumlahTransaksi = $donatur->donasis()->count();

        // Ambil 3 donasi terakhir dari pengguna ini
        $this->recentDonations = $donatur->donasis()->with('kampanye')->latest()->take(3)->get();
    }

    public function render()
    {
        // Ambil data kampanye dengan logika filter dan pencarian
        $kampanyes = Kampanye::where('status', 'aktif')
                            ->withSum('donasis as terkumpul', 'jumlah')
                            ->withCount('donasis as jumlah_pendonasi') // Menghitung jumlah donatur
                            ->when($this->filterKategori, function ($query) {
                                $query->where('kategori_id', $this->filterKategori);
                            })
                            ->when($this->search, function ($query) {
                                $query->where('judul', 'like', '%' . $this->search . '%');
                            })
                            ->latest()
                            ->paginate(6);

        return view('livewire.donatur.dashboard', [
            'kampanyes' => $kampanyes,
            'kategoris' => Kategori::all(),
        ]);
    }
}
