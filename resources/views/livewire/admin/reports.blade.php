<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Reports</h1>

    <div class="mb-6 flex space-x-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="date" wire:model.live="startDate" class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <input type="date" wire:model.live="endDate" class="mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200">Total Rentals</h3>
            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalRentals }}</p>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">Approved Rentals</h3>
            <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $approvedRentals }}</p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200">Pending Rentals</h3>
            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pendingRentals }}</p>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
            <h3 class="text-lg font-semibold text-purple-800 dark:text-purple-200">Total Revenue</h3>
            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">Rp {{ number_format($totalRevenue) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-4">Recent Rentals</h3>
            <div class="space-y-2">
                @forelse($rentals->take(10) as $rental)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="font-medium">{{ $rental->item->name }}</p>
                            <p class="text-sm text-gray-500">{{ $rental->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium">Rp {{ number_format($rental->total_price) }}</p>
                            <p class="text-xs text-gray-500">{{ $rental->created_at->format('d M') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No rentals in this period.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4">
            <h3 class="text-lg font-semibold mb-4">Most Popular Items</h3>
            <div class="space-y-2">
                @forelse($popularItems as $item)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <p class="font-medium">{{ $item->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->category?->name ?? 'No Category' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium">{{ $item->rentals_count }} rentals</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No data available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>