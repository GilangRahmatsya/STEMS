<div class="space-y-8">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary dark:text-white">Edit Item</h1>
        <p class="text-secondary dark:text-neutral-400 mt-2">Update the details of this item</p>
    </div>

    <!-- Form -->
    <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
        <form wire:submit="submit" class="space-y-6">
            @csrf

            <!-- Item Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                    Item Name <span class="text-danger-600 dark:text-danger-400">*</span>
                </label>
                <input
                    id="name"
                    type="text"
                    wire:model="name"
                    placeholder="Enter item name"
                    class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('name') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                />
                @error('name')
                    <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                    Description <span class="text-danger-600 dark:text-danger-400">*</span>
                </label>
                <textarea
                    id="description"
                    wire:model="description"
                    placeholder="Describe the item in detail"
                    rows="4"
                    class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('description') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200 resize-vertical"
                ></textarea>
                @error('description')
                    <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category and Daily Rate Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Category <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <select
                        id="category_id"
                        wire:model="category_id"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('category_id') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                    >
                        <option value="">Select a category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Daily Rate -->
                <div>
                    <label for="daily_rate" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Daily Rate (Rp) <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <input
                        id="daily_rate"
                        type="number"
                        step="0.01"
                        min="0"
                        wire:model="daily_rate"
                        placeholder="0.00"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('daily_rate') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                    />
                    @error('daily_rate')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Quantity and Condition Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Quantity <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <input
                        id="quantity"
                        type="number"
                        min="0"
                        wire:model="quantity"
                        placeholder="0"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('quantity') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                    />
                    @error('quantity')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Condition -->
                <div>
                    <label for="condition" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Condition <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <select
                        id="condition"
                        wire:model="condition"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('condition') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                    >
                        <option value="Good">Good</option>
                        <option value="Fair">Fair</option>
                        <option value="Poor">Poor</option>
                    </select>
                    @error('condition')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                    Status <span class="text-danger-600 dark:text-danger-400">*</span>
                </label>
                <select
                    id="status"
                    wire:model="status"
                    class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('status') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                >
                    <option value="Ready">Ready</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Discontinued">Discontinued</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image -->
            @if ($item->image_path)
                <div>
                    <label class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">Current Image</label>
                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="w-40 h-40 rounded-lg object-cover border border-neutral-200 dark:border-neutral-700">
                </div>
            @endif

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                    Update Image (Optional)
                </label>
                <div
                    @drop="handleDrop"
                    @dragover="isDragging = true"
                    @dragleave="isDragging = false"
                    :class="{ 'border-primary-500 bg-primary-50 dark:bg-primary-900/10': isDragging }"
                    class="border-2 border-dashed border-neutral-300 dark:border-neutral-700 rounded-lg p-6 text-center cursor-pointer transition-all duration-200 hover:border-primary-500 dark:hover:border-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10"
                >
                    <input
                        type="file"
                        id="image"
                        wire:model="image"
                        accept="image/*"
                        class="hidden"
                    />

                    <label for="image" class="cursor-pointer block">
                        <svg class="w-12 h-12 mx-auto text-neutral-400 dark:text-neutral-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm font-medium text-neutral-900 dark:text-white">
                            Drop image here or <span class="text-primary-600 dark:text-primary-400">click to browse</span>
                        </p>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">PNG, JPG, GIF up to 5MB</p>
                    </label>
                </div>

                @if ($image)
                    <div class="mt-4">
                        <p class="text-sm font-medium text-neutral-900 dark:text-white mb-2">Preview</p>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-40 h-40 rounded-lg object-cover border border-neutral-200 dark:border-neutral-700">
                    </div>
                @endif

                @error('image')
                    <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
                >
                    <span wire:loading.remove>Update Item</span>
                    <span wire:loading class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Updating...
                    </span>
                </button>

                <a
                    href="{{ route('user.items.index') }}"
                    class="px-6 py-2.5 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-700 font-semibold transition-all duration-200 text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
