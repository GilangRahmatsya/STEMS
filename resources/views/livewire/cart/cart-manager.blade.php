<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Your Cart</h1>
        <a href="{{ route('user.items.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-500">
            Continue Browsing
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items List -->
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden shadow-sm">
                @forelse($cart->items as $cartItem)
                    <div class="p-4 flex items-center gap-4 border-b border-zinc-100 dark:border-zinc-800 last:border-0 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                        <!-- Image -->
                        <div class="h-20 w-20 shrink-0 rounded-lg bg-zinc-100 dark:bg-zinc-800 overflow-hidden border border-zinc-200 dark:border-zinc-700">
                            @if($cartItem->item->image)
                                <img src="{{ asset('storage/' . $cartItem->item->image) }}" class="h-full w-full object-cover">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-zinc-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-zinc-900 dark:text-white truncate">{{ $cartItem->item->name }}</h3>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $cartItem->item->category?->name ?? 'Gear' }}</p>
                            <p class="text-sm font-medium text-orange-600 dark:text-orange-400 mt-1">
                                Rp {{ number_format($cartItem->item->rent_price, 0, ',', '.') }} / day
                            </p>
                        </div>

                        <!-- Quantity (Just display for now, or could edit) -->
                        <div class="text-sm font-medium text-zinc-900 dark:text-white">
                            x{{ $cartItem->quantity }}
                        </div>

                        <!-- Remove -->
                        <button wire:click="removeItem({{ $cartItem->id }})" class="p-2 text-zinc-400 hover:text-red-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-zinc-100 dark:bg-zinc-800 text-zinc-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <h3 class="text-lg font-medium text-zinc-900 dark:text-white">Your cart is empty</h3>
                        <p class="mt-1 text-zinc-500 dark:text-zinc-400">Browse our items to start a rental request.</p>
                        <a href="{{ route('user.items.index') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                            Browse Items
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Checkout Sidebar -->
        @if($cart->items->isNotEmpty())
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm sticky top-6">
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white mb-4">Rental Details</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Start Date</label>
                            <input type="date" wire:model.live="start_date" class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                            @error('start_date') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">End Date</label>
                            <input type="date" wire:model.live="end_date" class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                            @error('end_date') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                         <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Purpose (Optional)</label>
                            <textarea wire:model="purpose" rows="2" class="w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-orange-500 focus:border-orange-500 sm:text-sm" placeholder="e.g. Photoshoot for client"></textarea>
                            @error('purpose') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-800">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-zinc-600 dark:text-zinc-400">Total Items</span>
                                <span class="font-medium text-zinc-900 dark:text-white">{{ $cart->items->sum('quantity') }}</span>
                            </div>
                             <div class="flex justify-between items-center mb-4">
                                <span class="text-zinc-600 dark:text-zinc-400">Estimated Total</span>
                                <span class="text-xl font-bold text-orange-600 dark:text-orange-400">Rp {{ number_format($estimatedTotal, 0, ',', '.') }}</span>
                            </div>

                            <button wire:click="checkout" wire:loading.attr="disabled" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span wire:loading.remove>Request Rental</span>
                                <span wire:loading>Processing...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
