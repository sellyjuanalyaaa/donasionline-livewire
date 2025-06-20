<?php

namespace App\Livewire; // Sesuaikan dengan namespace Anda

use Livewire\Component;
use App\Models\Kategori;

// Nama class ini harus sesuai dengan nama file Anda
class KategoriIndex extends Component
{
    public $nama_kategori, $editId = null;

    // Aturan validasi yang lebih baik
    protected $rules = [
        'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
    ];

    public function save()
    {
        // Menyesuaikan aturan validasi saat mode edit
        if ($this->editId) {
            $this->rules['nama_kategori'] .= ',' . $this->editId;
        }
        
        $this->validate();

        if ($this->editId) {
            Kategori::find($this->editId)->update(['nama_kategori' => $this->nama_kategori]);
            // Menampilkan pesan sukses untuk update
            session()->flash('success', 'Kategori berhasil diperbarui.');
        } else {
            Kategori::create(['nama_kategori' => $this->nama_kategori]);
            // Menampilkan pesan sukses untuk data baru
            session()->flash('success', 'Kategori baru berhasil ditambahkan.');
        }

        // Membersihkan form setelah disimpan
        $this->reset(['nama_kategori', 'editId']);
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $this->editId = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
    }
    
    /**
     * Method PENTING yang ditambahkan agar tombol "Batal" berfungsi
     */
    public function resetForm()
    {
        $this->reset(['nama_kategori', 'editId']);
    }

    public function delete($id)
    {
        Kategori::destroy($id);
        // Menampilkan pesan sukses setelah data dihapus
        session()->flash('success', 'Kategori berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.kategori-index', [
            'kategoris' => Kategori::latest()->get(),
        ]); 
    }
}