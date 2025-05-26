<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
