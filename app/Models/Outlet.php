<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_outlet',
        'alamat_outlet',
        'nomor_layanan',
        'layanan_laundry',
        'deskripsi_outlet',
        'image',
        'layanan_detail'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_favorite_outlets', 'outlet_id', 'user_id');
    }
}
