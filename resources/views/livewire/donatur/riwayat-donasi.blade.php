<div>
    {{-- DIUBAH: Menggunakan header standar aplikasi --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Riwayat Donasi Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- DIUBAH: Konten utama dibungkus kembali dalam satu kartu besar --}}
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-2xl">
                <div class="p-6 md:p-8">

                    {{-- Daftar riwayat donasi berbasis kartu tetap dipertahankan --}}
                    <div class="space-y-4">
                        @forelse ($donasis as $donasi)
                            {{-- Setiap donasi adalah satu kartu --}}
                            <div class="bg-slate-50 dark:bg-slate-700/50 p-4 rounded-xl border border-slate-200 dark:border-slate-600 flex flex-col sm:flex-row justify-between items-start gap-4">
                                
                                {{-- Sisi Kiri: Detail Kampanye dan Tanggal --}}
                                <div class="flex-grow">
                                    <p class="font-bold text-lg text-slate-800 dark:text-slate-100 hover:text-teal-600 transition">
                                        {{ $donasi->kampanye->judul ?? 'Kampanye Telah Berakhir' }}
                                    </p>
                                    <div class="mt-2 flex items-center gap-x-4 text-sm text-slate-500 dark:text-slate-400">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5H4.75Z" clip-rule="evenodd" /></svg>
                                            {{ $donasi->created_at->isoFormat('D MMMM YYYY, HH:mm') }}
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <svg class="h-4 w-4 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.06 0l4-5.5Z" clip-rule="evenodd" /></svg>
                                            Berhasil
                                        </span>
                                    </div>
                                </div>

                                {{-- Sisi Kanan: Jumlah Donasi --}}
                                <div class="flex-shrink-0 text-left sm:text-right mt-2 sm:mt-0">
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Jumlah Donasi</p>
                                    <p class="font-bold text-xl text-teal-600 dark:text-teal-400">
                                        Rp{{ number_format($donasi->jumlah, 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>
                        @empty
                            {{-- Tampilan jika tidak ada riwayat donasi --}}
                            <div class="text-center py-16 px-6 border border-dashed border-slate-300 dark:border-slate-700 rounded-2xl">
                                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <h3 class="mt-2 text-lg font-medium text-slate-800 dark:text-slate-100">Belum Ada Riwayat</h3>
                                <p class="mt-1 text-sm text-slate-500">Anda belum pernah melakukan donasi melalui platform kami.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Paginasi --}}
                    <div class="mt-8">
                        {{ $donasis->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>