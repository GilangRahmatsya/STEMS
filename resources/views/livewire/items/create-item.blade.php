<x-form.form title="{{ $this->formTitle }}" description="{{ $this->formDescription }}" submit="Create Item">
    <!-- Item Name -->
    <x-form.input
        name="name"
        label="Item Name"
        placeholder="Enter item name"
        wire:model="name"
        :error="$errors->first('name')"
        required
        helper="What is this item called?"
    />

    <!-- Description -->
    <x-form.textarea
        name="description"
        label="Description"
        placeholder="Describe the item in detail"
        wire:model="description"
        :error="$errors->first('description')"
        required
        helper="Provide details about the item's features and condition"
    />

    <!-- Category and Daily Rate Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Category -->
        <x-form.select
            name="category_id"
            label="Category"
            :options="$categories"
            wire:model="category_id"
            :error="$errors->first('category_id')"
            required
            placeholder="Select a category"
        />

        <!-- Daily Rate -->
        <x-form.input
            name="daily_rate"
            type="number"
            label="Daily Rate (Rp)"
            placeholder="0.00"
            step="0.01"
            min="0"
            wire:model="daily_rate"
            :error="$errors->first('daily_rate')"
            required
            helper="Price per day in Rupiah"
        />
    </div>

    <!-- Quantity and Condition Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Quantity -->
        <x-form.input
            name="quantity"
            type="number"
            label="Quantity"
            placeholder="0"
            min="1"
            wire:model="quantity"
            :error="$errors->first('quantity')"
            required
            helper="Number of units available"
        />

        <!-- Condition -->
        <x-form.select
            name="condition"
            label="Condition"
            :options="['Good' => 'Good', 'Fair' => 'Fair', 'Poor' => 'Poor']"
            wire:model="condition"
            :error="$errors->first('condition')"
            required
        />
    </div>

    <!-- Status -->
    <x-form.select
        name="status"
        label="Status"
        :options="['Ready' => 'Ready', 'Maintenance' => 'Maintenance', 'Discontinued' => 'Discontinued']"
        wire:model="status"
        :error="$errors->first('status')"
        required
        helper="Current availability status"
    />

    <!-- Image Upload -->
    <x-form.file-upload
        name="image_path"
        label="Item Image"
        accept="image/*"
        wire:model="image_path"
        :error="$errors->first('image_path')"
        preview
        helper="Upload a photo of the item"
    />

    <!-- Additional Options -->
    <div class="border-t border-neutral-200 dark:border-neutral-800 pt-6">
        <x-form.checkbox
            name="featured"
            label="Feature this item"
            helper="Make this item appear in featured recommendations"
        />
    </div>
</x-form.form>

@script
<script>
    $wire.on('submit', () => {
        $wire.submit();
    });
</script>
@endscript
