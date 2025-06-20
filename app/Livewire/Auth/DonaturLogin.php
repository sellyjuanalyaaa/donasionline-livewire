<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\DonaturLoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class DonaturLogin extends Component
{
    public DonaturLoginForm $form;

    /**
     * Menangani permintaan login.
     */
    public function login(): void
    {
        $this->form->authenticate();

        Session::regenerate();

        // PERBAIKAN: Arahkan ke route 'donatur.dashboard'
        $this->redirect(
            url: route('donatur.dashboard', absolute: false),
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.auth.donatur-login');
    }
}
