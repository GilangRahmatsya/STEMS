<div class="min-h-screen bg-gray-900">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6 sm:mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-100">Dashboard</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Welcome back! Here's your rental overview</p>
        </div>

        {{-- Stats Cards - Mobile First Responsive --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6 sm:mb-8">
        {{-- Available Items --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 sm:p-6 hover:border-gray-600 transition-colors">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-gray-400">Available Items</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mt-1">{{ $stats['available_items'] }}</h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-green-500/10 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Active Rentals --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 sm:p-6 hover:border-gray-600 transition-colors">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-gray-400">Active Rentals</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mt-1">{{ $stats['active_rentals'] }}</h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-blue-500/10 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pending Approvals --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 sm:p-6 hover:border-gray-600 transition-colors">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-gray-400">Pending Approval</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mt-1">{{ $stats['pending_rentals'] }}</h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-yellow-500/10 p-2 sm:p-3 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Spent --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 sm:p-6 hover:border-gray-600 transition-colors">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-gray-400">Total Spent</p>
                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white mt-1 truncate">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-purple-500/10 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Active Rentals Alert --}}
    @if($active_rentals->count() > 0)
    <div class="bg-blue-500/10 border border-blue-500/50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div class="flex-1">
                <h4 class="text-blue-400 font-semibold mb-1">Anda memiliki {{ $active_rentals->count() }} item yang perlu dikembalikan</h4>
                <p class="text-blue-300 text-sm">Pastikan untuk mengembalikan item tepat waktu untuk menghindari denda.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Available Items to Rent --}}
        <div class="lg:col-span-2 bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-200">Available Items</h3>
                <a href="{{ route('user.items.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($available_items as $item)
                    <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 hover:border-blue-500 transition-colors">
                        <div class="mb-3">
                            <h4 class="text-gray-200 font-semibold mb-1">{{ $item->name }}</h4>
                            <p class="text-gray-400 text-sm">{{ $item->category?->name ?? 'Uncategorized' }}</p>
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $item->condition == 'Excellent' ? 'bg-green-500/10 text-green-400' : '' }}
                                {{ $item->condition == 'Good' ? 'bg-yellow-500/10 text-yellow-400' : '' }}
                                {{ $item->condition == 'Bad' ? 'bg-red-500/10 text-red-400' : '' }}">
                                {{ $item->condition }}
                            </span>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-500/10 text-green-400">
                                Ready
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-400 font-semibold">Rp {{ number_format($item->rent_price ?? 0, 0, ',', '.') }}/hari</span>
                            <a href="{{ route('user.rentals.create', $item->id) }}" 
                               class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition-colors">
                                Pinjam
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-400">Tidak ada item yang tersedia saat ini</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recent Rentals --}}
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-200">Recent Rentals</h3>
                <a href="{{ route('user.rentals.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_rentals as $rental)
                    <div class="py-3 border-b border-gray-700">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="text-gray-200 font-medium">{{ $rental->item->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $rental->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $rental->status == 'approved' ? 'bg-green-500/10 text-green-400' : '' }}
                                {{ $rental->status == 'pending' ? 'bg-yellow-500/10 text-yellow-400' : '' }}
                                {{ $rental->status == 'rejected' ? 'bg-red-500/10 text-red-400' : '' }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </div>
                        <p class="text-gray-500 text-xs">
                            {{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}
                        </p>
                        <p class="text-blue-400 text-sm font-semibold mt-1">
                            Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4 text-sm">Belum ada riwayat peminjaman</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-200 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('user.items.index') }}" 
               class="flex items-center justify-between p-4 bg-gray-900 hover:bg-gray-850 border border-gray-700 hover:border-blue-500 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="text-gray-200">Browse Items</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="{{ route('user.rentals.index') }}" 
               class="flex items-center justify-between p-4 bg-gray-900 hover:bg-gray-850 border border-gray-700 hover:border-blue-500 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="text-gray-200">My Rentals</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center justify-between p-4 bg-gray-900 hover:bg-gray-850 border border-gray-700 hover:border-blue-500 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-gray-200">My Profile</span>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</div>