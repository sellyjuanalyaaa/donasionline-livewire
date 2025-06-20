<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */// file: database/migrations/xxxx_xx_xx_xxxxxx_create_kampanyes_table.php

public function up(): void
{
    Schema::create('kampanyes', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('deskripsi');
        $table->decimal('target_donasi', 15, 2);
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->string('gambar')->nullable(); // Path ke file gambar
        $table->enum('status', ['aktif', 'selesai', 'ditutup'])->default('aktif');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kampanyes');
    }
};
