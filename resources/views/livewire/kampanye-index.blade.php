<div>
    {{-- Menambahkan header standar aplikasi untuk konsistensi --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Manajemen Kampanye') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Pesan Notifikasi Sukses --}}
            @if (session()->has('success'))
                <div class="bg-teal-50 dark:bg-teal-900/50 border-l-4 border-teal-400 dark:border-teal-600 text-teal-800 dark:text-teal-200 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Layout Utama: Kiri (Form), Kanan (Daftar) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Form Tambah/Edit --}}
                <div class="lg:col-span-1">
                    {{-- DIUBAH: Styling kartu form --}}
                    <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                        <form wire:submit="save">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-6">{{ $editId ? 'Edit Kampanye' : 'Tambah Kampanye Baru' }}</h3>
                            <div class="space-y-5">
                                {{-- DIUBAH: Styling semua form input --}}
                                <div>
                                    <label for="judul" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Judul Kampanye</label>
                                    <input type="text" wire:model="judul" id="judul" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    @error('judul') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                
                                <div>
                                    <label for="kategori_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kategori</label>
                                    <select wire:model="kategori_id" id="kategori_id" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Deskripsi</label>
                                    <textarea wire:model="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500"></textarea>
                                    @error('deskripsi') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                {{-- ... Tambahkan input form lainnya di sini dengan styling yang sama ... --}}
                            </div>
                            <div class="mt-6 flex items-center space-x-4">
                                {{-- DIUBAH: Styling tombol aksi --}}
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-teal-700 transition">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M7.5 3.75A1.75 1.75 0 0 0 5.75 5.5v8.01A1.75 1.75 0 0 0 7.5 15.26V17.25a.75.75 0 0 0 1.5 0v-2.013a1.75 1.75 0 0 0 1.75-1.737V5.5A1.75 1.75 0 0 0 9 3.75H7.5Z" /></svg>
                                    {{ $editId ? 'Update Kampanye' : 'Simpan Kampanye' }}
                                </button>
                                @if($editId)
                                    <button type="button" wire:click="resetForm" class="text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">Batal</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Daftar Kampanye --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">Daftar Kampanye</h3>
                            <div class="flex items-center space-x-2 w-full sm:w-auto">
                                {{-- DIUBAH: Styling filter & search --}}
                                <select wire:model.live="filterKategori" class="w-full sm:w-40 bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari..." class="w-full sm:w-auto bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            </div>
                        </div>

                        {{-- DIUBAH TOTAL: Tabel diganti menjadi daftar kartu yang modern & responsif --}}
                        <div class="space-y-3">
                            @forelse ($kampanyes as $kampanye)
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-200 dark:border-slate-700 flex items-center gap-4">
                                    @if($kampanye->gambar)
                                        <img src="{{ asset('storage/' . $kampanye->gambar) }}" alt="{{ $kampanye->judul }}" class="flex-shrink-0 h-16 w-16 object-cover rounded-lg">
                                    @else
                                        <div class="flex-shrink-0 h-16 w-16 bg-slate-200 dark:bg-slate-700 rounded-lg flex items-center justify-center text-slate-400">
                                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                                        </div>
                                    @endif
                                    <div class="flex-grow min-w-0">
                                        <p class="font-semibold text-slate-800 dark:text-slate-100 truncate">{{ $kampanye->judul }}</p>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $kampanye->kategori->nama_kategori ?? 'N/A' }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full {{ $kampanye->status == 'aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300' }}">
                                            {{ ucfirst($kampanye->status) }}
                                        </span>
                                    </div>
                                    {{-- Tombol Aksi dengan Ikon --}}
                                    <div class="flex-shrink-0 flex items-center space-x-1">
                                        <button wire:click="edit({{ $kampanye->id }})" class="p-2 text-amber-500 hover:bg-amber-100 dark:hover:bg-slate-700 rounded-full transition">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3L9.42 12.417a4 4 0 0 1-1.341.936l-3.155 1.262a.5.5 0 0 1-.65-.65Z" /><path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" /></svg>
                                        </button>
                                        <button wire:click="delete({{ $kampanye->id }})" wire:confirm="Yakin ingin menghapus kampanye ini?" class="p-2 text-rose-500 hover:bg-rose-100 dark:hover:bg-slate-700 rounded-full transition">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.58.22-2.365.468a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193v-.443A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <tr><td colspan="5" class="border px-4 py-4 text-center">Tidak ada data.</td></tr>
                            @endforelse
                        </div>

                        <div class="mt-6">
                            {{ $kampanyes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>