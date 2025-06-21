<?php

namespace App\Livewire;

use App\Models\Kampanye;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class KampanyeForm extends Component
{
    use WithFileUploads;

    // Properti untuk menampung data
    public Kampanye $kampanye;
    public $gambar;
    public $existingGambar;

    // Menandakan mode edit
    public bool $isEditMode = false;

    /**
     * Mount hook untuk menangani mode edit atau create.
     * Laravel akan otomatis menyuntikkan model Kampanye jika ada di URL.
     */
    public function mount(Kampanye $kampanye)
    {
        if ($kampanye->exists) {
            $this->kampanye = $kampanye;
            $this->isEditMode = true;
            $this->existingGambar = $kampanye->gambar;
        } else {
            // Inisialisasi model kosong untuk form tambah baru
            $this->kampanye = new Kampanye([
                'status' => 'aktif', // Nilai default
                'tanggal_mulai' => now()->format('Y-m-d'),
            ]);
        }
    }

    protected function rules()
    {
        return [
            'kampanye.judul' => 'required|string|min:5',
            'kampanye.kategori_id' => 'required|exists:kategoris,id',
            'kampanye.deskripsi' => 'required|string|min:20',
            'kampanye.target_donasi' => 'required|numeric|min:10000',
            'kampanye.tanggal_mulai' => 'required|date',
            'kampanye.tanggal_selesai' => 'required|date|after_or_equal:kampanye.tanggal_mulai',
            'kampanye.status' => 'required|in:aktif,selesai,ditutup',
            'gambar' => $this->isEditMode ? 'nullable|image|max:2048' : 'required|image|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->gambar) {
            if ($this->isEditMode && $this->existingGambar) {
                Storage::disk('public')->delete($this->existingGambar);
            }
            $this->kampanye->gambar = $this->gambar->store('kampanye-images', 'public');
        }
        
        $this->kampanye->save();

        session()->flash('success', $this->isEditMode ? 'Kampanye berhasil diperbarui.' : 'Kampanye baru berhasil ditambahkan.');
        return $this->redirect(route('admin.kampanye.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.kampanye-form', [
            'kategoris' => Kategori::all()
        ]);
    }
}
