<?php

namespace App\Livewire\Items;

use App\Models\Category;
use App\Models\Item;
use App\Livewire\Forms\FormComponent;
use App\Livewire\Forms\Traits\HasFormValidation;
use Illuminate\Support\Facades\Auth;

class CreateItem extends FormComponent
{
    use HasFormValidation;

    public $name = '';
    public $description = '';
    public $category_id = '';
    public $daily_rate = '';
    public $quantity = '';
    public $condition = 'Good';
    public $status = 'Ready';
    public $image_path = null;
    public $categories = [];

    protected function initializeForm()
    {
        $this->formTitle = 'Create New Item';
        $this->formDescription = 'Add a new item to your rental catalog';
        $this->categories = Category::all()->pluck('name', 'id')->toArray();
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],
            'daily_rate' => ['required', 'numeric', 'min:0.01'],
            'quantity' => ['required', 'integer', 'min:1'],
            'condition' => ['required', 'in:Good,Fair,Poor'],
            'status' => ['required', 'in:Ready,Maintenance,Discontinued'],
            'image_path' => ['nullable', 'image', 'max:5120'],
        ];
    }

    protected function setupValidation(): void
    {
        $this->validationMessages = [
            'name.required' => 'Item name is required',
            'daily_rate.numeric' => 'Daily rate must be a valid number',
            'quantity.integer' => 'Quantity must be a whole number',
        ];

        $this->validationAttributes = [
            'daily_rate' => 'daily rate',
            'category_id' => 'category',
        ];
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $validated = $this->validateForm();

            if ($this->image_path) {
                $validated['image_path'] = $this->image_path->store('items', 'public');
            }

            Item::create([...$validated, 'user_id' => Auth::id()]);

            session()->flash('success', 'Item created successfully!');
            $this->isSubmitting = false;

            return redirect()->route('user.items.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.items.create-item', [
            'categories' => $this->categories,
        ]);
    }
}
