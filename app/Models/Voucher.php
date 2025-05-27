<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description', 
        'discount_amount',
        'valid_until',
        'is_active',
        'max_uses',
        'current_uses'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean'
    ];
}