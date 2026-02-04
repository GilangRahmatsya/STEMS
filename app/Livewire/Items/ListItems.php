<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ListItems extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $category = '';

    protected $queryString = ['search', 'sortBy', 'sortDirection', 'category'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addToCart($itemId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $cart = \App\Models\Cart::firstOrCreate(['user_id' => auth()->id()]);
        
        $existingItem = $cart->items()->where('item_id', $itemId)->first();
        
        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            $cart->items()->create([
                'item_id' => $itemId,
                'quantity' => 1
            ]);
        }
        
        $this->dispatch('cart-updated'); // Optional: for navbar count if implemented
        session()->flash('success', 'Item added to cart.');
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $items = Item::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->when($this->category, fn($query) => $query->where('category', $this->category))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.items.list-items', [
            'items' => $items,
        ]);
    }
}
