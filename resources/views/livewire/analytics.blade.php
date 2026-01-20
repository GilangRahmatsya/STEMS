<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Analytics Overview</h1>
            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full">Read-only view</span>
        </div>
    </div>

    <!-- Key Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-6">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Total Items</h3>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-blue-600 mt-2">{{ $stats['total_items'] }}</p>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Total Users</h3>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-green-600 mt-2">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Total Rentals</h3>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-purple-600 mt-2">{{ $stats['total_rentals'] }}</p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Active Rentals</h3>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-yellow-600 mt-2">{{ $stats['active_rentals'] }}</p>
        </div>
        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Total Revenue</h3>
            <p class="text-lg sm:text-2xl lg:text-3xl font-bold text-red-600 mt-2 truncate">Rp {{ number_format($stats['total_revenue']) }}</p>
        </div>
        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 uppercase tracking-wider">Avg Duration</h3>
            <p class="text-2xl sm:text-3xl lg:text-4xl font-bold text-indigo-600 mt-2">{{ round($stats['avg_rental_duration'], 1) }} d</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
        <!-- Monthly Revenue Chart -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h3 class="text-base sm:text-lg font-semibold mb-4">Monthly Revenue (Last 12 Months)</h3>
            <div class="w-full overflow-x-auto">
                <canvas id="monthlyRevenueChart" height="80" style="min-width: 300px;"></canvas>
            </div>
        </div>

        <!-- Most Rented Items -->
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
            <h3 class="text-base sm:text-lg font-semibold mb-4">Top 10 Most Rented Items (Last 6 Months)</h3>
            <div class="space-y-2 overflow-y-auto max-h-96">
                @foreach($itemUtilization as $item)
                    <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-700">
                        <span class="text-sm text-gray-900 dark:text-white truncate flex-1">{{ $item['name'] }}</span>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400 ml-2">{{ $item['rentals'] }} rentals</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 shadow-sm">
        <h3 class="text-base sm:text-lg font-semibold mb-4">Active Users (Last 6 Months)</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
            @forelse($activeUsers as $user)
                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 sm:p-4 hover:shadow-md transition-shadow">
                    <p class="font-medium text-sm sm:text-base text-gray-900 dark:text-white truncate">{{ $user->name }}</p>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400 mt-2">{{ $user->rentals_count }} rentals</p>
                </div>
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400 col-span-full py-4">No active users found.</p>
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
                            backgroundColor: '#3B82F6',
                            borderColor: '#1E40AF',
                            borderWidth: 1,
                            borderRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
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
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>