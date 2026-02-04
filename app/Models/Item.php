<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'rent_price',
        'buy_price',
        'quantity',
        'condition',
        'status',
        'location',
        'image',
    ];

    protected $casts = [
        'rent_price' => 'decimal:2',
        'buy_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'Ready' && $this->condition !== 'Bad' && $this->quantity > 0;
    }

    // Accessor for backward compatibility (daily_rate is actually rent_price)
    public function getDailyRateAttribute()
    {
        return $this->rent_price;
    }
}
