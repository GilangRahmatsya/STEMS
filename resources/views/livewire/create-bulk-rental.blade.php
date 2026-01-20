<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Create Bulk Rental</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Select multiple items and quantities for your rental</p>
    </div>

    <form wire:submit="submit" class="space-y-6">
        <!-- Date Selection -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Rental Period</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                    <input type="date" wire:model="start_date" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                    <input type="date" wire:model="end_date" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Item Selection -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Select Items</h2>

            <!-- Available Items -->
            <div class="mb-6">
                <h3 class="text-md font-medium mb-3">Available Items</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($availableItems as $item)
                    <div class="border border-gray-200 dark:border-zinc-700 rounded-lg p-4 hover:border-indigo-300 dark:hover:border-indigo-600 transition-colors">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-12 w-12 object-cover rounded">
                                @else
                                    <div class="h-12 w-12 bg-gray-200 dark:bg-zinc-700 rounded flex items-center justify-center">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->category->name ?? 'No category' }}</p>
                                <p class="text-xs text-green-600 dark:text-green-400">Available: {{ $item->quantity }}</p>
                                <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400">Rp {{ number_format($item->rent_price) }}/day</p>
                            </div>
                        </div>
                        <div class="mt-3">
                            @if(in_array($item->id, $selectedItems))
                                <button type="button" wire:click="removeItem({{ $item->id }})"
                                        class="w-full bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-2 rounded-md transition-colors">
                                    Remove from Cart
                                </button>
                            @else
                                <button type="button" wire:click="addItem({{ $item->id }})"
                                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-3 py-2 rounded-md transition-colors">
                                    Add to Cart
                                </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Selected Items -->
            @if($selectedItemsData->count() > 0)
            <div>
                <h3 class="text-md font-medium mb-3">Selected Items ({{ $selectedItemsData->count() }})</h3>
                <div class="space-y-3">
                    @foreach($selectedItemsData as $item)
                    <div class="flex items-center justify-between bg-gray-50 dark:bg-zinc-800 p-3 rounded-lg">
                        <div class="flex items-center space-x-3">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-10 w-10 object-cover rounded">
                            @else
                                <div class="h-10 w-10 bg-gray-200 dark:bg-zinc-700 rounded flex items-center justify-center">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->name }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rp {{ number_format($item->rent_price) }}/day</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-600 dark:text-gray-400">Qty:</label>
                                <input type="number"
                                       wire:model="itemQuantities.{{ $item->id }}"
                                       wire:change="updateQuantity({{ $item->id }}, $event.target.value)"
                                       min="1"
                                       max="{{ $item->quantity }}"
                                       class="w-16 text-center border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white rounded text-sm">
                            </div>
                            <button type="button" wire:click="removeItem({{ $item->id }})"
                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('selectedItems') <span class="text-red-500 text-sm block mt-2">{{ $message }}</span> @enderror
            </div>
            @endif
        </div>

        <!-- Borrower Information -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Borrower Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                    <input type="text" wire:model="borrower_name" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your full name">
                    @error('borrower_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date of Birth</label>
                    <input type="date" wire:model="borrower_birth_date" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('borrower_birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Purpose of Rental</label>
                <textarea wire:model="purpose" rows="3" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Please describe the purpose of renting these items"></textarea>
                @error('purpose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes (Optional)</label>
                <textarea wire:model="notes" rows="2" class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Additional notes"></textarea>
                @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded border border-yellow-200 dark:border-yellow-800">
                <h4 class="font-medium text-yellow-800 dark:text-yellow-200 mb-2">KTP Requirements</h4>
                <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-2">
                    KTP is required as collateral for the rental. Please attach a photocopy or photo of your KTP when picking up the items.
                </p>
                <textarea wire:model="ktp_notes" rows="2" class="w-full border-yellow-300 dark:border-yellow-600 dark:bg-zinc-800 dark:text-white rounded text-sm" placeholder="KTP details or notes"></textarea>
            </div>
        </div>

        <!-- Summary and Submit -->
        @if($selectedItemsData->count() > 0 && $start_date && $end_date)
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Rental Summary</h2>

            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Items:</span>
                    <span class="font-medium">{{ $selectedItemsData->count() }} item(s)</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Duration:</span>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date)) + 1 }} days</span>
                </div>
                <div class="flex justify-between text-lg font-bold border-t border-gray-200 dark:border-zinc-700 pt-2">
                    <span>Total Price:</span>
                    <span class="text-indigo-600 dark:text-indigo-400">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                </div>
            </div>

            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white font-medium py-3 px-4 rounded-md transition-colors flex items-center justify-center gap-2">
                <x-loading-spinner wire:loading size="sm" class="text-white" />
                <span wire:loading.remove>Submit Rental Request</span>
                <span wire:loading>Submitting...</span>
            </button>
        </div>
        @endif
    </form>
</div>