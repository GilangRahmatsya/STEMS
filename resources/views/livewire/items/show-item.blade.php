<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-secondary dark:text-neutral-400">
        <a href="{{ route('user.items.index') }}" class="hover:text-primary dark:hover:text-white">Items</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span>{{ $item->name }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Item Image -->
            @if ($item->image)
                <div class="rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-800 shadow-md">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-full h-96 object-cover">
                </div>
            @else
                <div class="rounded-lg bg-secondary dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-800 h-96 flex items-center justify-center">
                    <svg class="w-24 h-24 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            <!-- Item Details -->
            <div class="p-6 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $item->name }}</h1>
                
                <div class="flex flex-wrap gap-3 mb-6">
                    @if ($item->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 dark:bg-primary-900/20 text-gray-900 dark:text-primary-300">
                            {{ $item->category->name }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">
                            Uncategorized
                        </span>
                    @endif
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ match($item->status) {
                        'Ready' => 'bg-success-100 dark:bg-success-900/20 text-success-700 dark:text-success-300',
                        'Maintenance' => 'bg-warning-100 dark:bg-warning-900/20 text-warning-700 dark:text-warning-300',
                        'Discontinued' => 'bg-danger-100 dark:bg-danger-900/20 text-danger-700 dark:text-danger-300',
                        default => 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300',
                    } }}">
                        {{ $item->status }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300">
                        Condition: {{ $item->condition }}
                    </span>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-primary dark:text-white mb-2">Description</h2>
                    <p class="text-secondary dark:text-neutral-400">{{ $item->description }}</p>
                </div>

                <!-- Specifications -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Daily Rate</p>
                        <p class="text-2xl font-bold text-primary dark:text-white">Rp {{ number_format($item->daily_rate, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-4 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Available</p>
                        <p class="text-2xl font-bold text-primary dark:text-white">{{ $item->quantity }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Add to Cart Button -->
            @if ($item->isAvailable())
                <button
                    wire:click="addToCart"
                    class="block w-full px-6 py-3 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold text-center transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
                >
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Add to Cart</span>
                    </div>
                </button>
            @else
                <div class="p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800 text-center">
                    <p class="text-sm font-medium text-danger-700 dark:text-danger-300">Not Available</p>
                </div>
            @endif

            <!-- Item Info Card -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md space-y-4">
                <h3 class="text-lg font-semibold text-primary dark:text-white">Item Information</h3>

                <div class="space-y-3 border-t border-neutral-200 dark:border-neutral-800 pt-4">
                    <!-- Owner section removed -->
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Category</p>
                        <p class="font-medium text-primary dark:text-white">{{ $item->category?->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Condition</p>
                        <p class="font-medium text-primary dark:text-white">{{ $item->condition }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Available Quantity</p>
                        <p class="font-medium text-primary dark:text-white">{{ $item->quantity }} unit(s)</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Daily Rate</p>
                        <p class="font-medium text-primary-600 dark:text-primary-400 text-lg">Rp {{ number_format($item->daily_rate, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @can('update', $item)
                <div class="space-y-2">
                    <a
                        href="{{ route('user.items.edit', $item->id) }}"
                        class="block w-full px-4 py-3 rounded-lg bg-white dark:bg-neutral-900 text-gray-900 dark:text-white border border-neutral-200 dark:border-neutral-800 shadow-md hover:shadow-lg hover:bg-neutral-50 dark:hover:bg-neutral-800 font-medium text-center transition-all"
                    >
                        Edit Item
                    </a>
                </div>
            @endcan
        </div>
    </div>
</div>
