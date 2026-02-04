<div class="space-y-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            @if(auth()->user()->role === 'admin')
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                    Admin Dashboard 🎛️
                </h1>
                <p class="text-gray-700 dark:text-gray-400 mt-2">
                    System overview and management
                </p>
            @else
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                    Welcome back, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-gray-700 dark:text-gray-400 mt-2">
                    Here's what's happening with your rentals today
                </p>
            @endif
        </div>
        @if(auth()->user()->role !== 'admin')
            <a
                href="{{ route('user.items.index') }}"
                class="px-6 py-3 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 dark:from-purple-600 dark:to-indigo-600 text-white font-semibold hover:from-orange-600 hover:to-red-600 dark:hover:from-purple-700 dark:hover:to-indigo-700 transition-all duration-200 shadow-md hover:shadow-lg"
            >
                Browse Items
            </a>
        @endif
    </div>

    <!-- Statistics Cards -->
    @if(auth()->user()->role === 'admin')
        <!-- Admin Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
            <!-- Total Rentals Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Total Rentals</h3>
                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userStats['totalRentals'] ?? 0 }}</p>
            </div>

            <!-- Active Rentals Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Active</h3>
                    <div class="w-10 h-10 rounded-lg bg-orange-100 dark:bg-orange-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userStats['activeRentals'] ?? 0 }}</p>
            </div>

            <!-- Completed Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Completed</h3>
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userStats['completedRentals'] ?? 0 }}</p>
            </div>

            <!-- Revenue Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Revenue</h3>
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($userStats['totalRevenue'] ?? 0, 0, ',', '.') }}</p>
            </div>

            <!-- Users Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Users</h3>
                    <div class="w-10 h-10 rounded-lg bg-purple-100 dark:bg-purple-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a9 9 0 0118 0v2h2v-2a11 11 0 00-20 0v2h2v-2z" /></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userStats['totalUsers'] ?? 0 }}</p>
            </div>

            <!-- Equipment Card -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Equipment</h3>
                    <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $userStats['totalEquipment'] ?? 0 }}</p>
            </div>
        </div>
    @else
        <!-- User Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Rentals Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Total Rentals</h3>
                <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900-600 dark:text-gray-900-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                {{ $userStats['totalRentals'] ?? 0 }}
            </p>
            <p class="text-xs text-gray-700 dark:text-gray-500 mt-2">
                All time
            </p>
        </div>

        <!-- Active Rentals Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Active Rentals</h3>
                <div class="w-10 h-10 rounded-lg bg-secondary-100 dark:bg-secondary-900/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                {{ $userStats['activeRentals'] ?? 0 }}
            </p>
            <p class="text-xs text-gray-700 dark:text-gray-500 mt-2">
                In progress
            </p>
        </div>

        <!-- Completed Rentals Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Completed</h3>
                <div class="w-10 h-10 rounded-lg bg-success-100 dark:bg-success-900/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                {{ $userStats['completedRentals'] ?? 0 }}
            </p>
            <p class="text-xs text-gray-700 dark:text-gray-500 mt-2">
                Successfully returned
            </p>
        </div>

        <!-- Total Spent Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-400">Total Spent</h3>
                <div class="w-10 h-10 rounded-lg bg-warning-100 dark:bg-warning-900/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-warning-600 dark:text-warning-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">
                Rp {{ number_format($userStats['totalSpent'] ?? 0, 0, ',', '.') }}
            </p>
            <p class="text-xs text-gray-700 dark:text-gray-500 mt-2">
                Paid rentals
            </p>
        </div>
        </div>
    @endif

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Recent Rentals and Chart -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Recent Rentals -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        @if(auth()->user()->role === 'admin') All Recent Rentals @else Recent Rentals @endif
                    </h2>
                    <a href="@if(auth()->user()->role === 'admin'){{ route('admin.rentals.index') }}@else{{ route('user.rentals.index') }}@endif" class="text-sm text-gray-900-600 dark:text-gray-900-400 hover:text-gray-900-700 dark:hover:text-gray-900-300 font-medium">
                        View All →
                    </a>
                </div>

                @if(count($recentRentals) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="border-b border-neutral-200 dark:border-gray-600">
                                <tr>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-400">Item</th>
                                    @if(auth()->user()->role === 'admin')<th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-400">Customer</th>@endif
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-400">Status</th>
                                    <th class="text-left py-3 px-4 font-semibold text-gray-700 dark:text-gray-400">Duration</th>
                                    <th class="text-right py-3 px-4 font-semibold text-gray-700 dark:text-gray-400">Cost</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-gray-600">
                                @foreach($recentRentals as $rental)
                                    <tr class="hover:bg-secondary dark:hover:bg-gray-700 transition-colors">
                                        <td class="py-3 px-4">
                                            <a href="{{ route(auth()->user()->role === 'admin' ? 'admin.rentals.show' : 'user.rentals.show', $rental['id']) }}" class="font-medium text-gray-900-600 dark:text-gray-900-400 hover:text-gray-900-700 dark:hover:text-gray-900-300">
                                                {{ $rental['itemName'] }}
                                            </a>
                                        </td>
                                        @if(auth()->user()->role === 'admin')<td class="py-3 px-4 text-gray-700 dark:text-gray-400">{{ $rental['userName'] ?? '-' }}</td>@endif
                                        <td class="py-3 px-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $this->getRentalStatusBadgeClass($rental['status']) }}">
                                                {{ $this->getRentalStatusLabel($rental['status']) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-gray-700 dark:text-gray-400">
                                            {{ $rental['startDate'] }} - {{ $rental['endDate'] }}
                                        </td>
                                        <td class="py-3 px-4 text-right font-semibold text-gray-900 dark:text-white">
                                            Rp {{ number_format($rental['totalCost'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-700 dark:text-neutral-500 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-700 dark:text-gray-400">No rentals yet</p>
                        <a href="{{ route('user.items.index') }}" class="inline-block mt-4 px-4 py-2 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:from-orange-600 hover:to-orange-700 shadow-md hover:shadow-lg active:shadow-sm active:scale-95 transition-all duration-200 transition-colors">
                            Start Renting
                        </a>
                    </div>
                @endif
            </div>

            <!-- Rental Trends Chart -->
            <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Rental Trends (30 Days)</h2>

                <div class="flex items-end gap-2 h-48">
                    @forelse($rentalTrends as $trend)
                        <div class="flex-1 flex flex-col items-center gap-2">
                            <div class="w-full flex items-end justify-center">
                                <div
                                    class="w-full bg-gradient-to-t from-primary-600 to-primary-400 dark:from-primary-500 dark:to-primary-300 rounded-t-sm hover:from-primary-700 hover:to-primary-500 dark:hover:from-primary-600 dark:hover:to-primary-400 transition-all duration-200 cursor-pointer group relative"
                                    :style="{ height: '{{ $trend['count'] * 20 }}px' || '4px' }"
                                    title="{{ $trend['count'] }} rentals"
                                >
                                    <div class="absolute -top-6 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 bg-gray-800 dark:bg-white text-white dark:text-gray-900 text-xs px-2 py-1 rounded whitespace-nowrap transition-opacity z-10">
                                        {{ $trend['count'] }}
                                    </div>
                                </div>
                            </div>
                            <span class="text-xs text-gray-700 dark:text-gray-500 text-center truncate">
                                {{ $trend['date'] }}
                            </span>
                        </div>
                    @empty
                        <div class="w-full flex items-center justify-center h-48 text-gray-700 dark:text-gray-400">
                            No rental data available
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Column: Available Items -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-50 dark:bg-gray-800 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Popular Items</h2>
                <a href="{{ route('user.items.index') }}" class="text-sm text-gray-900-600 dark:text-gray-900-400 hover:text-gray-900-700 dark:hover:text-gray-900-300 font-medium">
                    Browse All →
                </a>
            </div>

            <div class="space-y-4">
                @forelse($availableItems as $item)
                    <a
                        href="{{ route('user.items.show', $item['id']) }}"
                        class="flex gap-4 p-4 rounded-lg bg-secondary dark:bg-gray-700 hover:bg-tertiary dark:hover:bg-gray-600 border border-neutral-200 dark:border-gray-600 transition-all duration-200 group"
                    >
                        <!-- Item Image -->
                        <div class="w-20 h-20 shrink-0 overflow-hidden rounded-lg bg-gray-200 dark:bg-gray-600">
                            @if(isset($item['image']) && $item['image'])
                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                 <div class="flex h-full w-full items-center justify-center text-gray-400 dark:text-gray-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between">
                                    <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors truncate pr-2">
                                        {{ $item['name'] }}
                                    </h3>
                                    <span class="shrink-0 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-100 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300">
                                        {{ $item['quantity'] }} left
                                    </span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    {{ $item['category'] }}
                                </p>
                            </div>
                           
                            <div class="mt-2">
                                 <p class="text-base font-bold text-gray-900 dark:text-white">
                                    Rp {{ number_format($item['rent_price'], 0, ',', '.') }}<span class="text-xs font-normal text-gray-500 dark:text-gray-400">/day</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-8">
                        <svg class="w-12 h-12 mx-auto text-gray-700 dark:text-gray-500 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-700 dark:text-gray-400">No items available</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    </div>
</div>

<script>
    document.addEventListener('livewire:update', () => {
        // Re-initialize animations after Livewire updates
    });
</script>
