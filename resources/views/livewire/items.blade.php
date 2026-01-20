<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Available Items</h1>

    {{-- Filters --}}
    <div class="mb-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Search --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Search items..."
                       class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Category Filter --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                <select wire:model.live="selectedCategory"
                        class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Sort By --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                <select wire:model.live="sortBy"
                        class="w-full border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="name">Name</option>
                    <option value="rent_price">Price (Low to High)</option>
                    <option value="created_at">Newest</option>
                </select>
            </div>

            {{-- Clear Filters --}}
            <div class="flex items-end">
                <button wire:click="$set('selectedCategory', ''); $set('search', ''); $set('sortBy', 'name')"
                        class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                    Clear Filters
                </button>
            </div>
        </div>
    </div>

    {{-- Items Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($items as $item)
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                {{-- Image --}}
                <div class="relative h-48 bg-gray-200 dark:bg-zinc-700">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Category Badge --}}
                    @if($item->category)
                        <div class="absolute top-2 left-2 bg-white/90 dark:bg-zinc-800/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                            <span>{{ $item->category->icon }}</span>
                            <span>{{ $item->category->name }}</span>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-4">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-2">{{ $item->name }}</h3>

                    {{-- Badges --}}
                    <div class="flex items-center gap-2 mb-3">
                        {{-- Condition Badge --}}
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $item->condition === 'Excellent' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : '' }}
                            {{ $item->condition === 'Good' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : '' }}
                            {{ $item->condition === 'Bad' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' : '' }}">
                            {{ $item->condition }}
                        </span>

                        {{-- Status Badge --}}
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            Ready to Rent
                        </span>
                    </div>

                    {{-- Description --}}
                    @if($item->description)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                            {{ Str::limit($item->description, 100) }}
                        </p>
                    @endif

                    {{-- Price and Action --}}
                    <div class="flex items-center justify-between">
                        <div class="font-bold text-indigo-600 dark:text-indigo-400">
                            Rp {{ number_format($item->rent_price) }}/day
                        </div>
                        <a href="{{ route('user.rentals.create', $item->id) }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Rent Now
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-5.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No items found</h3>
                <p class="text-gray-500 dark:text-gray-400">Try adjusting your filters or search terms.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($items->hasPages())
            <div class="mt-8">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
