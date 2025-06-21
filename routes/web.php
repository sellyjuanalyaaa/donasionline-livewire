<?php

use Illuminate\Support\Facades\Route;

// --- USE STATEMENTS ---
// use App\Livewire\WelcomePage;
use App\Livewire\Auth\DonaturLogin;
use App\Livewire\Auth\DonaturRegister;
use App\Livewire\Donatur\Dashboard as DonaturDashboard;
use App\Livewire\Donatur\DonasiForm;
use App\Livewire\Donatur\RiwayatDonasi;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\KategoriIndex;
use App\Livewire\DonasiIndex;
use App\Livewire\DonaturCreate;
use App\Livewire\DonaturIndex;
use App\Livewire\KampanyeForm;
use App\Livewire\KampanyeIndex;
use App\Livewire\TransaksiDonasiIndex;



// Route::get('/', WelcomePage::class)->name('welcome');
Route::get('/donatur/login', DonaturLogin::class)->name('donatur.login');
Route::get('/donatur/register', DonaturRegister::class)->name('donatur.register');

// --- RUTE AREA DONATUR (GUARD: 'donatur') ---
Route::middleware('auth:donatur')->name('donatur.')->prefix('member')->group(function () {
    Route::get('/dashboard', DonaturDashboard::class)->name('dashboard');
    Route::get('/donasi/buat/{kampanye_id}', DonasiForm::class)->name('donasi.create');
    Route::get('/riwayat', RiwayatDonasi::class)->name('riwayat');
    // Route::get('/profile', Profile::class)->name('profile');
});

// --- RUTE AREA ADMIN (GUARD: 'web' & GATE: 'isAdmin') ---
Route::prefix('admin')->middleware('auth:web')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    
    // Rute manajemen CRUD
    Route::get('/kategori', KategoriIndex::class)->name('kategori.index');
    Route::get('/donasi', DonasiIndex::class)->name('donasi.index');
        Route::get('/donatur/create', DonaturCreate::class)->name('donatur.create');

    Route::get('/donatur', DonaturIndex::class)->name('donatur.index');
    Route::get('/kampanye', KampanyeIndex::class)->name('kampanye.index');
        Route::get('/kampanye/create', KampanyeForm::class)->name('kampanye.create');
    Route::get('/kampanye/{kampanye}/edit', KampanyeForm::class)->name('kampanye.edit');

    Route::get('/transaksi', TransaksiDonasiIndex::class)->name('transaksi.index');


    Route::view('/profile', 'profile')->name('profile');
});


// --- RUTE AUTENTIKASI BAWAAN (Untuk Admin) ---
require __DIR__.'/auth.php';
