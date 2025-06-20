<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('kampanyes', function (Blueprint $table) {
            // Cek jika kolomnya belum ada untuk menghindari error
            if (!Schema::hasColumn('kampanyes', 'kategori_id')) {
                // Tambahkan kolom setelah kolom 'judul' dan hubungkan ke tabel 'kategoris'
                $table->foreignId('kategori_id')
                    ->nullable()
                    ->after('judul')
                    ->constrained('kategoris')
                      ->onDelete('set null'); // Jika kategori dihapus, kolom ini jadi null
            }
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('kampanyes', function (Blueprint $table) {
            if (Schema::hasColumn('kampanyes', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }
        });
    }
};
