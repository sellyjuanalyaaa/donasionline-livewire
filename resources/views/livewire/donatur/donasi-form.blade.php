<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Donasi untuk: {{ $kampanye->judul }}
            </h2>
            {{-- Tombol untuk kembali ke halaman dashboard donatur --}}
            <a href="{{ route('donatur.dashboard') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    {{-- Detail Kampanye --}}
                    <div class="flex flex-col md:flex-row gap-6 mb-6">
                        <div class="md:w-1/3">
                            <img class="rounded-lg shadow-md object-cover w-full h-48" src="{{ $kampanye->gambar ? asset('storage/' . $kampanye->gambar) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.' }}" alt="Gambar {{ $kampanye->judul }}">
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $kampanye->judul }}</h3>
                            {{-- PERBAIKAN: Gunakan namespace lengkap untuk Str --}}
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($kampanye->deskripsi, 150) }}</p>

                            <!-- Progress Bar -->
                            <div class="mt-4">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    @php
                                        // Gunakan properti 'terkumpul' dari withSum di komponen
                                        $terkumpul = $kampanye->terkumpul ?? 0;
                                        $progres = ($kampanye->target_donasi > 0) ? ($terkumpul / $kampanye->target_donasi) * 100 : 0;
                                    @endphp
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ min($progres, 100) }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs mt-1">
                                    <span class="font-bold text-blue-600 dark:text-blue-400">{{ floor($progres) }}% Terkumpul</span>
                                    <span class="text-gray-500">
                                        Target: <strong>Rp{{ number_format($kampanye->target_donasi, 0, ',', '.') }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="dark:border-gray-700 my-6">

                    {{-- Form Input Donasi --}}
                    <form wire:submit="save">
                        <div class="space-y-6">
                            <div>
                                <label for="jumlah_donasi" class="block font-medium text-lg text-gray-700 dark:text-gray-300">Masukkan Jumlah Donasi Anda</label>
                                <div class="mt-2 relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input wire:model="jumlah_donasi" id="jumlah_donasi" type="number" class="block w-full rounded-md border-0 py-2 pl-8 pr-12 text-gray-900 dark:bg-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-600 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Minimal 10.000">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Sisa target yang dibutuhkan: Rp{{ number_format($sisaTarget, 0, ',', '.') }}</p>
                                @error('jumlah_donasi') <span class="text-red-500 text-sm mt-2">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50" wire:loading.attr="disabled">
                                    <span wire:loading.remove>Kirim Donasi</span>
                                    <span wire:loading>Memproses...</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
