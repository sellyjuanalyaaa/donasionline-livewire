<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donasi extends Model
{
    use HasFactory;

    /**
     * Tentukan kolom yang boleh diisi (Mass Assignable).
     */
    protected $fillable = [
        'donatur_id',
        'kampanye_id',
        'jumlah',
        'tanggal',
    ];

    /**
     * Relasi: Satu Donasi dimiliki oleh satu Donatur.
     */
    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class);
    }

    /**
     * Relasi: Satu Donasi dimiliki oleh satu Kampanye.
     */
    public function kampanye(): BelongsTo
    {
        return $this->belongsTo(Kampanye::class);
    }
}
