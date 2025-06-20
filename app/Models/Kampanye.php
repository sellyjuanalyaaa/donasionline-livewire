<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kampanye extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'deskripsi', 'kategori_id', 'target_donasi', 
        'tanggal_mulai', 'tanggal_selesai', 'gambar', 'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'target_donasi' => 'decimal:2',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * PERBAIKAN: Ubah relasi ini agar menunjuk ke model TransaksiDonasi.
     * Sekarang, setiap kali Anda memanggil $kampanye->donasis(), 
     * ia akan mengambil data dari tabel 'transaksi_donasis'.
     */
    public function donasis(): HasMany
    {
        return $this->hasMany(TransaksiDonasi::class);
    }

    // Accessor untuk progres tidak perlu diubah, karena ia akan otomatis
    // menggunakan relasi donasis() yang sudah kita perbaiki di atas.
    public function getProgresAttribute(): int
    {
        if ($this->target_donasi > 0) {
            $persentase = (($this->donasis_sum_jumlah ?? 0) / $this->target_donasi) * 100;
            return floor($persentase);
        }
        return 0;
    }
}
