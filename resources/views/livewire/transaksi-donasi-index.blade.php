<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Semua Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Daftar Transaksi Donasi
                        </h3>
                        {{-- Input Pencarian --}}
                        <div>
                            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari donatur atau kampanye..." class="w-full sm:w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    {{-- Tabel Transaksi --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">Tanggal</th>
                                    <th scope="col" class="py-3 px-6">Donatur</th>
                                    <th scope="col" class="py-3 px-6">Kampanye</th>
                                    <th scope="col" class="py-3 px-6">Jumlah</th>
                                    <th scope="col" class="py-3 px-6">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($transaksis as $transaksi)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6">{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                        <td class="py-4 px-6">{{ $transaksi->donatur->nama ?? 'N/A' }}</td>
                                        <td class="py-4 px-6">{{ $transaksi->kampanye->judul ?? 'N/A' }}</td>
                                        <td class="py-4 px-6">Rp{{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                        <td class="py-4 px-6">
                                            @if($transaksi->status == 'berhasil')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Berhasil
                                                </span>
                                            @elseif($transaksi->status == 'pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Gagal
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-6 text-gray-500">
                                            Tidak ada transaksi yang cocok dengan pencarian Anda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $transaksis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
