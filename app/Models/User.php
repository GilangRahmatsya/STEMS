<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Relasi ke Rental
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    // Method untuk mendapatkan inisial nama
    public function initials()
    {
        $parts = explode(' ', $this->name);
        $initials = '';

        foreach ($parts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }

        return $initials;
    }
}
