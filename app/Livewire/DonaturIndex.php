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

    public $editId = null;
    public $search = '';

    public function rules()
    {
        return [
            'nama' => 'required|string|min:3',
            'email' => 'required|email|unique:donaturs,email,' . $this->editId,
            'telepon' => 'nullable|numeric',
            'alamat' => 'nullable|string',
            'password' => $this->editId ? 'nullable|string|min:8' : 'required|string|min:8',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'email' => $this->email,
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editId) {
            Donatur::findOrFail($this->editId)->update($data);
            session()->flash('success', 'Donatur berhasil diperbarui.');
        } else {
            Donatur::create($data);
            session()->flash('success', 'Donatur berhasil ditambahkan.');
        }

        $this->resetForm();
    }


    public function edit($id)
    {
        $donatur = Donatur::findOrFail($id);
        $this->editId = $donatur->id;
        $this->nama = $donatur->nama;
        $this->email = $donatur->email;
        $this->telepon = $donatur->telepon;
        $this->alamat = $donatur->alamat;
        $this->password = ''; 
    }

    public function delete($id)
    {
        Donatur::findOrFail($id)->delete();
        session()->flash('success', 'Donatur berhasil dihapus.');
    }


    public function resetForm()
    {
        $this->reset(['nama', 'email', 'telepon', 'alamat', 'password', 'editId']);
        $this->resetErrorBag(); 
    }

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
