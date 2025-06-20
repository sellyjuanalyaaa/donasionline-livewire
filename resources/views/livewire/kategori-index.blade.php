<div>
    {{-- Menggunakan header standar aplikasi untuk konsistensi --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Manajemen Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Pesan Notifikasi Sukses --}}
            @if (session()->has('success'))
                <div class="bg-teal-50 dark:bg-teal-900/50 border-l-4 border-teal-400 dark:border-teal-600 text-teal-800 dark:text-teal-200 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Kartu untuk Form Tambah/Edit Kategori --}}
            <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-4">{{ $editId ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h3>
                
                {{-- DIUBAH: Form dibuat lebih ringkas dengan layout flex --}}
                <form wire:submit.prevent="save">
                    <div class="flex items-start gap-x-3">
                        <div class="flex-grow">
                            <input type="text" wire:model="nama_kategori" placeholder="Masukkan nama kategori..." class="block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                            @error('nama_kategori') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex-shrink-0 flex items-center gap-x-3">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-teal-700 transition">
                                {{-- Ikon berubah sesuai mode edit/tambah --}}
                                @if($editId)
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M7.5 3.75A1.75 1.75 0 0 0 5.75 5.5v8.01A1.75 1.75 0 0 0 7.5 15.26V17.25a.75.75 0 0 0 1.5 0v-2.013a1.75 1.75 0 0 0 1.75-1.737V5.5A1.75 1.75 0 0 0 9 3.75H7.5Z" /></svg>
                                    Update
                                @else
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" /></svg>
                                    Tambah
                                @endif
                            </button>
                            @if($editId)
                                <button type="button" wire:click="resetForm" class="text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">Batal</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>


            {{-- Kartu untuk Daftar Kategori --}}
            <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                 <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-4">Daftar Kategori</h3>

                {{-- DIUBAH TOTAL: Tabel diganti menjadi daftar kartu yang modern --}}
                <div class="space-y-2">
                    @forelse ($kategoris as $index => $kategori)
                        <div class="bg-slate-50 dark:bg-slate-800/50 p-3 rounded-lg flex items-center justify-between">
                            <div class="flex items-center gap-x-3">
                                <span class="text-sm font-semibold text-slate-500">{{ $index + 1 }}.</span>
                                <p class="font-semibold text-slate-700 dark:text-slate-200">{{ $kategori->nama_kategori }}</p>
                            </div>

                            {{-- Tombol Aksi Ikonik --}}
                            <div class="flex items-center space-x-1">
                                <button wire:click="edit({{ $kategori->id }})" class="p-2 text-amber-500 hover:bg-amber-100 dark:hover:bg-slate-700 rounded-full transition" title="Edit">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3L9.42 12.417a4 4 0 0 1-1.341.936l-3.155 1.262a.5.5 0 0 1-.65-.65Z" /><path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25-1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" /></svg>
                                </button>
                                <button wire:click="delete({{ $kategori->id }})" wire:confirm="Yakin ingin menghapus kategori ini?" class="p-2 text-rose-500 hover:bg-rose-100 dark:hover:bg-slate-700 rounded-full transition" title="Hapus">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.58.22-2.365.468a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193v-.443A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25-.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 text-slate-500">
                            Belum ada kategori yang ditambahkan.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>