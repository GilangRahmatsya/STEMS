<div class="px-4 py-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-900 min-h-screen">
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Reports</h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Generate and view detailed reports.</p>
            </div>
            <span class="text-xs font-medium text-zinc-500 bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-300 px-3 py-1.5 rounded-full ring-1 ring-inset ring-zinc-200 dark:ring-zinc-700">
                Read-only view
            </span>
        </div>
    </div>

    <!-- Date Filters -->
    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 mb-8 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Start Date</label>
                <div class="relative">
                    <input type="date" wire:model.live="startDate" class="w-full pl-3 pr-10 py-2 text-sm border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 transition-shadow">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">End Date</label>
                <div class="relative">
                    <input type="date" wire:model.live="endDate" class="w-full pl-3 pr-10 py-2 text-sm border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white rounded-lg shadow-sm focus:ring-orange-500 focus:border-orange-500 transition-shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg border border-blue-100 dark:border-blue-800">
                    <flux:icon.clipboard-document-list class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Rentals</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $totalRentals }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg border border-emerald-100 dark:border-emerald-800">
                    <flux:icon.check-circle class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Approved</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $approvedRentals }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-lg border border-amber-100 dark:border-amber-800">
                    <flux:icon.clock class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Pending</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $pendingRentals }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-lg border border-purple-100 dark:border-purple-800">
                    <flux:icon.banknotes class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Revenue</span>
            </div>
            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 truncate">Rp {{ number_format($totalRevenue) }}</p>
        </div>
    </div>

    <!-- Recent Rentals and Popular Items -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Rentals -->
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 flex flex-col">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6">Recent Rentals</h3>
            <div class="flex-1 overflow-y-auto max-h-[400px] space-y-4">
                @forelse($rentals->take(10) as $rental)
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-700/50 bg-zinc-50 dark:bg-zinc-900/30">
                        <div class="min-w-0 flex-1 pr-4">
                            <p class="font-medium text-sm text-zinc-900 dark:text-white truncate">{{ $rental->item->name }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $rental->user->name }}</span>
                                <span class="text-zinc-300 dark:text-zinc-600">•</span>
                                <span class="text-xs text-zinc-500">{{ $rental->created_at->format('d M y') }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="block text-sm font-semibold text-zinc-900 dark:text-white">Rp {{ number_format($rental->total_price) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400 py-8">No rentals in this period.</p>
                @endforelse
            </div>
        </div>

        <!-- Most Popular Items -->
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 flex flex-col">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6">Most Popular Items</h3>
            <div class="flex-1 overflow-y-auto max-h-[400px] space-y-4">
                @forelse($popularItems as $item)
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-700/50 hover:bg-zinc-50 dark:hover:bg-zinc-900/30 transition-colors">
                        <div class="min-w-0 flex-1 pr-4">
                            <p class="font-medium text-sm text-zinc-900 dark:text-white truncate">{{ $item->name }}</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate mt-0.5">{{ $item->category?->name ?? 'Uncategorized' }}</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                                {{ $item->rentals_count }} rentals
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-sm text-zinc-500 dark:text-zinc-400 py-8">No data available.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>