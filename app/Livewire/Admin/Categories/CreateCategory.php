<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;

class CreateCategory extends Component
{
    public $name = '';
    public $description = '';
    public $isSubmitting = false;

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255', 'unique:categories'],
                'description' => ['nullable', 'string', 'max:500'],
            ]);

            Category::create([
                'name' => $this->name,
                'description' => $this->description ?? null,
            ]);

            session()->flash('success', 'Category created successfully!');
            $this->isSubmitting = false;

            return redirect()->route('admin.categories.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to create category: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.categories.create-category');
    }
}
