<?php

namespace App\Livewire\Auth;

use App\Models\Donatur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Layout('layouts.guest')]
class DonaturRegister extends Component
{
    #[Rule('required|string|max:255')]
    public $nama = '';

    #[Rule('required|string|email|max:255|unique:donaturs,email')]
    public $email = '';

    // PERBAIKAN: Tambahkan properti dan aturan untuk telepon
    #[Rule('required|numeric|min_digits:10')]
    public $telepon = '';

    #[Rule('required|string|min:8|confirmed')]
    public $password = '';

    public $password_confirmation = '';

    public function register()
    {
        $validatedData = $this->validate();

        // PERBAIKAN: Sertakan 'telepon' saat membuat donatur baru
        $donatur = Donatur::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'telepon' => $validatedData['telepon'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Login donatur yang baru dibuat menggunakan guard 'donatur'
        Auth::guard('donatur')->login($donatur);

        // Arahkan ke dashboard donatur
        return $this->redirect(route('donatur.dashboard'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.donatur-register');
    }
}
