<?php

namespace App\Livewire;

use App\Models\Kampanye;
use App\Models\Kategori; 
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class KampanyeIndex extends Component
{
    use WithPagination, WithFileUploads;

    // Properti untuk form
    public $judul = '', $deskripsi = '', $target_donasi = '', $tanggal_mulai = '', $tanggal_selesai = '';
    public $status = 'aktif';
    public $gambar = null;
    public $kategori_id = ''; 

    // Properti untuk state CRUD
    public $editId = null;
    public $existingGambar = null;
    public $search = '';
    public $filterKategori = ''; 

    public function rules()
    {
        return [
            'judul' => 'required|string|min:5',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string|min:20',
            'target_donasi' => 'required|numeric|min:10000',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:aktif,selesai,ditutup',
            'gambar' => $this->editId ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        $gambarPath = $this->existingGambar;
        if ($this->gambar) {
            $gambarPath = $this->gambar->store('kampanye-images', 'public');
        }

        $data = [
            'judul' => $this->judul,
            'kategori_id' => $this->kategori_id,
            'deskripsi' => $this->deskripsi,
            'target_donasi' => $this->target_donasi,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'status' => $this->status,
            'gambar' => $gambarPath,
        ];

        if ($this->editId) {
            Kampanye::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Kampanye berhasil diperbarui.');
        } else {
            Kampanye::create($data);
            session()->flash('success', 'Kampanye berhasil ditambahkan.');
        }

        $this->resetForm();
    }

    public function edit($id)
    {
        $kampanye = Kampanye::findOrFail($id);
        $this->editId = $kampanye->id;
        $this->judul = $kampanye->judul;
        $this->kategori_id = $kampanye->kategori_id; 
        $this->deskripsi = $kampanye->deskripsi;
        $this->target_donasi = $kampanye->target_donasi;
        $this->tanggal_mulai = $kampanye->tanggal_mulai->format('Y-m-d');
        $this->tanggal_selesai = $kampanye->tanggal_selesai->format('Y-m-d');
        $this->status = $kampanye->status;
        $this->existingGambar = $kampanye->gambar;
        $this->gambar = null;
    }

    public function delete($id)
    {
        $kampanye = Kampanye::findOrFail($id);
        if ($kampanye->gambar) { Storage::disk('public')->delete($kampanye->gambar); }
        $kampanye->delete();
        session()->flash('success', 'Kampanye berhasil dihapus.');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function render()
    {
        // 7. Logika query dengan pencarian DAN filter
        $kampanyes = Kampanye::with('kategori')
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterKategori, function ($query) {
                $query->where('kategori_id', $this->filterKategori);
            })
            ->latest()
            ->paginate(5);

        return view('livewire.kampanye-index', [
            'kampanyes' => $kampanyes,
            'kategoris' => Kategori::all(), 
        ]);
    }
}
