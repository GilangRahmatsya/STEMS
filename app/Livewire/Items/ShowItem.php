<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;

class ShowItem extends Component
{
    public $item;

    public function mount(Item $item)
    {
        $this->item = $item->load('category');
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = \App\Models\Cart::firstOrCreate(['user_id' => auth()->id()]);
        
        $existingItem = $cart->items()->where('item_id', $this->item->id)->first();
        
        if ($existingItem) {
            $existingItem->increment('quantity');
            session()->flash('success', 'Item quantity updated in cart.');
        } else {
            $cart->items()->create([
                'item_id' => $this->item->id,
                'quantity' => 1
            ]);
            session()->flash('success', 'Item added to cart.');
        }
        
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.items.show-item', [
            'item' => $this->item,
        ]);
    }
}
