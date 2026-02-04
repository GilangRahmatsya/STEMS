<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateItem extends Component
{
    use WithFileUploads;

    public $user_id = '';
    public $name = '';
    public $description = '';
    public $category_id = '';
    public $daily_rate = '';
    public $quantity = '';
    public $condition = 'Good';
    public $status = 'Ready';
    public $image = null;
    public $categories = [];
    public $users = [];
    public $isSubmitting = false;

    public function mount()
    {
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
        $this->users = User::all()->pluck('name', 'id')->toArray();
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $validated = $this->validate([
                'user_id' => ['required', 'exists:users,id'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'min:10', 'max:1000'],
                'category_id' => ['required', 'exists:categories,id'],
                'daily_rate' => ['required', 'numeric', 'min:0.01'],
                'quantity' => ['required', 'integer', 'min:1'],
                'condition' => ['required', 'in:Good,Fair,Poor'],
                'status' => ['required', 'in:Ready,Maintenance,Discontinued'],
                'image' => ['nullable', 'image', 'max:5120'],
            ]);

            if ($this->image) {
                $validated['image_path'] = $this->image->store('items', 'public');
            }

            Item::create($validated);

            session()->flash('success', 'Item created successfully!');
            $this->isSubmitting = false;

            return redirect()->route('admin.items.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.items.create-item', [
            'categories' => $this->categories,
            'users' => $this->users,
        ]);
    }
}