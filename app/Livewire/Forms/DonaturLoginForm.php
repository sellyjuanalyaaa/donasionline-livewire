<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DonaturLoginForm extends Form
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    /**
     * Aturan validasi untuk form.
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Mencoba untuk mengautentikasi donatur.
     */
    public function authenticate(): void
    {
        $this->validate();

        // Gunakan guard 'donatur' untuk mencoba login
        if (! Auth::guard('donatur')->attempt($this->only(['email', 'password']), $this->remember)) {
            // Jika gagal, lemparkan error validasi
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }
}
