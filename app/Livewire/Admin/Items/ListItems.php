<?php

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListItems extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $category = '';
    public $status = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;

    // Form Properties
    public $isEdit = false;
    public $itemId;
    public $name;
    public $category_id;
    public $condition;
    public $location;
    public $quantity = 1;
    public $rent_price;
    public $asset_value;
    public $image;
    public $description;
    public $currentImage; // For displaying current image during edit

    protected $queryString = ['search', 'category', 'status'];

    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:Excellent,Good,Fair,Bad',
            'location' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'rent_price' => 'required|numeric|min:0',
            'asset_value' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'description' => 'nullable|string',
        ];
    }

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

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('items', 'public');
        }

        Item::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'rent_price' => $this->rent_price,
            'buy_price' => $this->asset_value, // Mapped to buy_price based on context
            'description' => $this->description,
            'image' => $imagePath,
            'status' => 'Ready', // Default status
        ]);

        $this->resetForm();
        session()->flash('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->category_id = $item->category_id;
        $this->condition = $item->condition;
        $this->location = $item->location;
        $this->quantity = $item->quantity;
        $this->rent_price = $item->rent_price;
        $this->asset_value = $item->buy_price;
        $this->description = $item->description;
        $this->currentImage = $item->image;
        $this->isEdit = true;
        
        $this->resetValidation();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:Excellent,Good,Fair,Bad',
            'location' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'rent_price' => 'required|numeric|min:0',
            'asset_value' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        $item = Item::findOrFail($this->itemId);

        $imagePath = $item->image;
        if ($this->image) {
            // Delete old image if exists
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $imagePath = $this->image->store('items', 'public');
        }

        $item->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'rent_price' => $this->rent_price,
            'buy_price' => $this->asset_value,
            'description' => $this->description,
            'image' => $imagePath,
        ]);

        $this->resetForm();
        session()->flash('success', 'Item updated successfully.');
    }

    public function delete($id)
    {
        $item = Item::findOrFail($id);
        
        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();
        session()->flash('success', 'Item deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset(['name', 'category_id', 'condition', 'location', 'quantity', 'rent_price', 'asset_value', 'image', 'description', 'isEdit', 'itemId', 'currentImage']);
        $this->resetValidation();
    }

    public function render()
    {
        $items = Item::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('description', 'like', "%{$this->search}%"))
            ->when($this->category, fn($query) => $query->where('category_id', $this->category))
            ->when($this->status, fn($query) => $query->where('status', $this->status))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $categories = Category::all(); // Pass as collection for the view loop
        $conditions = ['Excellent', 'Good', 'Fair', 'Bad'];

        return view('livewire.admin.items', [
            'items' => $items,
            'categories' => $categories,
            'conditions' => $conditions,
        ]);
    }
}
