<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donatur extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $guard = 'donatur';

    /**
     * Kolom yang boleh diisi.
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'telepon',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function donasis(): HasMany
    {
        return $this->hasMany(Donasi::class);
    }
}
