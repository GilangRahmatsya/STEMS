<div class="min-h-screen bg-gray-50 dark:bg-gradient-to-br dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Featured Items</h1>
            <p class="text-gray-600 dark:text-gray-400">Recently added equipment ready for rental</p>
        </div>

        <!-- Search and Filter Bar -->
        <div class="mb-6 bg-white dark:bg-gray-700/80 rounded-lg shadow p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        wire:model.live="search"
                        placeholder="Search equipment..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-purple-500"
                    />
                </div>
                <select 
                    wire:model.live="category"
                    class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-600 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-purple-500"
                >
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Items Grid -->
        @if ($items->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($items as $item)
                    <div class="bg-white dark:bg-gray-700/80 rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                        <!-- Item Image -->
                        <div class="relative h-48 bg-white dark:bg-gray-700 overflow-hidden rounded-t-lg">
                            @if($item->image_path)
                                <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Item Info -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">{{ $item->description }}</p>
                            
                            <!-- Category Badge -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400">
                                    {{ $item->category ?? 'Uncategorized' }}
                                </span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $item->quantity > 0 ? '✓ Available' : '✗ Out' }}
                                </span>
                            </div>

                            <!-- Price and Action -->
                            <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-600">
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Rental Price</p>
                                    <p class="text-lg font-bold text-orange-600 dark:text-purple-400">
                                        Rp {{ number_format($item->rent_price, 0, ',', '.') }}<span class="text-xs text-gray-500 dark:text-gray-400">/day</span>
                                    </p>
                                </div>
                                @if($item->isAvailable())
                                    <a href="{{ route('user.rentals.create', $item->id) }}" class="px-4 py-3 rounded-lg bg-orange-500 dark:bg-purple-600 text-white font-medium hover:bg-orange-600 dark:hover:bg-purple-700 border border-orange-600 dark:border-purple-700 shadow-md hover:shadow-lg transition-all">
                                        Rent
                                    </a>
                                @else
                                    <button disabled class="px-4 py-3 rounded-lg bg-gray-300 dark:bg-gray-600 text-gray-500 dark:text-gray-400 font-medium cursor-not-allowed border border-gray-400 dark:border-gray-700 shadow-md">
                                        Unavailable
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $items->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-700/80 rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.5 8.5h15m0 0a2 2 0 01-2 2h-11a2 2 0 01-2-2m0 0V6a2 2 0 012-2h11a2 2 0 012 2v2.5m0 0L19 6m-7 14h.01M12 18a6 6 0 100-12 6 6 0 000 12z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No items found</h3>
                <p class="text-gray-600 dark:text-gray-400">Try adjusting your search or filters</p>
            </div>
        @endif
    </div>
</div>
