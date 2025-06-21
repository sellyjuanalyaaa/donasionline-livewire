<?php

namespace App\Livewire;

use App\Models\Donatur;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('layouts.app')]
class DonaturCreate extends Component
{
    // Properti untuk menampung data dari form
    #[Rule('required|string|min:3')]
    public $nama = '';

    #[Rule('required|email|unique:donaturs,email')]
    public $email = '';

    #[Rule('required|string|min:8')]
    public $password = '';

    #[Rule('nullable|numeric')]
    public $telepon = '';

    #[Rule('nullable|string')]
    public $alamat = '';

    public function save()
    {
        $this->validate();

        Donatur::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'telepon' => $this->telepon,
            'alamat' => $this->alamat,
        ]);

        session()->flash('success', 'Donatur baru berhasil ditambahkan.');
        return $this->redirect(route('admin.donatur.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.donatur-create');
    }
}
