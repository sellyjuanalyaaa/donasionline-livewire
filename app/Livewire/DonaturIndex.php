<?php

namespace App\Livewire;

use App\Models\Donatur;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DonaturIndex extends Component
{
    use WithPagination;

    // Properti untuk form
    public $nama = '';
    public $email = '';
    public $telepon = '';
    public $alamat = '';
    public $password = '';

    // Properti untuk state CRUD
    public $editId = null;
    public $search = '';

    /**
     * Aturan validasi dinamis.
     */
    public function rules()
    {
        return [
            'nama' => 'required|string|min:3',
            // Saat update, abaikan email donatur saat ini dari aturan unique
            'email' => 'required|email|unique:donaturs,email,' . $this->editId,
            'telepon' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            // Password wajib saat membuat, opsional saat update
            'password' => $this->editId ? 'nullable|string|min:8' : 'required|string|min:8',
        ];
    }

    /**
     * Method untuk menangani Create dan Update.
     */
    public function save()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
        ];

        // Hanya update password jika diisi
        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editId) {
            // Proses UPDATE
            Donatur::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Donatur berhasil diperbarui.');
        } else {
            // Proses CREATE
            Donatur::create($data);
            session()->flash('success', 'Donatur berhasil ditambahkan.');
        }

        $this->resetForm();
    }

    /**
     * Mengisi form dengan data yang akan di-edit.
     */
    public function edit($id)
    {
        $donatur = Donatur::findOrFail($id);
        $this->editId = $donatur->id;
        $this->nama = $donatur->nama;
        $this->email = $donatur->email;
        $this->telepon = $donatur->telepon;
        $this->alamat = $donatur->alamat;
        $this->password = ''; // Kosongkan password saat edit
    }

    /**
     * Menghapus data donatur.
     */
    public function delete($id)
    {
        Donatur::findOrFail($id)->delete();
        session()->flash('success', 'Donatur berhasil dihapus.');
    }

    /**
     * Membersihkan dan mereset input form.
     */
    public function resetForm()
    {
        $this->reset(['nama', 'email', 'telepon', 'alamat', 'password', 'editId']);
        $this->resetErrorBag(); // Membersihkan pesan error validasi sebelumnya
    }

    /**
     * Merender view.
     */
    public function render()
    {
        $donaturs = Donatur::where('nama', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%')
                            ->latest()
                            ->paginate(10);
        
        return view('livewire.donatur-index', [
            'donaturs' => $donaturs,
        ]);
    }
}
