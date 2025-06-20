<?php

use App\Models\Donatur; // Assuming you have a Donatur model
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth; // Make sure to use the correct Auth guard for donaturs
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $nama = '';
    public string $email = '';
    public string $telepon = ''; // Added for phone number
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request for donatur.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Donatur::class], // Use Donatur model for uniqueness
            'telepon' => ['required', 'string', 'max:15'], // Add validation for phone
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Create the donatur
        event(new Registered($donatur = Donatur::create($validated)));

        // Log in the donatur (using the 'donatur' guard if configured)
        Auth::guard('donatur')->login($donatur);

        $this->redirect(route('donatur.dashboard', absolute: false), navigate: true); // Redirect to donatur dashboard
    }
}; ?>

<!-- <div class="flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 px-4 sm:px-6 lg:px-8"> -->
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-2xl max-h-screen mb-12">
        <div class="text-center">
            {{-- LOGO DAN NAMA APLIKASI DI SINI --}}
            <div class="flex flex-col items-center justify-center mb-2 gap-2">
                <img src="{{ asset('storage/kampanye-images/2606889_6156.svg') }}" alt="DonasiKita Logo" class="h-20 w-auto filter dark:invert" /> 
                <h1 class="text-3xl font-extrabold text-indigo-600 dark:text-indigo-400 tracking-tight">DonasiKita</h1>
            </div>
            {{-- AKHIR LOGO DAN NAMA APLIKASI --}}

            <h2 class="mt-6 text-2xl font-extrabold text-gray-900 dark:text-gray-100">
                Daftar Akun Donatur
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Buat akun Anda untuk mulai berdonasi.
            </p>
        </div>

        <form wire:submit="register" class="space-y-5">
            <div>
                <x-input-label for="nama" :value="__('Nama Lengkap')" class="sr-only" />
                <x-text-input
                    wire:model="nama"
                    id="nama"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="text"
                    name="nama"
                    placeholder="{{ __('Nama Lengkap') }}"
                    required
                    autofocus
                    autocomplete="name"
                />
                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" class="sr-only" />
                <x-text-input
                    wire:model="email"
                    id="email"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="email"
                    name="email"
                    placeholder="{{ __('Alamat Email') }}"
                    required
                    autocomplete="username"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="telepon" :value="__('Nomor Telepon')" class="sr-only" />
                <x-text-input
                    wire:model="telepon"
                    id="telepon"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="text"
                    name="telepon"
                    placeholder="{{ __('Nomor Telepon (contoh: 081234567890)') }}"
                    required
                    autocomplete="tel"
                />
                <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="sr-only" />
                <x-text-input
                    wire:model="password"
                    id="password"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="password"
                    name="password"
                    placeholder="{{ __('Kata Sandi') }}"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="sr-only" />
                <x-text-input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    class="block w-full px-4 py-3 rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors duration-200 placeholder-gray-400 dark:placeholder-gray-500"
                    type="password"
                    name="password_confirmation"
                    placeholder="{{ __('Konfirmasi Kata Sandi') }}"
                    required
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a
                    class="text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200 font-medium transition-colors duration-200"
                    href="{{ route('donatur.login') }}"
                    wire:navigate
                >
                    {{ __('Sudah punya akun?') }}
                </a>

                <x-primary-button
                    class="ms-4 py-3 px-6 text-lg font-semibold rounded-xl transition-all duration-300 hover:scale-[1.01] active:scale-[0.99] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove>{{ __('Daftar') }}</span>
                    <span wire:loading>{{ __('Memproses...') }}</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</div>