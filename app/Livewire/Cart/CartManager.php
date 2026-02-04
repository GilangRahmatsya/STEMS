<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class CartManager extends Component
{
    public $start_date;
    public $end_date;
    public $purpose;

    public function mount()
    {
        $this->start_date = now()->format('Y-m-d');
        $this->end_date = now()->addDay()->format('Y-m-d');
    }

    public function getCartProperty()
    {
        return Cart::with('items.item')->firstOrCreate(['user_id' => Auth::id()]);
    }

    public function removeItem($itemId)
    {
        $this->cart->items()->where('id', $itemId)->delete();
        $this->dispatch('cart-updated');
    }

    public function getEstimatedTotalProperty()
    {
        if (!$this->start_date || !$this->end_date) return 0;

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        
        if ($end < $start) return 0;
        
        $days = $start->diffInDays($end) + 1;
        $dailyTotal = $this->cart->items->sum(function($cartItem) {
            return $cartItem->item->rent_price * $cartItem->quantity;
        });

        return $dailyTotal * $days;
    }

    public function checkout()
    {
        $this->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'purpose' => 'nullable|string|max:500',
        ]);

        if ($this->cart->items->isEmpty()) {
            $this->addError('cart', 'Your cart is empty.');
            return;
        }

        $batchId = (string) Str::uuid();
        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $days = $start->diffInDays($end) + 1;

        DB::transaction(function () use ($batchId, $days) {
            foreach ($this->cart->items as $cartItem) {
                Rental::create([
                    'user_id' => Auth::id(),
                    'item_id' => $cartItem->item_id,
                    'batch_id' => $batchId,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'purpose' => $this->purpose,
                    'total_price' => $cartItem->item->rent_price * $days * $cartItem->quantity,
                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                ]);
            }

            // Clear cart
            $this->cart->items()->delete();
        });

        session()->flash('success', 'Rental request submitted successfully!');
        return redirect()->route('user.rentals.index');
    }

    public function render()
    {
        return view('livewire.cart.cart-manager', [
            'cart' => $this->cart,
            'estimatedTotal' => $this->estimatedTotal,
        ]);
    }
}
