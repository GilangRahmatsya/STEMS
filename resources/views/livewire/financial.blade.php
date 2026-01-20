<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">Financial Overview</h1>
            <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full">Read-only view</span>
        </div>
    </div>

    <!-- Financial Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-6">
        <div class="bg-green-50 dark:bg-green-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg w-fit">
                    <flux:icon.arrow-trending-up class="w-5 h-5 sm:w-6 sm:h-6 text-green-600 dark:text-green-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-green-600 dark:text-green-400">Total Income</p>
                    <p class="text-lg sm:text-2xl font-bold text-green-900 dark:text-green-100 truncate">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-red-50 dark:bg-red-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-red-100 dark:bg-red-800 rounded-lg w-fit">
                    <flux:icon.arrow-trending-down class="w-5 h-5 sm:w-6 sm:h-6 text-red-600 dark:text-red-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-red-600 dark:text-red-400">Total Expenses</p>
                    <p class="text-lg sm:text-2xl font-bold text-red-900 dark:text-red-100 truncate">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg w-fit">
                    <flux:icon.currency-dollar class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 dark:text-blue-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-blue-600 dark:text-blue-400">Net Income</p>
                    <p class="text-lg sm:text-2xl font-bold {{ $netIncome >= 0 ? 'text-blue-900 dark:text-blue-100' : 'text-red-900 dark:text-red-100' }} truncate">
                        Rp {{ number_format($netIncome, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg p-4 sm:p-6 mb-6 shadow-sm">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                <select wire:model.live="type" class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="all">All Types</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                <select wire:model.live="category" class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="all">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-2 lg:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search descriptions..."
                       class="w-full text-sm border-gray-300 dark:border-gray-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
        </div>
    </div>

    <!-- Financial Records Table -->
    <div class="bg-white dark:bg-zinc-900 rounded-lg overflow-hidden shadow-sm">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Financial Records</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden sm:table-cell">Type</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider hidden md:table-cell">Category</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th class="px-4 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($records as $record)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900 dark:text-white">
                                {{ $record->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm hidden sm:table-cell">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    {{ $record->type === 'income' ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100' }}">
                                    {{ ucfirst($record->type) }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm hidden md:table-cell text-gray-900 dark:text-white truncate max-w-xs">
                                {{ $record->category }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm text-gray-900 dark:text-white truncate max-w-xs">
                                {{ $record->description }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-right font-medium
                                {{ $record->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $record->type === 'income' ? '+' : '-' }}Rp {{ number_format(abs($record->amount), 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 sm:px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No financial records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>