<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kampanyes', function (Blueprint $table) {
            // 1. Ubah nama kolom yang sudah ada
            $table->renameColumn('nama_kampanye', 'judul');
            
            // 2. Ubah tipe dan nama kolom target
            $table->decimal('target', 15, 2)->change(); // Ubah ke decimal dulu
            $table->renameColumn('target', 'target_donasi');

            // 3. Hapus kolom kategori_id
            $table->dropForeign(['kategori_id']); // Hapus foreign key dulu
            $table->dropColumn('kategori_id');

            // 4. Tambahkan kolom-kolom baru
            $table->text('deskripsi')->after('judul');
            $table->date('tanggal_mulai')->after('target_donasi');
            $table->date('tanggal_selesai')->after('tanggal_mulai');
            $table->string('gambar')->nullable()->after('tanggal_selesai');
            $table->enum('status', ['aktif', 'selesai', 'ditutup'])->default('aktif')->after('gambar');
        });
    }

    /**
     * Reverse the migrations.
     * (Untuk membatalkan perubahan jika diperlukan)
     */
    public function down(): void
    {
        Schema::table('kampanyes', function (Blueprint $table) {
            // Lakukan kebalikan dari method up()
            $table->renameColumn('judul', 'nama_kampanye');

            $table->integer('target_donasi')->change();
            $table->renameColumn('target_donasi', 'target');

            $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('cascade');

            $table->dropColumn(['deskripsi', 'tanggal_mulai', 'tanggal_selesai', 'gambar', 'status']);
        });
    }
};
