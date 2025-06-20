<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        // Logout dari guard yang sedang aktif
        if (Auth::guard('web')->check()) {
            $logout();
        } elseif(Auth::guard('donatur')->check()) {
            Auth::guard('donatur')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @auth('web')
                        <a href="{{ route('admin.dashboard') }}" wire:navigate>
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200 p-5 " />
                        </a>
                    @elseauth('donatur')
                        <a href="{{ route('donatur.dashboard') }}" wire:navigate>
                            <x-application-logo class=" ml-10 block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    @else
                        <a href="/" wire:navigate>
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200 pl-10" />
                        </a>
                    @endauth
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex pl-20">
                    @auth('web') {{-- Menu untuk Admin --}}
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    @endauth

                    @auth('donatur') {{-- Menu untuk Donatur --}}
                         <x-nav-link :href="route('donatur.dashboard')" :active="request()->routeIs('donatur.dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                         <x-nav-link :href="route('donatur.riwayat')" :active="request()->routeIs('donatur.riwayat')">
                            {{ __('Riwayat Donasi') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth('web') {{-- Dropdown untuk Admin --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::guard('web')->user()->name }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            {{-- PERBAIKAN: Aktifkan kembali link profile untuk admin --}}
                            <x-dropdown-link :href="route('admin.profile')"> {{ __('Profile') }} </x-dropdown-link>
                            <button wire:click="logout" class="w-full text-start"> <x-dropdown-link> {{ __('Log Out') }} </x-dropdown-link></button>
                        </x-slot>
                    </x-dropdown>
                @elseauth('donatur') {{-- Dropdown untuk Donatur --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::guard('donatur')->user()->nama }}</div>
                                <div class="ms-1"><svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg></div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <button wire:click="logout" class="w-full text-start"> <x-dropdown-link> {{ __('Log Out') }} </x-dropdown-link></button>
                        </x-slot>
                    </x-dropdown>
                @else {{-- Tampilan untuk Tamu (Guest) --}}
                    <div class="space-x-4">
                        <a href="{{ route('donatur.login') }}" class="text-sm text-gray-700">Login Donatur</a>
                        <a href="{{ route('login') }}" class="text-sm text-gray-700">Login Admin</a>
                    </div>
                @endauth
            </div>
            
            {{-- ... sisa file ... --}}
        </div>
    </div>
</nav>
