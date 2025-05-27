<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Tentukan kolom yang bisa diisi
    protected $fillable = [
        'no_order',
        'tgl_order',
        'nama_pelanggan',
        'jenis_paket',
        'waktu_kerja',
        'berat_kg',
        'status',
        'payment_status'
    ];
}
