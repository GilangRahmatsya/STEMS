<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'batch_id',
        'start_date',
        'end_date',
        'purpose',
        'total_price',
        'status',
        'payment_status',
        'pickup_status',
        'return_status',
        'returned_at',
        'notes',
        'rejection_reason',
        'borrower_name',
        'borrower_birth_date',
        'ktp_status',
        'ktp_notes',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'borrower_birth_date' => 'date',
        'returned_at' => 'datetime',
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function getDurationInDays(): int
    {
        return $this->start_date->diffInDays($this->end_date) + 1;
    }
}