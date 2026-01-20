<div class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-200">Dashboard Admin</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Welcome back to your management dashboard</p>
        </div>

        {{-- Stats Cards - Responsive Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-6">
            {{-- Total Items --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Total Items</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total_items'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-blue-500/10 p-2 sm:p-3 rounded-full">
                        <flux:icon.cube class="w-6 h-6 sm:w-8 sm:h-8 text-blue-500" />
                    </div>
                </div>
            </div>

            {{-- Ready Items --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Items Ready</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['ready_items'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-green-500/10 p-2 sm:p-3 rounded-full">
                        <flux:icon.check-circle class="w-6 h-6 sm:w-8 sm:h-8 text-green-500" />
                    </div>
                </div>
            </div>

            {{-- On Rent --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Items On Rent</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['on_rent'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-yellow-500/10 p-2 sm:p-3 rounded-full">
                        <flux:icon.clock class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-500" />
                    </div>
                </div>
            </div>

            {{-- Need Maintenance --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Maintenance</p>
                        <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['need_maintenance'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-red-500/10 p-2 sm:p-3 rounded-full">
                        <flux:icon.exclamation-triangle class="w-6 h-6 sm:w-8 sm:h-8 text-red-500" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Financial & Assets Stats - Responsive Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 mb-6">
        {{-- Total Assets --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Total Assets</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white mt-1 truncate">Rp {{ number_format($stats['total_assets']) }}</h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-purple-500/10 p-2 sm:p-3 rounded-full">
                    <flux:icon.building-storefront class="w-6 h-6 sm:w-8 sm:h-8 text-purple-500" />
                </div>
            </div>
        </div>

        {{-- Cash on Hand --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Cash on Hand</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold {{ $stats['cash_on_hand'] >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }} mt-1 truncate">
                        Rp {{ number_format($stats['cash_on_hand']) }}
                    </h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-blue-500/10 p-2 sm:p-3 rounded-full">
                    <flux:icon.banknotes class="w-6 h-6 sm:w-8 sm:h-8 text-blue-500" />
                </div>
            </div>
        </div>

        {{-- Assets from Financial --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-gray-400 truncate">Assets Financial</p>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-1 truncate">Rp {{ number_format($stats['assets_from_financial']) }}</h3>
                </div>
                <div class="ml-3 flex-shrink-0 bg-indigo-500/10 p-2 sm:p-3 rounded-full">
                    <flux:icon.chart-bar class="w-6 h-6 sm:w-8 sm:h-8 text-indigo-500" />
                </div>
            </div>
        </div>

        {{-- Total Income --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm text-green-600 dark:text-green-400 truncate font-medium">Total Income</p>
                    <h3 class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">Rp {{ number_format($stats['total_income']) }}</h3>
                </div>
                <div class="bg-green-500/10 p-3 rounded-full">
                    <flux:icon.arrow-trending-up class="w-8 h-8 text-green-500" />
                </div>
            </div>
        </div>

        {{-- Total Expense --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Total Expense</p>
                    <h3 class="text-3xl font-bold text-red-600 dark:text-red-400 mt-1">Rp {{ number_format($stats['total_expenses']) }}</h3>
                </div>
                <div class="bg-red-500/10 p-3 rounded-full">
                    <flux:icon.arrow-trending-down class="w-8 h-8 text-red-500" />
                </div>
            </div>
        </div>

        {{-- Net Profit --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-zinc-500 dark:text-gray-400 text-sm">Net Profit</p>
                    <h3 class="text-3xl font-bold {{ $stats['net_profit'] >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} mt-1">
                        Rp {{ number_format($stats['net_profit']) }}
                    </h3>
                </div>
                <div class="bg-{{ $stats['net_profit'] >= 0 ? 'green' : 'red' }}-500/10 p-3 rounded-full">
                    <flux:icon.{{ $stats['net_profit'] >= 0 ? 'currency-dollar' : 'exclamation-circle' }} class="w-8 h-8 text-{{ $stats['net_profit'] >= 0 ? 'green' : 'red' }}-500" />
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Condition Stats --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Kondisi Items</h3>
            <div class="space-y-3">
                @foreach($condition_stats as $stat)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <span class="w-3 h-3 rounded-full {{ $stat->condition == 'Excellent' ? 'bg-green-500' : ($stat->condition == 'Good' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                            <span class="text-gray-900 dark:text-gray-300">{{ $stat->condition }}</span>
                        </div>
                        <span class="text-gray-900 dark:text-white font-semibold">{{ $stat->total }}</span>
                    </div>
                    <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-2">
                        <div class="h-2 rounded-full {{ $stat->condition == 'Excellent' ? 'bg-green-500' : ($stat->condition == 'Good' ? 'bg-yellow-500' : 'bg-red-500') }}" 
                             style="width: {{ ($stat->total / $stats['total_items']) * 100 }}%"></div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Top Rented Items --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Top Rented Items</h3>
            <div class="space-y-3">
                @forelse($top_items as $item)
                    <div class="flex items-center justify-between py-2 border-b border-zinc-200 dark:border-zinc-700">
                        <div>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $item->name }}</p>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">{{ $item->category }}</p>
                        </div>
                        <span class="bg-blue-500/10 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-full text-sm">
                            {{ $item->rentals_count }}x
                        </span>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4">Belum ada data peminjaman</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Financial Overview Chart --}}
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Financial Overview</h3>
        <div class="h-80">
            <canvas id="financialChart"></canvas>
        </div>
    </div>

    {{-- Asset Breakdown --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Assets by Category --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Assets by Category</h3>
            <div class="space-y-3">
                @forelse($asset_breakdown as $asset)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                            <span class="text-gray-900 dark:text-gray-300">{{ $asset->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-gray-900 dark:text-white font-semibold">{{ $asset->item_count }} items</span>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">Rp {{ number_format($asset->total_value) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4">No asset data available</p>
                @endforelse
            </div>
        </div>

        {{-- Assets by Status --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200 mb-4">Assets by Status</h3>
            <div class="space-y-3">
                @forelse($asset_by_status as $asset)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <span class="w-3 h-3 rounded-full
                                {{ $asset->status == 'Ready' ? 'bg-green-500' : ($asset->status == 'On Rent' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                            <span class="text-gray-900 dark:text-gray-300">{{ $asset->status }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-gray-900 dark:text-white font-semibold">{{ $asset->item_count }} items</span>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">Rp {{ number_format($asset->total_value) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4">No asset data available</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Pending Approvals --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Pending Approvals</h3>
                <a href="#" class="text-indigo-600 hover:text-indigo-500 text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($pending_rentals as $rental)
                    <div class="flex items-center justify-between py-3 border-b border-zinc-200 dark:border-zinc-700">
                        <div>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $rental->item->name }}</p>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">{{ $rental->user->name }}</p>
                            <p class="text-zinc-500 text-xs">{{ $rental->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="bg-yellow-500/10 text-yellow-600 dark:text-yellow-400 px-3 py-1 rounded-full text-xs">
                            Pending
                        </span>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4">Tidak ada pending approval</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Recent Activities</h3>
                <a href="#" class="text-indigo-600 hover:text-indigo-500 text-sm">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recent_rentals as $rental)
                    <div class="flex items-center justify-between py-3 border-b border-zinc-200 dark:border-zinc-700">
                        <div>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $rental->item->name }}</p>
                            <p class="text-zinc-500 dark:text-gray-400 text-sm">{{ $rental->user->name }}</p>
                            <p class="text-zinc-500 text-xs">{{ $rental->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs
                            {{ $rental->status == 'approved' ? 'bg-green-500/10 text-green-600 dark:text-green-400' : '' }}
                            {{ $rental->status == 'pending' ? 'bg-yellow-500/10 text-yellow-600 dark:text-yellow-400' : '' }}
                            {{ $rental->status == 'rejected' ? 'bg-red-500/10 text-red-600 dark:text-red-400' : '' }}">
                            {{ ucfirst($rental->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-zinc-500 dark:text-gray-400 text-center py-4">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:loaded', function () {
    const ctx = document.getElementById('financialChart');
    if (ctx) {
        const financialChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Total Assets', 'Cash on Hand', 'Assets from Financial', 'Total Income', 'Total Expenses'],
                datasets: [{
                    label: 'Amount (IDR)',
                    data: [
                        @json($stats['total_assets']),
                        @json($stats['cash_on_hand']),
                        @json($stats['assets_from_financial']),
                        @json($stats['total_income']),
                        @json($stats['total_expenses'])
                    ],
                    backgroundColor: [
                        'rgba(139, 92, 246, 0.8)', // purple for total assets
                        'rgba(59, 130, 246, 0.8)',  // blue for cash on hand
                        'rgba(99, 102, 241, 0.8)',  // indigo for assets from financial
                        'rgba(16, 185, 129, 0.8)',  // green for income
                        'rgba(239, 68, 68, 0.8)'    // red for expenses
                    ],
                    borderColor: [
                        'rgb(139, 92, 246)',
                        'rgb(59, 130, 246)',
                        'rgb(99, 102, 241)',
                        'rgb(16, 185, 129)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });

        // Update chart when Livewire updates
        Livewire.on('financialDataUpdated', () => {
            financialChart.data.datasets[0].data = [
                @json($stats['total_assets']),
                @json($stats['cash_on_hand']),
                @json($stats['assets_from_financial']),
                @json($stats['total_income']),
                @json($stats['total_expenses'])
            ];
            financialChart.update();
        });
    }
});
</script>