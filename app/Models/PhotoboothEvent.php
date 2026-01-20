<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoboothEvent extends Model
{
    protected $fillable = [
        'title',
        'strips_count',
        'price_per_strip',
        'total_price',
        'is_active',
    ];

    protected $casts = [
        'price_per_strip' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function queues(): HasMany
    {
        return $this->hasMany(PhotoboothQueue::class);
    }

    public function activeQueues(): HasMany
    {
        return $this->hasMany(PhotoboothQueue::class)->where('is_picked_up', false);
    }

    public function completedQueues(): HasMany
    {
        return $this->hasMany(PhotoboothQueue::class)->where('is_picked_up', true);
    }

    public function totalRevenue()
    {
        return $this->queues()->where('is_paid', true)->sum('total_amount');
    }

    protected static function booted()
    {
        static::saving(function ($event) {
            $event->total_price = $event->strips_count * $event->price_per_strip;
        });
    }
}
