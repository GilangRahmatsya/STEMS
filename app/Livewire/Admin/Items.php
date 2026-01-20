<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Item;

class Items extends Component
{
    use WithFileUploads, WithPagination;

    public bool $editMode = false;

    public $item_id;
    public $name, $description, $category_id, $condition, $location, $quantity;
    public $rent_price, $asset_value, $image;
    public $isEdit = false;

    public $perPage = 15;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
        'condition' => 'required|in:Excellent,Good,Bad',
        'location' => 'nullable|string|max:255',
        'quantity' => 'required|integer|min:1',
        'rent_price' => 'required|numeric|min:0',
        'asset_value' => 'nullable|numeric|min:0',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        // Remove loadItems call
    }

    public function toggleEdit()
    {
        $this->editMode = ! $this->editMode;
    }

    public function getItemsProperty()
    {
        return Item::with('category')->latest()->paginate($this->perPage);
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->image
            ? $this->image->store('items', 'public')
            : null;

        Item::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'rent_price' => $this->rent_price,
            'asset_value' => $this->asset_value,
            'image' => $imagePath,
        ]);

        $this->resetForm();
        $this->loadItems();
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        $this->item_id = $item->id;
        $this->name = $item->name;
        $this->description = $item->description;
        $this->category_id = $item->category_id;
        $this->condition = $item->condition;
        $this->location = $item->location;
        $this->quantity = $item->quantity;
        $this->rent_price = $item->rent_price;
        $this->asset_value = $item->asset_value;

        $this->isEdit = true;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();

        $item = Item::findOrFail($this->item_id);

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'condition' => $this->condition,
            'location' => $this->location,
            'quantity' => $this->quantity,
            'rent_price' => $this->rent_price,
            'asset_value' => $this->asset_value,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('items', 'public');
        }

        $item->update($data);

        $this->resetForm();
        $this->loadItems();
    }

    public function delete($id)
    {
        $item = Item::find($id);
        if ($item) {
            // Check if item has active rentals
            $activeRentals = $item->rentals()->where('status', 'approved')->whereNull('returned_at')->count();

            if ($activeRentals > 0) {
                session()->flash('error', 'Cannot delete item with active rentals. Please return all rentals first.');
                return;
            }

            $item->delete();
            session()->flash('message', 'Item deleted successfully.');
        }

        $this->loadItems();
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'category_id',
            'condition',
            'location',
            'quantity',
            'rent_price',
            'asset_value',
            'image',
            'item_id',
            'isEdit',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.items', [
            'items' => $this->items,
            'categories' => \App\Models\Category::all(),
            'conditions' => ['Excellent', 'Good', 'Bad']
        ]);
    }
}
