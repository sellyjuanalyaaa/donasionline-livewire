<?php

namespace App\Models;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_donasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi')->unique(); // ID unik untuk setiap donasi

            // Menghubungkan ke tabel donaturs dan kampanyes
            $table->foreignId('donatur_id')->constrained('donaturs')->onDelete('cascade');
            $table->foreignId('kampanye_id')->constrained('kampanyes')->onDelete('cascade');
            
            $table->decimal('jumlah', 15, 2); // Jumlah donasi
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->string('metode_pembayaran')->nullable();
            
            $table->timestamps(); // membuat kolom created_at dan updated_at
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('transaksi_donasis');
    }
};