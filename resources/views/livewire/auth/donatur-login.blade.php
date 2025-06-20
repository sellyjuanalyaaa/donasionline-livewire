<?php

use App\Livewire\Forms\LoginForm; // Assuming you have a LoginForm for donaturs or a generic one
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

// You might need a separate LoginForm for Donaturs if their authentication logic differs
// For simplicity, I'm assuming you're using the same LoginForm structure as admin
new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request for donatur.
     */
    public function login(): void
    {
        $this->validate();

        // This assumes your LoginForm can handle donatur authentication.
        // If not, you'll need custom authentication logic here.
        if (Auth::guard('donatur')->attempt($this->form->only('email', 'password'), $this->form->remember)) {
            Session::regenerate();
            $this->redirectIntended(
                default: route('donatur.dashboard', absolute: false), // Adjust to your donatur dashboard route
                navigate: true
            );
        } else {
            $this->addError('form.email', __('auth.failed')); // Add a generic error for failed login
        }
    }
}; ?>

    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-2xl">
        <div class="text-center">
            {{-- LOGO DAN NAMA APLIKASI DI SINI --}}
            <div class="flex flex-col items-center justify-center mb-6">
                <img src="{{ asset('storage/kampanye-images/2606889_6156.svg') }}" alt="DonasiKita Logo" class="h-20 w-auto mb-2 filter dark:invert" /> {{-- Tambahkan filter dark:invert untuk logo SVG agar lebih terlihat di dark mode jika diperlukan --}}
                <h1 class="text-4xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tight">DonasiKita</h1>
            </div>
            {{-- AKHIR LOGO DAN NAMA APLIKASI --}}

            <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-gray-100">
                Masuk sebagai Donatur
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Silakan masukkan kredensial Anda untuk melanjutkan donasi.
            </p>
        </div>

        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        <form wire:submit="login" class="space-y-6">
            <div>
                <x-input-label for="email" :value="__('Email')" class="sr-only" />
                <x-text-input
                    wire:model="form.email"
                    id="email"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="email"
                    name="email"
                    placeholder="{{ __('Alamat Email') }}"
                    required
                    autofocus
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="sr-only" />
                <x-text-input
                    wire:model="form.password"
                    id="password"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="password"
                    name="password"
                    placeholder="{{ __('Kata Sandi') }}"
                    required
                    autocomplete="current-password"
                />
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        wire:model="form.remember"
                        id="remember"
                        type="checkbox"
                        class="rounded-md dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember"
                    >
                    <label for="remember" class="ml-2 text-sm text-gray-700 dark:text-gray-300 select-none">
                        {{ __('Ingat saya') }}
                    </label>
                </div>

                <a
                    class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 font-medium transition-colors duration-200"
                    href="{{ route('donatur.register') }}"
                    wire:navigate
                >
                    {{ __('Belum punya akun?') }}
                </a>
            </div>

            <div class="mt-6"> {{-- Added margin top here for spacing from checkbox --}}
                <x-primary-button
                    class="w-full justify-center py-3 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>{{ __('Masuk') }}</span>
                    <span wire:loading>{{ __('Memproses...') }}</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</div>