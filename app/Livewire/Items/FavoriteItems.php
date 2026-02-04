<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class FavoriteItems extends Component
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
        // Get user favorites from session/local storage via JavaScript
        // For now, display top rated/newest items as "favorites"
        $items = Item::query()
            ->where('status', 'Ready')
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->when($this->category, fn($query) => $query->where('category', $this->category))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Item::select('category')->distinct()->get()->pluck('category');

        return view('livewire.items.favorite-items', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}
