<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Analytics</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Items</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['total_items'] }}</p>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Users</h3>
            <p class="text-3xl font-bold text-green-600">{{ $stats['total_users'] }}</p>
        </div>
        <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Rentals</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $stats['total_rentals'] }}</p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Active Rentals</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $stats['active_rentals'] }}</p>
        </div>
        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Revenue</h3>
            <p class="text-3xl font-bold text-red-600">Rp {{ number_format($stats['total_revenue']) }}</p>
        </div>
        <div class="bg-indigo-50 dark:bg-indigo-900/20 rounded-lg p-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Avg Rental Duration</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ round($stats['avg_rental_duration'], 1) }} days</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white dark:bg-zinc-900 rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Monthly Revenue (Last 12 Months)</h3>
            <canvas id="monthlyRevenueChart" height="80"></canvas>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Top 10 Most Rented Items (Last 6 Months)</h3>
            <div class="space-y-2">
                @foreach($itemUtilization as $item)
                    <div class="flex justify-between items-center">
                        <span>{{ $item['name'] }}</span>
                        <span class="font-medium">{{ $item['rentals'] }} rentals</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-900 rounded-lg p-6">
        <h3 class="text-lg font-semibold mb-4">Active Users (Last 6 Months)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($activeUsers as $user)
                <div class="border rounded p-3">
                    <p class="font-medium">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <p class="text-sm font-medium text-blue-600">{{ $user->rentals_count }} rentals</p>
                </div>
            @empty
                <p class="text-gray-500 col-span-full">No active users found.</p>
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