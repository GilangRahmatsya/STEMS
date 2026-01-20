<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Dashboard Admin – Kelola Alat</h1>
    </div>

    <!-- Add/Edit Form -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" enctype="multipart/form-data" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 mb-6 shadow-sm">
        <h2 class="text-base sm:text-lg font-semibold mb-4">{{ $isEdit ? 'Edit Item' : 'Add New Item' }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <!-- Name -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                <input wire:model="name" type="text" placeholder="Item name" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('name') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                <select wire:model="category_id" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->icon }} {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Condition -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Condition</label>
                <select wire:model="condition" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select Condition</option>
                    @foreach($conditions as $cond)
                        <option value="{{ $cond }}">{{ $cond }}</option>
                    @endforeach
                </select>
                @error('condition') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Location -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Location</label>
                <input wire:model="location" type="text" placeholder="Storage location" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('location') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity Available</label>
                <input wire:model="quantity" type="number" placeholder="1" min="1" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('quantity') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Rental Price -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Rental Price (per day)</label>
                <input wire:model="rent_price" type="number" placeholder="0" min="0" step="1000" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('rent_price') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Asset Value -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Asset Value</label>
                <input wire:model="asset_value" type="number" placeholder="0" min="0" step="1000" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('asset_value') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Image -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
                <input wire:model="image" type="file" accept="image/*" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('image') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Description -->
        <div class="mt-4 sm:mt-6">
            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
            <textarea wire:model="description" rows="3" placeholder="Item description" class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('description') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex flex-col sm:flex-row gap-2 sm:gap-3">
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white px-4 sm:px-6 py-2 rounded-md font-medium transition-colors text-sm sm:text-base flex items-center justify-center gap-2">
                <x-loading-spinner wire:loading size="sm" class="text-white" />
                <span wire:loading.remove>{{ $isEdit ? 'Update Item' : 'Add Item' }}</span>
                <span wire:loading>Processing...</span>
            </button>
            @if($isEdit)
                <button type="button" wire:click="resetForm" class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-4 sm:px-6 py-2 rounded-md font-medium transition-colors text-sm sm:text-base">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <!-- Items List Table -->
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden shadow-sm">
        <div class="px-4 sm:px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-base sm:text-lg font-semibold">Items List</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">Category</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Condition</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Location</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">Quantity</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Price</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($items as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-10 w-10 sm:h-12 sm:w-12 object-cover rounded">
                            @else
                                <div class="h-10 w-10 sm:h-12 sm:w-12 bg-gray-200 dark:bg-zinc-700 rounded flex items-center justify-center flex-shrink-0">
                                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-4 min-w-0">
                            <div class="text-xs sm:text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 truncate hidden sm:block">{{ Str::limit($item->description, 40) }}</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            @if($item->category)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $item->category->icon }} <span class="hidden sm:inline">{{ $item->category->name }}</span>
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                {{ $item->condition === 'Excellent' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                                {{ $item->condition === 'Good' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                                {{ $item->condition === 'Bad' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                                {{ $item->condition }}
                            </span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm hidden lg:table-cell text-gray-900 dark:text-white truncate max-w-xs">
                            {{ $item->location ?: '—' }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm hidden xl:table-cell text-gray-900 dark:text-white">
                            {{ $item->quantity }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900 dark:text-white">
                            <span class="hidden sm:inline">Rp {{ number_format($item->rent_price) }}</span>
                            <span class="sm:hidden">{{ number_format($item->rent_price / 1000) }}k</span>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium">
                            <div class="flex gap-2">
                                <button wire:click="edit({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                    Edit
                                </button>
                                <flux:button
                                    wire:click="delete({{ $item->id }})"
                                    variant="danger"
                                    size="sm"
                                    wire:confirm="Are you sure you want to delete '{{ $item->name }}'? This action cannot be undone."
                                >
                                    Delete
                                </flux:button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 sm:px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            No items found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
            <div class="mt-4">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
