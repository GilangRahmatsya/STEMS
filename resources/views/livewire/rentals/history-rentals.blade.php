<div class="min-h-screen bg-gray-50 dark:bg-gradient-to-br dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Rental History</h1>
            <p class="text-gray-600 dark:text-gray-400">View your completed rental transactions</p>
        </div>

        <!-- Search and Filter Bar -->
        <div class="mb-6 bg-white dark:bg-gray-700/80 rounded-lg shadow p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        wire:model.live="search"
                        placeholder="Search by equipment name or rental ID..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-600 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:focus:ring-purple-500"
                    />
                </div>
            </div>
        </div>

        <!-- Rentals Table -->
        <div class="bg-white dark:bg-gray-700/80 rounded-lg shadow overflow-hidden">
            @if ($rentals->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700">
                                <th class="px-6 py-3 text-left">
                                    <button wire:click="sort('id')" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center gap-1">
                                        Rental ID
                                        @if($sortBy === 'id')
                                            <span class="text-xs">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Equipment</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <button wire:click="sort('start_date')" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center gap-1">
                                        Rental Period
                                        @if($sortBy === 'start_date')
                                            <span class="text-xs">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Total Cost</span>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <button wire:click="sort('returned_at')" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white flex items-center gap-1">
                                        Returned
                                        @if($sortBy === 'returned_at')
                                            <span class="text-xs">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                        @endif
                                    </button>
                                </th>
                                <th class="px-6 py-3 text-left">
                                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Payment</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach ($rentals as $rental)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">
                                            #{{ $rental->id }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($rental->item->image)
                                                <img src="{{ asset('storage/' . $rental->item->image) }}" alt="{{ $rental->item->name }}" class="w-10 h-10 rounded-lg object-cover mr-3">
                                            @else
                                                <div class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-600 mr-3 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rental->item->name }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $rental->item->category ?? 'Uncategorized' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $rental->start_date->format('M d, Y') }} - {{ $rental->end_date->format('M d, Y') }}
                                        <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                            {{ $rental->start_date->diffInDays($rental->end_date) + 1 }} days
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($rental->total_cost, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                        @if($rental->returned_at)
                                            {{ $rental->returned_at->format('M d, Y') }}
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($rental->payment_status === 'paid')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-400">
                                                ✓ Paid
                                            </span>
                                        @elseif($rental->payment_status === 'refunded')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400">
                                                ↺ Refunded
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-400">
                                                ⏳ Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                    {{ $rentals->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No rental history</h3>
                    <p class="mt-1 text-gray-600 dark:text-gray-400">You haven't completed any rentals yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
