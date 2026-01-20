<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'name',
    'description',
    'category_id',
    'condition',
    'status',
    'location',
    'quantity',
    'buy_price',
    'rent_price',
    'image'
];

protected $casts = [
    'buy_price' => 'decimal:2',
    'rent_price' => 'decimal:2',
    'condition' => 'string'
];

// Relationships
public function category()
{
    return $this->belongsTo(Category::class);
}

public function rentals()
{
    return $this->hasMany(Rental::class);
}

public function isAvailable(): bool
{
        return $this->status === 'Ready' && $this->condition !== 'Bad' && $this->quantity > 0;
    }
}
