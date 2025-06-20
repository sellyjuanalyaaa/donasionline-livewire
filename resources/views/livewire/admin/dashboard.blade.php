<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-teal-100 dark:bg-teal-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-teal-600 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                    </div>
                    <div class="min-w-0"> {{-- Penambahan untuk word wrapping --}}
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400">Total Kampanye</h3>
                        <p class="mt-1 text-3xl font-bold text-slate-800 dark:text-slate-100 truncate">{{ $totalKampanye }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-sky-100 dark:bg-sky-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-sky-600 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.512 2.72a3 3 0 0 1-4.682-2.72M12 18.72v-5.25A2.25 2.25 0 0 1 14.25 11.25h1.5a2.25 2.25 0 0 1 2.25 2.25v5.25m-6-5.25A2.25 2.25 0 0 0 9.75 11.25h-1.5A2.25 2.25 0 0 0 6 13.5v5.25m6-5.25a2.25 2.25 0 0 0-2.25-2.25H12a2.25 2.25 0 0 0-2.25 2.25v5.25" /></svg>
                    </div>
                    <div class="min-w-0"> {{-- Penambahan untuk word wrapping --}}
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400">Total Donatur</h3>
                        <p class="mt-1 text-3xl font-bold text-slate-800 dark:text-slate-100 truncate">{{ $totalDonatur }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-amber-100 dark:bg-amber-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>
                    </div>
                    <div class="min-w-0"> {{-- Penambahan untuk word wrapping --}}
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400">Total Kategori</h3>
                        <p class="mt-1 text-3xl font-bold text-slate-800 dark:text-slate-100 truncate">{{ $totalKategori }}</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-rose-100 dark:bg-rose-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-rose-600 dark:text-rose-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6V5.25m0 0A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25v.75m0 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m15.75 0-1.28-1.28a.75.75 0 0 0-1.06 0l-1.28 1.28m-12 0l1.28-1.28a.75.75 0 0 1 1.06 0l1.28 1.28" /></svg>
                    </div>
                    
                    {{-- DIUBAH: Blok ini dimodifikasi agar angka tidak keluar --}}
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400 truncate">Donasi Terkumpul</h3>
                        <p class="mt-1 text-2xl lg:text-2xl font-bold text-slate-800 dark:text-slate-100">
                            Rp{{ number_format($totalDonasiTerkumpul, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                </div>

            {{-- Pintasan Navigasi --}}
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-2xl p-6 md:p-8">
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-6">Pintasan Manajemen</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('admin.kampanye.index') }}" wire:navigate class="group bg-slate-50 dark:bg-slate-700/50 p-6 rounded-xl border-t-4 border-teal-500 hover:border-teal-600 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-4 text-teal-500 group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                            </div>
                            <p class="font-semibold text-slate-700 dark:text-slate-200">Kelola Kampanye</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.donasi.index') }}" wire:navigate class="group bg-slate-50 dark:bg-slate-700/50 p-6 rounded-xl border-t-4 border-sky-500 hover:border-sky-600 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-4 text-sky-500 group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A2.625 2.625 0 0 1 1.5 18.375v-2.25c0-.621.504-1.125 1.125-1.125h2.25Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 7.875C16.5 7.254 16.996 6.75 17.625 6.75h2.25c.621 0 1.125.504 1.125 1.125v6.75c0 .621-.504 1.125-1.125 1.125h-2.25a2.625 2.625 0 0 1-2.625-2.625V10.5c0-.621.504-1.125 1.125-1.125h2.25Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 1.5v12.75c0 .621.504 1.125 1.125 1.125h2.25c.621 0 1.125-.504 1.125-1.125V1.5A2.625 2.625 0 0 0 12 3.75h0A2.625 2.625 0 0 0 9.75 1.5Z" /></svg>
                            </div>
                            <p class="font-semibold text-slate-700 dark:text-slate-200">Laporan Donasi</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.donatur.index') }}" wire:navigate class="group bg-slate-50 dark:bg-slate-700/50 p-6 rounded-xl border-t-4 border-amber-500 hover:border-amber-600 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-4 text-amber-500 group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m-7.512 2.72a3 3 0 0 1-4.682-2.72M12 18.72v-5.25A2.25 2.25 0 0 1 14.25 11.25h1.5a2.25 2.25 0 0 1 2.25 2.25v5.25m-6-5.25A2.25 2.25 0 0 0 9.75 11.25h-1.5A2.25 2.25 0 0 0 6 13.5v5.25m6-5.25a2.25 2.25 0 0 0-2.25-2.25H12a2.25 2.25 0 0 0-2.25 2.25v5.25" /></svg>
                            </div>
                            <p class="font-semibold text-slate-700 dark:text-slate-200">Kelola Donatur</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.kategori.index') }}" wire:navigate class="group bg-slate-50 dark:bg-slate-700/50 p-6 rounded-xl border-t-4 border-rose-500 hover:border-rose-600 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="flex flex-col items-center text-center">
                            <div class="mb-4 text-rose-500 group-hover:scale-110 transition-transform">
                                <svg class="h-10 w-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" /></svg>
                            </div>
                            <p class="font-semibold text-slate-700 dark:text-slate-200">Kelola Kategori</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>