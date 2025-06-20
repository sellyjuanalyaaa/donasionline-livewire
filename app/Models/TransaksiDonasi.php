<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiDonasi extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'kode_transaksi',
        'donatur_id',
        'kampanye_id',
        'jumlah',
        'status',
        // 'metode_pembayaran',
    ];

    public function donatur(): BelongsTo
    {
        return $this->belongsTo(Donatur::class);
    }

    public function kampanye(): BelongsTo
    {
        return $this->belongsTo(Kampanye::class);
    }
}
