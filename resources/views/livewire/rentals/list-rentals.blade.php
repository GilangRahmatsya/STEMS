<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">My Rentals</h1>
            <p class="text-secondary dark:text-neutral-400 mt-2">Manage your equipment rentals</p>
        </div>
        <a
            href="{{ route('user.items.index') }}"
            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5"
        >
            Browse Items
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="p-4 rounded-lg bg-primary dark:bg-gray-800 border border-neutral-200 dark:border-gray-600 shadow-md">
            <p class="text-sm text-secondary dark:text-gray-400 mb-1">Active Rentals</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $activeCount ?? 0 }}</p>
        </div>
        <div class="p-4 rounded-lg bg-primary dark:bg-gray-800 border border-neutral-200 dark:border-gray-600 shadow-md">
            <p class="text-sm text-secondary dark:text-gray-400 mb-1">Pending Approval</p>
            <p class="text-2xl font-bold text-warning-600 dark:text-warning-400">{{ $pendingCount ?? 0 }}</p>
        </div>
        <div class="p-4 rounded-lg bg-primary dark:bg-gray-800 border border-neutral-200 dark:border-gray-600 shadow-md">
            <p class="text-sm text-secondary dark:text-gray-400 mb-1">Completed</p>
            <p class="text-2xl font-bold text-success-600 dark:text-success-400">{{ $completedCount ?? 0 }}</p>
        </div>
    </div>

    <!-- Search and Filter -->
    <x-table.search-filter
        wire:model.live.debounce-500="search"
        searchPlaceholder="Search rentals by item name..."
        hasFilters
    >
        <select
            wire:model.live="status"
            class="px-4 py-2.5 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
        >
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="picked_up">Picked Up</option>
            <option value="returned">Returned</option>
            <option value="rejected">Rejected</option>
        </select>
    </x-table.search-filter>

    <!-- Rentals Grid (Modernized Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($rentals as $rental)
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 shadow-sm hover:shadow-md transition-all duration-200 flex flex-col h-full group">
                <!-- Header: Item & Status -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                         <div class="h-10 w-10 shrink-0 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center border border-zinc-200 dark:border-zinc-700">
                             @if($rental->item->image)
                                <img src="{{ asset('storage/' . $rental->item->image) }}" class="h-full w-full object-cover rounded-lg" alt="{{ $rental->item->name }}">
                             @else
                                <svg class="h-5 w-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                             @endif
                        </div>
                        <div>
                            <h3 class="font-semibold text-zinc-900 dark:text-white line-clamp-1 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">
                                {{ $rental->item->name }}
                            </h3>
                             <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $rental->item->category->name }}</p>
                        </div>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium border
                        {{ $rental->status === 'pending' ? 'bg-yellow-50 text-yellow-700 border-yellow-200 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-900/50' : '' }}
                        {{ $rental->status === 'approved' ? 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-900/50' : '' }}
                        {{ $rental->status === 'picked_up' ? 'bg-indigo-50 text-indigo-700 border-indigo-200 dark:bg-indigo-900/20 dark:text-indigo-400 dark:border-indigo-900/50' : '' }}
                        {{ $rental->status === 'returned' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-900/50' : '' }}
                        {{ $rental->status === 'rejected' ? 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-400 dark:border-red-900/50' : '' }}
                    ">
                        {{ ucfirst(str_replace('_', ' ', $rental->status)) }}
                    </span>
                </div>

                <!-- Dates Grid -->
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-b border-zinc-100 dark:border-zinc-800/50 mb-4">
                    <div>
                        <p class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Tanggal Keluar</p>
                        <p class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mt-1">
                            {{ $rental->start_date->format('d M Y') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Return Due</p>
                        <p class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 mt-1">
                            {{ $rental->end_date->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <!-- Footer: Duration & Cost & Actions -->
                <div class="mt-auto flex items-center justify-between">
                    <div>
                         <p class="text-xs text-zinc-500">Total Cost ({{ $rental->getDurationInDays() }} days)</p>
                         <p class="text-base font-bold text-zinc-900 dark:text-white">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($rental->status === 'pending')
                             <button 
                                wire:click="cancel({{ $rental->id }})" 
                                wire:confirm="Cancel this rental request?"
                                class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                title="Cancel Request"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        @endif
                        
                        <a href="{{ route('user.rentals.show', $rental->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-zinc-200 dark:border-zinc-700 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 hover:bg-orange-50 hover:text-orange-700 hover:border-orange-200 dark:hover:bg-zinc-700 transition-colors">
                            Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
             <div class="col-span-full py-12 text-center rounded-xl bg-zinc-50 dark:bg-zinc-900/50 border border-dashed border-zinc-300 dark:border-zinc-700">
                <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">No rentals found</h3>
                <p class="mt-1 text-sm text-zinc-500">Get started by browsing our catalog.</p>
                <div class="mt-6">
                    <a href="{{ route('user.items.index') }}" class="inline-flex items-center px-6 py-2.5 border border-transparent shadow-md hover:shadow-lg text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all transform hover:-translate-y-0.5">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Browse Items
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <x-table.pagination :paginator="$rentals" />
    </div>
</div>
