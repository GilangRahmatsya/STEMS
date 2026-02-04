<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-neutral-400">
        <a href="{{ route('user.rentals.index') }}" class="hover:text-gray-900 dark:hover:text-white">Rentals</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span>Rental #{{ $rental->id }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Status Card -->
            <div class="card">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Rental Request</h1>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ match($rental->status) {
                        'pending' => 'bg-warning-100 dark:bg-warning-900/20 text-warning-700 dark:text-warning-300',
                        'approved' => 'bg-blue-50 dark:bg-primary-900/20 text-gray-900 dark:text-primary-300',
                        'picked_up' => 'bg-secondary-100 dark:bg-secondary-900/20 text-secondary-700 dark:text-secondary-300',
                        'returned' => 'bg-success-100 dark:bg-success-900/20 text-success-700 dark:text-success-300',
                        'rejected' => 'bg-danger-100 dark:bg-danger-900/20 text-danger-700 dark:text-danger-300',
                        default => 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300',
                    } }}">
                        {{ match($rental->status) {
                            'pending' => 'Pending Review',
                            'approved' => 'Approved',
                            'picked_up' => 'Picked Up',
                            'returned' => 'Returned',
                            'rejected' => 'Rejected',
                            default => ucfirst(str_replace('_', ' ', $rental->status)),
                        } }}
                    </span>
                </div>

                <!-- Item Info -->
                <div class="mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
                    @if ($rental->item)
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ $rental->item->name }}</h2>
                        <p class="text-gray-600 dark:text-neutral-400 mb-4">{{ $rental->item->description }}</p>
                        <div class="flex flex-wrap gap-3">
                            @if ($rental->item->category)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 dark:bg-primary-900/20 text-gray-900 dark:text-primary-300">
                                    {{ $rental->item->category->name }}
                                </span>
                            @endif
                        </div>
                    @else
                        <h2 class="text-xl font-semibold text-red-600 dark:text-red-400 mb-3">Item Unavailable</h2>
                        <p class="text-gray-600 dark:text-neutral-400">The requested item is no longer available.</p>
                    @endif
                </div>

                <!-- Rental Dates -->
                <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-neutral-200 dark:border-neutral-800">
                    <div>
                        <p class="text-xs text-gray-700 dark:text-neutral-500 mb-1">Start Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $rental->start_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-700 dark:text-neutral-500 mb-1">End Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $rental->end_date->format('M d, Y') }}</p>
                    </div>
                </div>

                <!-- Cost Summary -->
                <div class="bg-secondary dark:bg-neutral-800 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm text-gray-700 dark:text-neutral-400">Duration:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $rental->getDurationInDays() }} day(s)</span>
                    </div>
                    @if ($rental->item)
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-700 dark:text-neutral-400">Daily Rate:</span>
                            <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($rental->item->rent_price ?? 0, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center border-t border-neutral-300 dark:border-neutral-700 pt-2">
                        <span class="font-semibold text-gray-900 dark:text-white">Total Cost:</span>
                        <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Purpose (if provided) -->
            @if ($rental->purpose)
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Rental Purpose</h3>
                    <p class="text-gray-600 dark:text-neutral-400">{{ $rental->purpose }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Action Card -->
            @if ($rental->status === 'pending')
                <div class="card">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Actions</h3>
                    <button
                        wire:click="cancelRental"
                        class="w-full px-4 py-3 rounded-lg bg-danger-600 hover:bg-danger-700 text-white font-medium transition-all border border-danger-700 dark:border-danger-800 shadow-md hover:shadow-lg"
                    >
                        Cancel Request
                    </button>
                </div>
            @endif

            <!-- Status Timeline -->
            <div class="card">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Timeline</h3>
                
                <div class="space-y-4">
                    @php
                        $timeline = [
                            ['status' => 'pending', 'label' => 'Request Submitted', 'icon' => '📝'],
                            ['status' => 'approved', 'label' => 'Approved', 'icon' => '✅'],
                            ['status' => 'picked_up', 'label' => 'Picked Up', 'icon' => '🚚'],
                            ['status' => 'returned', 'label' => 'Returned', 'icon' => '📦'],
                        ];
                    @endphp

                    @foreach ($timeline as $step)
                        <div class="flex items-start gap-3">
                            <div class="text-xl">{{ $step['icon'] }}</div>
                            <div class="flex-1">
                                <p class="text-sm font-medium {{ in_array($rental->status, array_slice(array_column($timeline, 'status'), 0, array_search($step['status'], array_column($timeline, 'status')) + 1)) ? 'text-blue-600 dark:text-white' : 'text-gray-600 dark:text-neutral-500' }}">
                                    {{ $step['label'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Rental Info -->
            <div class="card">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Rental Details</h3>

                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-xs text-gray-600 dark:text-neutral-500 mb-1">Rental ID</p>
                        <p class="font-medium text-gray-900 dark:text-white">#{{ $rental->id }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-neutral-500 mb-1">Item Owner</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $rental->item?->user?->name ?? 'Unknown' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-neutral-500 mb-1">Payment Status</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($rental->payment_status) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 dark:text-neutral-500 mb-1">Requested On</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $rental->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
