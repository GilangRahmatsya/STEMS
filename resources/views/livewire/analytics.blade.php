<div class="px-4 py-6 sm:px-6 lg:px-8 bg-white dark:bg-zinc-900 min-h-screen">
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Analytics Overview</h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Deep dive into your business performance.</p>
            </div>
            <span class="text-xs font-medium text-zinc-500 bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-300 px-3 py-1.5 rounded-full ring-1 ring-inset ring-zinc-200 dark:ring-zinc-700">
                Read-only view
            </span>
        </div>
    </div>

    <!-- Key Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg border border-blue-100 dark:border-blue-800">
                    <flux:icon.cube class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Items</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_items'] }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-lg border border-emerald-100 dark:border-emerald-800">
                    <flux:icon.users class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Users</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_users'] }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 rounded-lg border border-purple-100 dark:border-purple-800">
                    <flux:icon.clipboard-document-list class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Rentals</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $stats['total_rentals'] }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-lg border border-amber-100 dark:border-amber-800">
                    <flux:icon.clock class="w-5 h-5" />
                </span>
                 <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Active Rentals</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ $stats['active_rentals'] }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                <span class="p-2 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 rounded-lg border border-rose-100 dark:border-rose-800">
                    <flux:icon.banknotes class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Revenue</span>
            </div>
            <p class="text-3xl font-bold text-rose-600 dark:text-rose-400 truncate">Rp {{ number_format($stats['total_revenue']) }}</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-lg transition-shadow">
             <div class="flex items-center justify-between mb-4">
                 <span class="p-2 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-lg border border-indigo-100 dark:border-indigo-800">
                    <flux:icon.calendar-days class="w-5 h-5" />
                </span>
                <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Avg Duration</span>
            </div>
            <p class="text-3xl font-bold text-zinc-900 dark:text-white">{{ round($stats['avg_rental_duration'], 1) }} <span class="text-lg font-normal text-zinc-500">days</span></p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Revenue Chart -->
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6">Monthly Revenue <span class="text-sm font-normal text-zinc-500 group-hover:text-zinc-700">(12 Months)</span></h3>
            <div class="w-full">
                <canvas id="monthlyRevenueChart" class="w-full h-80"></canvas>
            </div>
        </div>

        <!-- Most Rented Items -->
        <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 flex flex-col">
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6">Top Rented Items</h3>
            <div class="flex-1 overflow-y-auto max-h-[320px] pr-2 space-y-4">
                @foreach($itemUtilization as $item)
                    <div class="flex justify-between items-center p-3 rounded-lg bg-zinc-50 dark:bg-zinc-900/50 border border-zinc-100 dark:border-zinc-700/50">
                        <span class="text-sm font-medium text-zinc-900 dark:text-white truncate flex-1">{{ $item['name'] }}</span>
                         <span class="px-2 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-600 dark:bg-blue-900/20 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                            {{ $item['rentals'] }} rentals
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-6">Active Users <span class="text-sm font-normal text-zinc-500">(Last 6 Months)</span></h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($activeUsers as $user)
                <div class="group border border-zinc-200 dark:border-zinc-700 rounded-xl p-4 hover:border-blue-500 dark:hover:border-blue-500 hover:ring-1 hover:ring-blue-500 transition-all cursor-default">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center text-zinc-500 dark:text-zinc-300 font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                             <p class="font-medium text-sm text-zinc-900 dark:text-white truncate group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $user->name }}</p>
                             <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-zinc-100 dark:border-zinc-700/50 flex justify-between items-center">
                        <span class="text-xs text-zinc-400">Activity</span>
                        <span class="text-xs font-semibold text-zinc-900 dark:text-white">{{ $user->rentals_count }} Rentals</span>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-zinc-500 dark:text-zinc-400">
                    <flux:icon.users class="w-12 h-12 mx-auto mb-3 text-zinc-300" />
                    No active users found in this period.
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyRevenueChart');
            if (ctx) {
                const monthlyData = @json($monthlyRevenue);
                const labels = monthlyData.map(d => d.month);
                const revenues = monthlyData.map(d => d.revenue);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Revenue',
                            data: revenues,
                            backgroundColor: 'rgba(59, 130, 246, 0.7)',
                            borderColor: 'rgb(59, 130, 246)',
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
                                 padding: 12,
                                 cornerRadius: 8,
                                 displayColors: false,
                                 callbacks: {
                                     label: function(context) {
                                         let label = context.dataset.label || '';
                                         if (label) {
                                             label += ': ';
                                         }
                                         if (context.parsed.y !== null) {
                                             label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                         }
                                         return label;
                                     }
                                 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(161, 161, 170, 0.1)'
                                },
                                ticks: {
                                    color: '#71717a',
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
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
            }
        });
    </script>
</div>