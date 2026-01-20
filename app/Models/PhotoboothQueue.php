<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PhotoboothQueue extends Model
{
    protected $fillable = [
        'photobooth_event_id',
        'customer_name',
        'strips_ordered',
        'whatsapp_number',
        'total_amount',
        'is_paid',
        'is_photographed',
        'is_printed',
        'is_ready',
        'is_picked_up',
        'paid_at',
        'photographed_at',
        'printed_at',
        'ready_at',
        'picked_up_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'is_paid' => 'boolean',
        'is_photographed' => 'boolean',
        'is_printed' => 'boolean',
        'is_ready' => 'boolean',
        'is_picked_up' => 'boolean',
        'paid_at' => 'datetime',
        'photographed_at' => 'datetime',
        'printed_at' => 'datetime',
        'ready_at' => 'datetime',
        'picked_up_at' => 'datetime',
    ];

    public function photoboothEvent(): BelongsTo
    {
        return $this->belongsTo(PhotoboothEvent::class);
    }

    public function financialRecord(): HasOne
    {
        return $this->hasOne(FinancialRecord::class);
    }

    protected static function booted()
    {
        static::saving(function ($queue) {
            $event = $queue->photoboothEvent;
            if ($event) {
                $queue->total_amount = $queue->strips_ordered * $event->price_per_strip;
            }
        });

        static::saved(function ($queue) {
            // Auto-create financial record when payment is marked as paid
            if ($queue->is_paid && !$queue->financialRecord) {
                FinancialRecord::create([
                    'type' => 'income',
                    'category' => 'photobooth',
                    'description' => "Photobooth payment - {$queue->customer_name} ({$queue->strips_ordered} strips)",
                    'amount' => $queue->total_amount,
                    'date' => now()->toDateString(),
                    'photobooth_queue_id' => $queue->id,
                ]);
            }
        });
    }
}
