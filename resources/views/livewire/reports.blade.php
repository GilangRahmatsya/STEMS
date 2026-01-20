<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Reports</h1>
            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full">Read-only view</span>
        </div>
    </div>

    <!-- Date Filters -->
    <div class="mb-6 flex flex-col sm:flex-row gap-3 sm:gap-4">
        <div class="flex-1">
            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
            <input type="date" wire:model.live="startDate" class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="flex-1">
            <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
            <input type="date" wire:model.live="endDate" class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 mb-6">
        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-blue-800 dark:text-blue-200 uppercase tracking-wider">Total Rentals</h3>
            <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalRentals }}</p>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-green-800 dark:text-green-200 uppercase tracking-wider">Approved Rentals</h3>
            <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $approvedRentals }}</p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-yellow-800 dark:text-yellow-200 uppercase tracking-wider">Pending Rentals</h3>
            <p class="text-xl sm:text-2xl lg:text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">{{ $pendingRentals }}</p>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-purple-800 dark:text-purple-200 uppercase tracking-wider">Total Revenue</h3>
            <p class="text-lg sm:text-2xl lg:text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2 truncate">Rp {{ number_format($totalRevenue) }}</p>
        </div>
    </div>

    <!-- Recent Rentals and Popular Items -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
        <!-- Recent Rentals -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm overflow-hidden">
            <h3 class="text-base sm:text-lg font-semibold mb-4">Recent Rentals</h3>
            <div class="space-y-2 overflow-y-auto max-h-96">
                @forelse($rentals->take(10) as $rental)
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-3 border-b border-gray-200 dark:border-gray-700 gap-2">
                        <div class="min-w-0 flex-1">
                            <p class="font-medium text-sm sm:text-base text-gray-900 dark:text-white truncate">{{ $rental->item->name }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $rental->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-white">Rp {{ number_format($rental->total_price) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $rental->created_at->format('d M') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 py-4">No rentals in this period.</p>
                @endforelse
            </div>
        </div>

        <!-- Most Popular Items -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm overflow-hidden">
            <h3 class="text-base sm:text-lg font-semibold mb-4">Most Popular Items</h3>
            <div class="space-y-2 overflow-y-auto max-h-96">
                @forelse($popularItems as $item)
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-3 border-b border-gray-200 dark:border-gray-700 gap-2">
                        <div class="min-w-0 flex-1">
                            <p class="font-medium text-sm sm:text-base text-gray-900 dark:text-white truncate">{{ $item->name }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $item->category?->name ?? 'No Category' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs sm:text-sm font-medium text-gray-900 dark:text-white">{{ $item->rentals_count }} rentals</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 py-4">No data available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>