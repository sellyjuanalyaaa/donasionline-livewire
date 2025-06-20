<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Statistik Ringkas --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Total Kampanye</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalKampanye }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Total Donatur</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">{{ $totalDonatur }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Donasi Terkumpul</h3>
                    <p class="mt-1 text-3xl font-semibold text-gray-700 dark:text-gray-200">Rp{{ number_format($totalDonasiTerkumpul, 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Pintasan Navigasi Manajemen --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Pintasan Manajemen</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    
                    {{-- PERBAIKAN: Link ini akan mengarah ke halaman manajemen kampanye --}}
                    <a href="{{ route('admin.kampanye.index') }}" wire:navigate class="text-center p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Kelola Kampanye
                    </a>

                    <a href="{{ route('admin.donasi.index') }}" wire:navigate class="text-center p-4 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        Laporan Donasi
                    </a>
                    <a href="{{ route('admin.donatur.index') }}" wire:navigate class="text-center p-4 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition">
                        Kelola Donatur
                    </a>
                     <a href="{{ route('admin.kategori.index') }}" wire:navigate class="text-center p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition">
                        Kelola Kategori
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
