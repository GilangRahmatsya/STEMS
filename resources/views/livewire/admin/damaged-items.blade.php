<div class="px-4 py-6 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">Damaged Items & Losses</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Manage equipment damage reports and track repair costs</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 lg:gap-6 mb-6">
        <div class="bg-red-50 dark:bg-red-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-red-100 dark:bg-red-800 rounded-lg w-fit">
                    <flux:icon.exclamation-triangle class="w-5 h-5 sm:w-6 sm:h-6 text-red-600 dark:text-red-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-red-600 dark:text-red-400">Damaged Items</p>
                    <p class="text-lg sm:text-2xl font-bold text-red-900 dark:text-red-100">{{ $totalDamagedItems }}</p>
                </div>
            </div>
        </div>

        <div class="bg-orange-50 dark:bg-orange-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-orange-100 dark:bg-orange-800 rounded-lg w-fit">
                    <flux:icon.currency-dollar class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600 dark:text-orange-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-orange-600 dark:text-orange-400">Total Losses (YTD)</p>
                    <p class="text-lg sm:text-2xl font-bold text-orange-900 dark:text-orange-100">Rp {{ number_format($totalDamageCost, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 sm:p-6 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <div class="p-2 bg-yellow-100 dark:bg-yellow-800 rounded-lg w-fit">
                    <flux:icon.wrench-screwdriver class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-600 dark:text-yellow-400" />
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-yellow-600 dark:text-yellow-400">Under Repair</p>
                    <p class="text-lg sm:text-2xl font-bold text-yellow-900 dark:text-yellow-100">{{ $underRepairCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Damage Form -->
    @if($showReportForm && $selectedItem)
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 sm:p-6 mb-6 shadow-sm">
        <h2 class="text-base sm:text-lg font-semibold mb-4">Report Damage for: {{ $selectedItem->name }}</h2>

        <form wire:submit.prevent="reportDamage" class="space-y-4">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Damage Description</label>
                <textarea wire:model="damage_description" rows="4" placeholder="Describe the damage and circumstances..."
                         class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                @error('damage_description') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Repair/Recovery Cost</label>
                <input wire:model="repair_cost" type="number" placeholder="0" min="0" step="1000"
                       class="w-full text-sm border-gray-300 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('repair_cost') <span class="text-red-500 text-xs sm:text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium transition-colors">
                    Report Damage
                </button>
                <button type="button" wire:click="cancelReport" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    @endif

    <!-- Damaged Items Table -->
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden shadow-sm">
        <div class="px-4 sm:px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-base sm:text-lg font-semibold">Damaged Items</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden sm:table-cell">Category</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">Location</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Asset Value</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($damagedItems as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-10 w-10 sm:h-12 sm:w-12 object-cover rounded">
                            @else
                                <div class="h-10 w-10 sm:h-12 sm:w-12 bg-gray-200 dark:bg-zinc-700 rounded flex items-center justify-center flex-shrink-0">
                                    <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-4 min-w-0">
                            <div class="text-xs sm:text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->name }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 truncate hidden sm:block">{{ Str::limit($item->description, 40) }}</div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                            @if($item->category)
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $item->category->icon }} <span class="hidden sm:inline">{{ $item->category->name }}</span>
                                </span>
                            @else
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-xs sm:text-sm hidden md:table-cell text-gray-900 dark:text-white truncate max-w-xs">
                            {{ $item->location ?: '—' }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900 dark:text-white">
                            Rp {{ number_format($item->asset_value ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm font-medium">
                            <div class="flex gap-2">
                                <button wire:click="selectItem({{ $item->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                    Report Damage
                                </button>
                                <button wire:click="markRepaired({{ $item->id }})" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                    Mark Repaired
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 sm:px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            No damaged items found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($damagedItems->hasPages())
            <div class="mt-4">
                {{ $damagedItems->links() }}
            </div>
        @endif
    </div>
</div>