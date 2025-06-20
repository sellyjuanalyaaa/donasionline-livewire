<div>
    {{-- Menggunakan header standar aplikasi --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Manajemen Donatur') }}
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
                    <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                        <form wire:submit="save">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-6">{{ $editId ? 'Edit Data Donatur' : 'Tambah Donatur Baru' }}</h3>
                            <div class="space-y-5">
                                {{-- Styling semua form input diseragamkan --}}
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nama</label>
                                    <input type="text" wire:model="nama" id="nama" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    @error('nama') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Email</label>
                                    <input type="email" wire:model="email" id="email" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="nomor_telepon" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Nomor Telepon</label>
                                    <input type="text" wire:model="nomor_telepon" id="nomor_telepon" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    @error('nomor_telepon') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Password</label>
                                    <input type="password" wire:model="password" id="password" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500" placeholder="{{ $editId ? 'Kosongkan jika tidak diubah' : '' }}">
                                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Alamat</label>
                                    <textarea wire:model="alamat" id="alamat" rows="3" class="mt-1 block w-full bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500"></textarea>
                                    @error('alamat') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mt-6 flex items-center space-x-4">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-teal-700 transition">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M7.5 3.75A1.75 1.75 0 0 0 5.75 5.5v8.01A1.75 1.75 0 0 0 7.5 15.26V17.25a.75.75 0 0 0 1.5 0v-2.013a1.75 1.75 0 0 0 1.75-1.737V5.5A1.75 1.75 0 0 0 9 3.75H7.5Z" /></svg>
                                    {{ $editId ? 'Update Donatur' : 'Simpan Donatur' }}
                                </button>
                                @if($editId)
                                    <button type="button" wire:click="resetForm" class="text-sm text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">Batal</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Kolom Kanan: Daftar Donatur --}}
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-slate-800 shadow-sm border border-slate-200 dark:border-slate-700 rounded-2xl p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100">Daftar Donatur Terdaftar</h3>
                            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email..." class="w-full sm:w-auto bg-slate-50 dark:bg-slate-700 border-slate-300 dark:border-slate-600 rounded-lg shadow-sm focus:border-teal-500 focus:ring-teal-500">
                        </div>
                        
                        <div class="space-y-3">
                            @forelse ($donaturs as $donatur)
                                <div class="bg-slate-50 dark:bg-slate-800/50 p-4 rounded-xl border border-slate-200 dark:border-slate-700 flex items-center gap-4">
                                    <img class="h-12 w-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($donatur->nama) }}&background=E0F2F1&color=00796B" alt="Avatar {{ $donatur->nama }}">
                                    
                                    {{-- ==================== PERBAIKAN DI SINI ==================== --}}
                                    <div class="flex-grow min-w-0">
                                        <p class="font-semibold text-slate-800 dark:text-slate-100 truncate">{{ $donatur->nama }}</p>
                                        {{-- Detail kontak dengan ikon --}}
                                        <div class="mt-1 space-y-1 text-sm text-slate-500 dark:text-slate-400">
                                            <div class="flex items-center gap-x-2">
                                                <svg class="h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a2 2 0 0 0-2 2v1.161l8.441 4.221a1.25 1.25 0 0 0 1.118 0L19 7.162V6a2 2 0 0 0-2-2H3Z" /><path d="M19 8.839l-7.77 3.885a2.75 2.75 0 0 1-2.46 0L1 8.839V14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8.839Z" /></svg>
                                                <span class="truncate">{{ $donatur->email }}</span>
                                            </div>
                                            <div class="flex items-center gap-x-2">
                                                <svg class="h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5h-1.528a1.5 1.5 0 0 1-1.465-1.175l-.716-3.223a1.5 1.5 0 0 0-1.767-1.052l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 1-6.254-6.254c-.163-.395.07-.833.48-.95l.933-.267a1.5 1.5 0 0 0 1.052-1.767l-.716-3.223A1.5 1.5 0 0 1 3.5 2H2Z" clip-rule="evenodd" /></svg>
                                                <span class="truncate">{{ $donatur->telepon ?? '-' }}</span>
                                            </div>
                                            <div class="flex items-center gap-x-2">
                                                <svg class="h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="m9.69 18.933.003.001a9.995 9.995 0 0 1 5.6-1.282A5 5 0 0 0 10 11.25a5 5 0 0 0-5.293 6.402 9.995 9.995 0 0 1 5.6-1.282Z" clip-rule="evenodd" /><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM12 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" clip-rule="evenodd" /></svg>
                                                <span class="truncate">{{ $donatur->alamat ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- ==================== AKHIR PERBAIKAN ==================== --}}


                                    {{-- Tombol Aksi dengan Ikon --}}
                                    <div class="flex-shrink-0 flex items-center space-x-1">
                                        <button wire:click="edit({{ $donatur->id }})" class="p-2 text-amber-500 hover:bg-amber-100 dark:hover:bg-slate-700 rounded-full transition" title="Edit">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3L9.42 12.417a4 4 0 0 1-1.341.936l-3.155 1.262a.5.5 0 0 1-.65-.65Z" /><path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25-1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" /></svg>
                                        </button>
                                        <button wire:click="delete({{ $donatur->id }})" wire:confirm="Apakah Anda yakin ingin menghapus donatur ini?" class="p-2 text-rose-500 hover:bg-rose-100 dark:hover:bg-slate-700 rounded-full transition" title="Hapus">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.58.22-2.365.468a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193v-.443A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" /></svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 text-slate-500">
                                    Tidak ada data donatur ditemukan.
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-6">
                            {{ $donaturs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>