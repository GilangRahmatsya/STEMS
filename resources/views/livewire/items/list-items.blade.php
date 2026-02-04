<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Browse Items</h1>
            <p class="text-zinc-600 dark:text-zinc-400 mt-2">Explore our premium collection of equipment.</p>
        </div>
        <a
            href="{{ auth()->user()->can('viewAdmin', \App\Models\Item::class) ? route('admin.items.index') : route('user.items.create') }}"
            class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white border border-transparent rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5"
        >
            Add New Item
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl p-4 md:p-6 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-1">
                 <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Category</label>
                 <select
                    wire:model.live="category"
                    class="w-full text-sm border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                >
                    <option value="">All Categories</option>
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
             <div class="md:col-span-2">
                 <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Search</label>
                 <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <flux:icon.magnifying-glass class="h-4 w-4 text-zinc-400" />
                    </div>
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search items by name, description..."
                        class="w-full pl-10 text-sm border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500"
                    />
                </div>
            </div>
        </div>
    </div>

    <!-- Items Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($items as $item)
            <div class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col h-full">
                <!-- Image Container -->
                <div class="aspect-w-16 aspect-h-10 bg-zinc-100 dark:bg-zinc-800 relative overflow-hidden">
                    @if ($item->image)
                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->name }}"
                            class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-300 dark:text-zinc-600">
                             <flux:icon.photo class="w-12 h-12" />
                        </div>
                    @endif
                    
                    <!-- Floating Badge -->
                    <div class="absolute top-3 right-3">
                         <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-white/90 dark:bg-zinc-900/90 backdrop-blur-sm border border-zinc-200 dark:border-zinc-700 shadow-sm
                            {{ $item->quantity == 0 ? 'text-rose-600 dark:text-rose-400' : 'text-zinc-700 dark:text-zinc-300' }}">
                            {{ $item->quantity > 0 ? $item->quantity . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-start gap-4 mb-2">
                        <div>
                            <p class="text-xs font-bold text-orange-600 dark:text-orange-400 uppercase tracking-widest">{{ $item->category?->name ?? 'Gear' }}</p>
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors line-clamp-1">
                                <a href="{{ route('user.items.show', $item->id) }}">
                                    {{ $item->name }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    
                    <div class="mt-auto pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                        <div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400">Daily Rate</p>
                            <p class="text-lg font-bold text-zinc-900 dark:text-white">Rp {{ number_format($item->rent_price, 0, ',', '.') }}</p>
                    </div>
                         <div class="flex gap-2">
                             <button
                                wire:click="addToCart({{ $item->id }})"
                                class="inline-flex items-center justify-center p-2 rounded-lg text-orange-600 bg-orange-50 hover:bg-orange-100 dark:bg-orange-900/20 dark:hover:bg-orange-900/40 transition-all duration-300 shadow-sm"
                                title="Add to Cart"
                            >
                                <flux:icon.plus class="w-5 h-5" />
                            </button>
                             <a
                                href="{{ route('user.items.show', $item->id) }}"
                                class="inline-flex items-center justify-center p-2 rounded-lg text-zinc-400 hover:text-white hover:bg-gradient-to-r hover:from-orange-500 hover:to-orange-600 transition-all duration-300 shadow-sm hover:shadow-md"
                            >
                                <flux:icon.arrow-right class="w-5 h-5" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center rounded-xl bg-zinc-50 dark:bg-zinc-800/50 border border-dashed border-zinc-300 dark:border-zinc-700">
                <flux:icon.magnifying-glass class="mx-auto h-12 w-12 text-zinc-300 dark:text-zinc-600" />
                <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">No items found</h3>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Try adjusting your search or category filter.</p>
                <div class="mt-6">
                    <button wire:click="$set('search', '')" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">
                        Clear Filters
                    </button>
                    <span class="text-zinc-300 mx-2">|</span>
                    <a href="{{ route('user.items.create') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400">
                        Add New Item
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $items->links() }} 
        {{-- Falling back to standard links() if x-table.pagination components are incompatible with new design --}}
    </div>
</div>
