<div class="bg-slate-50 dark:bg-slate-900">

    <section class="relative bg-white dark:bg-slate-800/50 pt-20 pb-16 md:pt-28 md:pb-24 overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-grid-slate-100 dark:bg-grid-slate-700/40 [mask-image:linear-gradient(to_bottom,white_20%,transparent_100%)]"></div>
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-800 dark:text-slate-100">
                Selamat Datang Kembali, <span class="text-teal-600 dark:text-teal-400">{{ $namaDonatur }}</span>!
            </h1>
            <p class="mt-5 text-lg text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                Setiap donasi Anda adalah harapan baru bagi mereka yang membutuhkan. Terima kasih telah menjadi pahlawan kebaikan.
            </p>
            <div class="mt-8 flex justify-center">
                <a href="#kampanye" class="bg-teal-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-teal-700 transition duration-300 transform hover:scale-105">
                    Lihat Program Kebaikan
                </a>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-200">Jejak Kebaikan Anda</h2>
                <p class="mt-2 text-slate-500">Berikut adalah rekapitulasi dampak yang telah Anda ciptakan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-teal-100 dark:bg-teal-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-teal-600 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9.75m18 0v-6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 3.75v6m15-3.75a.75.75 0 0 0-.75-.75H13.5a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 .75-.75Zm-4.5 0a.75.75 0 0 0-.75-.75h-.75a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 .75-.75Z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400">Total Donasi Anda</h3>
                        <p class="mt-1 text-3xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">Rp{{ number_format($totalDonasi, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-sky-100 dark:bg-sky-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-sky-600 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.621 0-1.125.504-1.125 1.125v3.375m9 0h-9m9 0h1.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6v6.75a2.25 2.25 0 0 0 2.25 2.25H6.75" /></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400">Total Transaksi Berhasil</h3>
                        <p class="mt-1 text-3xl font-bold text-slate-800 dark:text-slate-100 tracking-tight">{{ $jumlahTransaksi }} Kali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-16">
        <div class="max-w-5xl mx-auto px-6">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200">Aktivitas Donasi Terkini</h2>
            </div>
            <div class="space-y-4">
                @forelse ($recentDonations as $donasi)
                    <div class="bg-white dark:bg-slate-800/50 p-4 rounded-lg border border-slate-200 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-slate-100">{{ $donasi->kampanye->judul }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $donasi->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-lg text-teal-600 dark:text-teal-400">Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                            <span class="text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300 py-0.5 px-2 rounded-full">Berhasil</span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-slate-800/50 text-center py-8 px-4 rounded-lg border border-slate-200 dark:border-slate-700">
                        <p class="text-slate-500">Anda belum memiliki riwayat donasi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    <section id="kampanye" class="py-16 bg-white dark:bg-slate-800/50 border-t dark:border-slate-700">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-200">Pilih Kampanye, Tebar Kebaikan</h2>
                <p class="mt-3 text-lg text-slate-600 dark:text-slate-400 max-w-3xl mx-auto">Temukan program kebaikan yang menyentuh hati Anda dan salurkan donasi untuk membantu sesama.</p>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-center gap-4 mb-10">
                <div class="w-full md:w-2/5">
                    <label for="search" class="sr-only">Cari Kampanye</label>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search" placeholder="Cari judul kampanye..." class="w-full bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div class="w-full md:w-1/4">
                    <label for="filterKategori" class="sr-only">Filter berdasarkan kategori</label>
                    <select wire:model.live="filterKategori" id="filterKategori" class="w-full bg-white dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid gap-x-6 gap-y-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($kampanyes as $kampanye)
                    <div class="bg-white dark:bg-slate-800 group rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 flex flex-col transition-all duration-300 hover:shadow-xl hover:-translate-y-1.5">
                        <a href="{{ route('donatur.donasi.create', ['kampanye_id' => $kampanye->id]) }}" class="block">
                            <img class="h-52 w-full object-cover" src="{{ $kampanye->gambar ? asset('storage/' . $kampanye->gambar) : 'https://placehold.co/600x400/e2e8f0/e2e8f0?text=.' }}" alt="Gambar {{ $kampanye->judul }}">
                        </a>
                        <div class="p-5 flex-grow flex flex-col">
                            <span class="text-xs font-semibold text-teal-800 dark:text-teal-200 bg-teal-100 dark:bg-teal-900/50 py-1 px-2.5 rounded-full self-start">{{ $kampanye->kategori->nama_kategori ?? 'Tanpa Kategori' }}</span>
                            <h4 class="font-bold text-lg text-slate-800 dark:text-slate-100 mt-3 group-hover:text-teal-600 transition line-clamp-2">{{ $kampanye->judul }}</h4>
                            
                            <div class="mt-4 flex-grow space-y-3">
                                <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                    @php
                                        $progres = ($kampanye->target_donasi > 0) ? (($kampanye->terkumpul ?? 0) / $kampanye->target_donasi) * 100 : 0;
                                    @endphp
                                    <div class="bg-teal-500 h-2 rounded-full" style="width: {{ min($progres, 100) }}%"></div>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="font-semibold text-teal-600 dark:text-teal-400">{{ floor($progres) }}% Terkumpul</span>
                                    <span class="text-slate-500 dark:text-slate-400 flex items-center gap-1">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.41-1.412a6.962 6.962 0 0 0-1.608-2.908 1 1 0 0 0-.354-.487l-2.072-1.479a3.528 3.528 0 0 1-2.434 0l-2.072 1.479a1 1 0 0 0-.354.487 6.962 6.962 0 0 0-1.608 2.908Z" /></svg>
                                        {{ $kampanye->jumlah_pendonasi }} Donatur
                                    </span>
                                </div>

                                <div class="mt-2 pt-2 border-t border-slate-200 dark:border-slate-700 flex justify-between text-sm">
                                    <span class="text-slate-500 dark:text-slate-400">Target</span>
                                    <span class="font-semibold text-slate-700 dark:text-slate-200">
                                        Rp{{ number_format($kampanye->target_donasi, 0, ',', '.') }}
                                    </span>
                                </div>
                                </div>
                            
                            <div class="mt-6">
                                <a href="{{ route('donatur.donasi.create', ['kampanye_id' => $kampanye->id]) }}" wire:navigate class="block w-full text-center bg-teal-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-teal-700 transition">
                                    Lihat Detail & Donasi
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 text-center py-16">
                        <p class="text-slate-500">Tidak ada kampanye yang cocok dengan pencarian atau filter Anda.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $kampanyes->links() }}
            </div>
        </div>
    </section>
</div>