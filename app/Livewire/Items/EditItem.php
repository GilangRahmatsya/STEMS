<?php

namespace App\Livewire\Items;

use App\Models\Item;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditItem extends Component
{
    use WithFileUploads;

    public $item;
    public $name = '';
    public $description = '';
    public $category_id = '';
    public $daily_rate = '';
    public $quantity = '';
    public $condition = 'Good';
    public $status = 'Ready';
    public $image = null;
    public $categories = [];
    public $isSubmitting = false;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'min:10', 'max:1000'],
        'category_id' => ['required', 'exists:categories,id'],
        'daily_rate' => ['required', 'numeric', 'min:0.01'],
        'quantity' => ['required', 'integer', 'min:0'],
        'condition' => ['required', 'in:Good,Fair,Poor'],
        'status' => ['required', 'in:Ready,Maintenance,Discontinued'],
        'image' => ['nullable', 'image', 'max:5120'],
    ];

    protected $messages = [
        'name.required' => 'Item name is required.',
        'daily_rate.numeric' => 'Daily rate must be a valid number.',
        'quantity.integer' => 'Quantity must be a whole number.',
    ];

    public function mount(Item $item)
    {
        // Check authorization
        $this->authorize('update', $item);

        $this->item = $item;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->category_id = $item->category_id;
        $this->daily_rate = $item->daily_rate;
        $this->quantity = $item->quantity;
        $this->condition = $item->condition;
        $this->status = $item->status;
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $validated = $this->validate();

            // Handle image upload
            if ($this->image) {
                // Delete old image if exists
                if ($this->item->image_path) {
                    Storage::disk('public')->delete($this->item->image_path);
                }
                $validated['image_path'] = $this->image->store('items', 'public');
            }

            $this->item->update($validated);

            session()->flash('success', 'Item updated successfully!');
            $this->isSubmitting = false;

            return redirect()->route('user.items.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update item: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Item update error', [
                'error' => $e->getMessage(),
                'item_id' => $this->item->id,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.items.edit-item', [
            'categories' => $this->categories,
        ]);
    }
}
