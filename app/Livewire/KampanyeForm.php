<?php

namespace App\Livewire;

use App\Models\Kampanye;
use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithFileUploads; // <-- Penting untuk upload file
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('layouts.app')]
class KampanyeForm extends Component
{
    use WithFileUploads; // <-- Aktifkan fitur upload file

   // Properti untuk data form
    #[Rule('required|string|min:5')]
    public $judul = '';

    #[Rule('required|string|min:20')]
    public $deskripsi = '';

    #[Rule('required|numeric|min:10000')]
    public $target_donasi;

    #[Rule('required|date')]
    public $tanggal_mulai;
    
    #[Rule('required|date|after_or_equal:tanggal_mulai')]
    public $tanggal_selesai;

    #[Rule('nullable|image|max:2048')]
    public $gambar = null; // <-- PERBAIKAN DILAKUKAN DI SINI

    // Method untuk menyimpan data
    public function save()
    {
        $this->validate();

        $gambarPath = null;
        if ($this->gambar) {
            $gambarPath = $this->gambar->store('kampanye-images', 'public');
        }

        Kampanye::create([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'target_donasi' => $this->target_donasi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'gambar' => $gambarPath,
        ]);

        session()->flash('success', 'Kampanye baru berhasil dibuat.');
        return $this->redirect('/kampanye', navigate: true); 
    }

    public function render()
    {
        return view('livewire.kampanye-form');
    }
}