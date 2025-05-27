<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'telepon',
        'alamat',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function outlet()
    {
        return $this->hasOne(Outlet::class); // Relasi satu ke satu
    }

    public function favoriteOutlets(): BelongsToMany
    {
        return $this->belongsToMany(Outlet::class, 'user_favorite_outlets', 'user_id', 'outlet_id');
    }
}
