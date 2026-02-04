<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategories extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteCategory($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);

            if ($category->items()->count() > 0) {
                session()->flash('error', 'Cannot delete category with items.');
                return;
            }

            $category->delete();
            session()->flash('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->withCount('items')
            ->paginate($this->perPage);

        return view('livewire.admin.categories.list-categories', [
            'categories' => $categories,
        ]);
    }
}
