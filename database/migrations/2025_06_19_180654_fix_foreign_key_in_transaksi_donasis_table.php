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
        Schema::table('transaksi_donasis', function (Blueprint $table) {
            // 1. Hapus foreign key yang salah terlebih dahulu
            // Laravel secara default menamai constraint: namatabel_namakolom_foreign
            // $table->dropForeign('transaksi_donasis_donatur_id_foreign');

            // 2. Tambahkan foreign key yang benar
            // Menghubungkan 'donatur_id' ke kolom 'id' di tabel 'donaturs'
            $table->foreign('donatur_id')
                  ->references('id')
                  ->on('donaturs')
                  ->onDelete('cascade');
        });
    }

    /**
     * Batalkan migrasi (opsional).
     */
    public function down(): void
    {
        Schema::table('transaksi_donasis', function (Blueprint $table) {
            // Langkah kebalikan untuk rollback
            $table->dropForeign(['donatur_id']);

            $table->foreign('donatur_id')
                  ->references('id')
                  ->on('donasis') // <- Kembalikan ke relasi yang salah
                  ->onDelete('cascade');
        });
    }
};
