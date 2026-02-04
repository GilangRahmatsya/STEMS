<div class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-zinc-100">Dashboard Admin</h1>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">Welcome back to your management dashboard</p>
        </div>

        {{-- Stats Cards - Responsive Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Items --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Total Items</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $stats['total_items'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-xl border border-blue-100 dark:border-blue-800">
                        <flux:icon.cube class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </div>

            {{-- Ready Items --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Items Ready</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $stats['ready_items'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-emerald-50 dark:bg-emerald-900/20 p-3 rounded-xl border border-emerald-100 dark:border-emerald-800">
                        <flux:icon.check-circle class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                    </div>
                </div>
            </div>

            {{-- On Rent --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Items On Rent</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $stats['on_rent'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-amber-50 dark:bg-amber-900/20 p-3 rounded-xl border border-amber-100 dark:border-amber-800">
                        <flux:icon.clock class="w-6 h-6 text-amber-600 dark:text-amber-400" />
                    </div>
                </div>
            </div>

            {{-- Need Maintenance --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Maintenance</p>
                        <h3 class="text-3xl font-bold text-zinc-900 dark:text-white mt-2">{{ $stats['need_maintenance'] }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-rose-50 dark:bg-rose-900/20 p-3 rounded-xl border border-rose-100 dark:border-rose-800">
                        <flux:icon.exclamation-triangle class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Financial & Assets Stats - Responsive Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {{-- Total Assets --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Total Assets</p>
                        <h3 class="text-2xl lg:text-3xl font-bold text-zinc-900 dark:text-white mt-2 truncate">Rp {{ number_format($stats['total_assets']) }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-purple-50 dark:bg-purple-900/20 p-3 rounded-xl border border-purple-100 dark:border-purple-800">
                        <flux:icon.building-storefront class="w-6 h-6 text-purple-600 dark:text-purple-400" />
                    </div>
                </div>
            </div>

            {{-- Cash on Hand --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Cash on Hand</p>
                        <h3 class="text-2xl lg:text-3xl font-bold {{ $stats['cash_on_hand'] >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-rose-600 dark:text-rose-400' }} mt-2 truncate">
                            Rp {{ number_format($stats['cash_on_hand']) }}
                        </h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-xl border border-blue-100 dark:border-blue-800">
                        <flux:icon.banknotes class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                    </div>
                </div>
            </div>

            {{-- Assets from Financial --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Assets Financial</p>
                        <h3 class="text-2xl lg:text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-2 truncate">Rp {{ number_format($stats['assets_from_financial']) }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-indigo-50 dark:bg-indigo-900/20 p-3 rounded-xl border border-indigo-100 dark:border-indigo-800">
                        <flux:icon.chart-bar class="w-6 h-6 text-indigo-600 dark:text-indigo-400" />
                    </div>
                </div>
            </div>

            {{-- Total Income --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400 truncate">Total Income</p>
                        <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400 mt-2">Rp {{ number_format($stats['total_income']) }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-emerald-50 dark:bg-emerald-900/20 p-3 rounded-xl border border-emerald-100 dark:border-emerald-800">
                        <flux:icon.arrow-trending-up class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                    </div>
                </div>
            </div>

            {{-- Total Expense --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-rose-600 dark:text-rose-400 truncate">Total Expense</p>
                        <h3 class="text-3xl font-bold text-rose-600 dark:text-rose-400 mt-2">Rp {{ number_format($stats['total_expenses']) }}</h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-rose-50 dark:bg-rose-900/20 p-3 rounded-xl border border-rose-100 dark:border-rose-800">
                        <flux:icon.arrow-trending-down class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                    </div>
                </div>
            </div>

            {{-- Net Profit --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 truncate">Net Profit</p>
                        <h3 class="text-3xl font-bold {{ $stats['net_profit'] >= 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }} mt-2">
                            Rp {{ number_format($stats['net_profit']) }}
                        </h3>
                    </div>
                    <div class="ml-3 flex-shrink-0 bg-{{ $stats['net_profit'] >= 0 ? 'emerald' : 'rose' }}-50 dark:bg-{{ $stats['net_profit'] >= 0 ? 'emerald' : 'rose' }}-900/20 p-3 rounded-xl border border-{{ $stats['net_profit'] >= 0 ? 'emerald' : 'rose' }}-100 dark:border-{{ $stats['net_profit'] >= 0 ? 'emerald' : 'rose' }}-800">
                         @if($stats['net_profit'] >= 0)
                            <flux:icon.currency-dollar class="w-6 h-6 text-emerald-600 dark:text-emerald-400" />
                         @else
                            <flux:icon.exclamation-circle class="w-6 h-6 text-rose-600 dark:text-rose-400" />
                         @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Condition Stats --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200 mb-6">Condition Overview</h3>
                <div class="space-y-4">
                    @foreach($condition_stats as $stat)
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $stat->condition == 'Excellent' ? 'bg-emerald-500' : ($stat->condition == 'Good' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                    <span class="font-medium text-zinc-700 dark:text-zinc-300">{{ $stat->condition }}</span>
                                </div>
                                <span class="font-semibold text-zinc-900 dark:text-white">{{ $stat->total }} Item</span>
                            </div>
                            <div class="w-full bg-zinc-100 dark:bg-zinc-800 rounded-full h-2 overflow-hidden">
                                <div class="h-full rounded-full {{ $stat->condition == 'Excellent' ? 'bg-emerald-500' : ($stat->condition == 'Good' ? 'bg-amber-500' : 'bg-rose-500') }}" 
                                     style="width: {{ ($stat->total / $stats['total_items']) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Top Rented Items --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200 mb-6">Top Rented Items</h3>
                <div class="space-y-4">
                    @forelse($top_items as $item)
                        <div class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 rounded-lg transition-colors border border-transparent hover:border-zinc-200 dark:hover:border-zinc-700">
                            <div>
                                <p class="text-zinc-900 dark:text-zinc-200 font-medium">{{ $item->name }}</p>
                                <p class="text-zinc-600 dark:text-zinc-400 text-xs mt-0.5">{{ $item->category?->name ?? 'Uncategorized' }}</p>
                            </div>
                            <span class="bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 px-3 py-1 rounded-lg text-sm font-medium border border-blue-100 dark:border-blue-800">
                                {{ $item->rentals_count }}x
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <flux:icon.inbox class="w-12 h-12 text-zinc-300 mx-auto mb-2" />
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">No rental data yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Financial Overview Chart --}}
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 mb-8">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200 mb-6">Financial Trends</h3>
            <div class="h-80 w-full">
                <canvas id="financialChart"></canvas>
            </div>
        </div>

        {{-- Asset Breakdown --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Assets by Category --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200 mb-6">Assets by Category</h3>
                <div class="space-y-4">
                    @forelse($asset_breakdown as $asset)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/50">
                            <div class="flex items-center gap-3">
                                <span class="w-2 h-8 rounded-full bg-blue-500"></span>
                                <span class="text-zinc-900 dark:text-zinc-300 font-medium">{{ $asset->category->name ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-zinc-900 dark:text-white font-semibold">{{ $asset->item_count }} items</span>
                                <p class="text-zinc-500 dark:text-zinc-400 text-xs">Rp {{ number_format($asset->total_value) }}</p>
                            </div>
                        </div>
                    @empty
                         <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">No asset data available</p>
                    @endforelse
                </div>
            </div>

            {{-- Assets by Status --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200 mb-6">Assets by Status</h3>
                <div class="space-y-4">
                    @forelse($asset_by_status as $asset)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/50">
                            <div class="flex items-center gap-3">
                                <span class="w-2.5 h-2.5 rounded-full
                                    {{ $asset->status == 'Ready' ? 'bg-emerald-500' : ($asset->status == 'On Rent' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                <span class="text-zinc-900 dark:text-zinc-300 font-medium">{{ $asset->status }}</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-zinc-900 dark:text-white font-semibold">{{ $asset->item_count }} items</span>
                                <p class="text-zinc-500 dark:text-zinc-400 text-xs">Rp {{ number_format($asset->total_value) }}</p>
                            </div>
                        </div>
                    @empty
                         <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">No asset data available</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Pending Approvals --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200">Pending Approvals</h3>
                </div>
                <div class="space-y-3">
                    @forelse($pending_rentals as $rental)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-800/50">
                            <div>
                                <p class="text-zinc-900 dark:text-zinc-200 font-medium">{{ $rental->item->name }}</p>
                                <p class="text-zinc-500 dark:text-zinc-400 text-xs">{{ $rental->user->name }} • {{ $rental->created_at->diffForHumans() }}</p>
                            </div>
                            <button class="px-3 py-1 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 text-xs font-medium rounded-lg border border-yellow-100 dark:border-yellow-800">
                                Pending
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <flux:icon.check-circle class="w-10 h-10 text-zinc-300 mx-auto mb-2" />
                            <p class="text-zinc-500 dark:text-zinc-400 text-sm">All caught up!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Activities --}}
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-200">Recent Activities</h3>
                </div>
                <div class="space-y-3">
                    @forelse($recent_rentals as $rental)
                        <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-100 dark:border-zinc-800">
                            <div>
                                <p class="text-zinc-900 dark:text-zinc-200 font-medium">{{ $rental->item->name }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="text-zinc-500 dark:text-zinc-400 text-xs">{{ $rental->user->name }}</span>
                                    <span class="text-zinc-300">•</span>
                                    <span class="text-zinc-500 text-xs">{{ $rental->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-lg text-xs font-medium border
                                {{ $rental->status == 'approved' ? 'bg-emerald-50 text-emerald-600 border-emerald-100 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800' : '' }}
                                {{ $rental->status == 'pending' ? 'bg-yellow-50 text-yellow-600 border-yellow-100 dark:bg-yellow-900/20 dark:text-yellow-400 dark:border-yellow-800' : '' }}
                                {{ $rental->status == 'rejected' ? 'bg-rose-50 text-rose-600 border-rose-100 dark:bg-rose-900/20 dark:text-rose-400 dark:border-rose-800' : '' }}">
                                {{ ucfirst($rental->status) }}
                            </span>
                        </div>
                    @empty
                         <p class="text-zinc-500 dark:text-zinc-400 text-center py-4">No recent activity</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('livewire:loaded', function () {
    const ctx = document.getElementById('financialChart');
    if (ctx) {
        // ChartJS with Zinc colors
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
                        'rgba(147, 51, 234, 0.7)', // purple-600
                        'rgba(37, 99, 235, 0.7)',  // blue-600
                        'rgba(79, 70, 229, 0.7)',  // indigo-600
                        'rgba(16, 185, 129, 0.7)',  // emerald-500
                        'rgba(225, 29, 72, 0.7)'    // rose-600
                    ],
                    borderColor: [
                        'rgb(147, 51, 234)',
                        'rgb(37, 99, 235)',
                        'rgb(79, 70, 229)',
                        'rgb(16, 185, 129)',
                        'rgb(225, 29, 72)'
                    ],
                    borderWidth: 1,
                    borderRadius: 6,
                    barThickness: 40,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                         backgroundColor: 'rgba(24, 24, 27, 0.9)',
                         titleColor: '#fff',
                         bodyColor: '#d4d4d8',
                         padding: 12,
                         cornerRadius: 8,
                         displayColors: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(161, 161, 170, 0.1)' // zinc-400/10
                        },
                        ticks: {
                            color: '#71717a', // zinc-500
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID', { notation: "compact" });
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#71717a'
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