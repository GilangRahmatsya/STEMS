<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;

class Items extends Component
{
    public $selectedCategory = '';
    public $search = '';
    public $sortBy = 'name';
    public $perPage = 12;
    public $lazy = true; // Enable lazy loading

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Item::with('category')
            ->where('status', 'Ready')
            ->where('condition', '!=', 'Bad');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $query->orderBy($this->sortBy);

        return view('livewire.items', [
            'items' => $query->paginate($this->perPage),
            'categories' => Category::all()
        ]);
    }
}
