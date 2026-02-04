<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{
    public $category;
    public $name = '';
    public $description = '';
    public $isSubmitting = false;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description ?? '';
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $this->category->id],
                'description' => ['nullable', 'string', 'max:500'],
            ]);

            $this->category->update([
                'name' => $this->name,
                'description' => $this->description ?? null,
            ]);

            session()->flash('success', 'Category updated successfully!');
            $this->isSubmitting = false;

            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update category: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.edit-category');
    }
}
