<div class="p-6 dark:bg-zinc-800 min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-200">Dashboard</h1>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        {{-- Available Items --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Available Items</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['available_items'] }}</h3>
                </div>
                <div class="bg-green-500/10 p-3 rounded-full">
                    <flux:icon.check-circle class="w-8 h-8 text-green-500" />
                </div>
            </div>
        </div>

        {{-- Active Rentals --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Active Rentals</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['active_rentals'] }}</h3>
                </div>
                <div class="bg-blue-500/10 p-3 rounded-full">
                    <flux:icon.cube class="w-8 h-8 text-blue-500" />
                </div>
            </div>
        </div>

        {{-- Pending Approvals --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Pending Approval</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['pending_rentals'] }}</h3>
                </div>
                <div class="bg-yellow-500/10 p-3 rounded-full">
                    <flux:icon.clock class="w-8 h-8 text-yellow-500" />
                </div>
            </div>
        </div>

        {{-- Total Spent --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Total Spent</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</h3>
                </div>
                <div class="bg-purple-500/10 p-3 rounded-full">
                    <flux:icon.banknotes class="w-8 h-8 text-purple-500" />
                </div>
            </div>
        </div>
    </div>

    {{-- Active Rentals Alert --}}
    @if($active_rentals->count() > 0)
    <div class="bg-blue-500/10 border border-blue-500/50 rounded-lg p-4 mb-6">
        <div class="flex items-start">
            <flux:icon.information-circle class="w-5 h-5 text-blue-400 mt-0.5 mr-3" />
            <div class="flex-1">
                <h4 class="text-blue-400 font-semibold mb-1">Anda memiliki {{ $active_rentals->count() }} item yang perlu dikembalikan</h4>
                <p class="text-blue-300 text-sm">Pastikan untuk mengembalikan item tepat waktu untuk menghindari denda.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        {{-- Available Items to Rent --}}
        <div class="lg:col-span-2 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Available Items</h3>
                <a href="{{ route('items.index') }}" class="text-indigo-600 hover:text-indigo-500 text-sm" wire:navigate>
                    Lihat Semua →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($available_items as $item)
                    <div class="bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-lg p-4 hover:border-indigo-500 transition-colors">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-32 object-cover rounded mb-3">
                        @else
                            <div class="w-full h-32 bg-zinc-200 dark:bg-zinc-800 rounded mb-3 flex items-center justify-center">
                                <flux:icon.photo class="w-12 h-12 text-zinc-400" />
                            </div>
                        @endif
                        <div class="mb-3">
                            <h4 class="text-gray-900 dark:text-gray-200 font-semibold mb-1">{{ $item->name }}</h4>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">{{ $item->category?->name ?? 'No Category' }}</p>
                            @if($item->description)
                                <p class="text-zinc-600 dark:text-gray-300 text-xs mt-1">{{ Str::limit($item->description, 50) }}</p>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $item->condition == 'Excellent' ? 'bg-green-500/10 text-green-600 dark:text-green-400' : '' }}
                                {{ $item->condition == 'Good' ? 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400' : '' }}">
                                {{ $item->condition }}
                            </span>
                            <span class="text-xs px-2 py-1 rounded-full bg-green-500/10 text-green-600 dark:text-green-400">
                                Ready
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-indigo-600 font-semibold">Rp {{ number_format($item->rent_price ?? 0, 0, ',', '.') }}/hari</span>
                            <flux:button size="xs" href="{{ route('user.rentals.create', $item->id) }}" wire:navigate>>
                                Pinjam
                            </flux:button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-zinc-500 dark:text-gray-400">Tidak ada item yang tersedia saat ini</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Recent Rentals --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Recent Rentals</h3>
                <a href="#" class="text-indigo-600 hover:text-indigo-500 text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_rentals as $rental)
                    <div class="py-3 border-b border-zinc-200 dark:border-zinc-700">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $rental->item->name }}</p>
                                <p class="text-zinc-500 dark:text-gray-400 text-xs">{{ $rental->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="text-xs px-2 py-1 rounded-full
                                {{ $rental->status == 'approved' ? 'bg-green-500/10 text-green-600 dark:text-green-400' : '' }}
                                {{ $rental->status == 'pending' ? 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400' : '' }}
                                {{ $rental->status == 'rejected' ? 'bg-red-500/10 text-red-600 dark:text-red-400' : '' }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </div>
                        <p class="text-zinc-500 text-xs">
                            {{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}
                        </p>
                        <p class="text-indigo-600 text-sm font-semibold mt-1">
                            Rp {{ number_format($rental->total_price ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4 text-sm">Belum ada riwayat peminjaman</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('items.index') }}" 
               class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-950 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-indigo-500 rounded-lg transition-colors"
               wire:navigate>
                <div class="flex items-center space-x-3">
                    <flux:icon.magnifying-glass class="w-6 h-6 text-indigo-600" />
                    <span class="text-gray-900 dark:text-gray-200">Browse Items</span>
                </div>
                <flux:icon.chevron-right class="w-5 h-5 text-zinc-400" />
            </a>

            <a href="#" 
               class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-950 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-indigo-500 rounded-lg transition-colors">
                <div class="flex items-center space-x-3">
                    <flux:icon.clipboard-document-list class="w-6 h-6 text-green-600" />
                    <span class="text-gray-900 dark:text-gray-200">My Rentals</span>
                </div>
                <flux:icon.chevron-right class="w-5 h-5 text-zinc-400" />
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-950 hover:bg-zinc-100 dark:hover:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 hover:border-indigo-500 rounded-lg transition-colors"
               wire:navigate>
                <div class="flex items-center space-x-3">
                    <flux:icon.user class="w-6 h-6 text-purple-600" />
                    <span class="text-gray-900 dark:text-gray-200">My Profile</span>
                </div>
                <flux:icon.chevron-right class="w-5 h-5 text-zinc-400" />
            </a>
        </div>
    </div>
</div>