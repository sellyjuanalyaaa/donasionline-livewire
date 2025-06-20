<div>
    {{-- DIUBAH: Menggunakan header standar aplikasi --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Laporan Donasi per Kampanye') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- BARU: Kartu statistik untuk Total Seluruh Donasi --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1 bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm flex items-center gap-x-5">
                    <div class="flex-shrink-0 bg-teal-100 dark:bg-teal-900/50 p-4 rounded-full">
                        <svg class="h-8 w-8 text-teal-600 dark:text-teal-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6V5.25m0 0A2.25 2.25 0 0 1 5.25 3h13.5A2.25 2.25 0 0 1 21 5.25v.75m0 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m15.75 0-1.28-1.28a.75.75 0 0 0-1.06 0l-1.28 1.28m-12 0l1.28-1.28a.75.75 0 0 1 1.06 0l1.28 1.28" /></svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-medium text-slate-500 dark:text-slate-400 truncate">Total Seluruh Donasi</h3>
                        <p class="mt-1 text-2xl lg:text-3xl font-bold text-teal-600 dark:text-teal-400">
                            Rp{{ number_format($totalSeluruhDonasi, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- DIUBAH TOTAL: Desain ulang tabel laporan menjadi lebih modern --}}
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">Ringkasan per Kampanye</h3>
                            <p class="text-sm text-slate-500 mt-1">Data donasi yang terkumpul untuk setiap kampanye.</p>
                        </div>
                        <a href="{{ route('admin.transaksi.index') }}" wire:navigate class="inline-flex items-center px-4 py-2 bg-slate-100 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg font-semibold text-xs text-slate-700 dark:text-slate-200 uppercase tracking-widest hover:bg-slate-200 dark:hover:bg-slate-600 transition">
                            Semua Transaksi
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            {{-- Header tabel yang bersih tanpa border vertikal --}}
                            <thead class="bg-slate-50 dark:bg-slate-700/50 text-xs text-slate-500 dark:text-slate-400 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Kampanye</th>
                                    <th scope="col" class="px-6 py-3">Target</th>
                                    <th scope="col" class="px-6 py-3">Terkumpul</th>
                                    <th scope="col" class="px-6 py-3 text-center">Jml. Transaksi</th>
                                    <th scope="col" class="px-6 py-3">Progres</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kampanyes as $kampanye)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 border-b dark:border-slate-700">
                                        <td class="px-6 py-4 font-semibold text-slate-800 dark:text-slate-100">
                                            {{ $kampanye->judul }}
                                        </td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                            Rp{{ number_format($kampanye->target_donasi, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-teal-600 dark:text-teal-400">
                                            Rp{{ number_format($kampanye->terkumpul ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-center text-slate-600 dark:text-slate-300">
                                            {{ $kampanye->jumlah_transaksi }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{-- Desain Progress Bar yang lebih modern --}}
                                            @php
                                                $progres = ($kampanye->target_donasi > 0) ? (($kampanye->terkumpul ?? 0) / $kampanye->target_donasi) * 100 : 0;
                                            @endphp
                                            <div class="flex items-center gap-x-3">
                                                <div class="w-full bg-slate-200 dark:bg-slate-600 rounded-full h-2.5">
                                                    <div class="bg-teal-500 h-2.5 rounded-full" style="width: {{ min($progres, 100) }}%"></div>
                                                </div>
                                                <span class="text-xs font-semibold text-slate-500">{{ floor($progres) }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10 text-slate-500">
                                            Belum ada data kampanye untuk ditampilkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-6">
                        {{ $kampanyes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>