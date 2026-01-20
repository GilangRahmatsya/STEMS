<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'returned_at',
        'notes',
        'rejection_reason',
        'payment_status',
        'pickup_status',
        'return_status',
        'borrower_name',
        'borrower_birth_date',
        'purpose',
        'ktp_status',
        'ktp_notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'returned_at' => 'datetime',
        'borrower_birth_date' => 'date',
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

    public function calculateTotalPrice(): float
    {
        $days = $this->getDurationInDays();
        return $this->item->rent_price * $days;
    }

    public function isActive(): bool
    {
        return $this->status === 'approved' && is_null($this->returned_at);
    }

    public function isOverdue(): bool
    {
        if (!$this->isActive()) {
            return false;
        }
        return now()->greaterThan($this->end_date);
    }
}