<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Financial Management</h1>
            <flux:button variant="primary" wire:click="openCreateModal">
                <flux:icon.plus class="w-4 h-4 mr-2" />
                Add Record
            </flux:button>
        </div>
    </div>

    <!-- Financial Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-green-50 dark:bg-green-900/20 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 dark:bg-green-800 rounded-lg">
                    <flux:icon.arrow-trending-up class="w-6 h-6 text-green-600 dark:text-green-400" />
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-green-600 dark:text-green-400">Total Income</p>
                    <p class="text-2xl font-bold text-green-900 dark:text-green-100">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-red-50 dark:bg-red-900/20 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="p-2 bg-red-100 dark:bg-red-800 rounded-lg">
                    <flux:icon.arrow-trending-down class="w-6 h-6 text-red-600 dark:text-red-400" />
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-red-600 dark:text-red-400">Total Expenses</p>
                    <p class="text-2xl font-bold text-red-900 dark:text-red-100">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                    <flux:icon.currency-dollar class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Net Income</p>
                    <p class="text-2xl font-bold {{ $netIncome >= 0 ? 'text-blue-900 dark:text-blue-100' : 'text-red-900 dark:text-red-100' }}">
                        Rp {{ number_format($netIncome, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <flux:label>Type</flux:label>
                <flux:select wire:model.live="type" placeholder="All Types">
                    <option value="all">All Types</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </flux:select>
            </div>

            <div>
                <flux:label>Category</flux:label>
                <flux:select wire:model.live="category" placeholder="All Categories">
                    <option value="all">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                    @endforeach
                </flux:select>
            </div>

            <div class="md:col-span-2">
                <flux:label>Search</flux:label>
                <flux:input wire:model.live="search" placeholder="Search descriptions..." />
            </div>
        </div>
    </div>

    <!-- Records Table -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($records as $record)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $record->date->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $record->type === 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ ucfirst($record->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                {{ ucfirst($record->category) }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $record->description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $record->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $record->type === 'income' ? '+' : '-' }}Rp {{ number_format($record->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <flux:button variant="ghost" size="sm" wire:click="editRecord({{ $record->id }})">
                                        <flux:icon.pencil class="w-4 h-4" />
                                    </flux:button>
                                    <flux:button variant="ghost" size="sm" wire:click="deleteRecord({{ $record->id }})"
                                                 wire:confirm="Are you sure you want to delete this {{ $record->type }} record of Rp {{ number_format($record->amount, 0, ',', '.') }}? This will affect your financial reports.">
                                        <flux:icon.trash class="w-4 h-4 text-red-500" />
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No financial records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($records->hasPages())
            <div class="bg-white dark:bg-gray-800 px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                {{ $records->links() }}
            </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    <flux:modal name="create-record" :show="$showCreateModal" wire:model="showCreateModal">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $editingRecord ? 'Edit Financial Record' : 'Add Financial Record' }}</flux:heading>
                <flux:subheading>Add income or expense records to track your finances.</flux:subheading>
            </div>

            <form wire:submit="saveRecord" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Type</flux:label>
                        <flux:select wire:model="recordType" required>
                            <option value="income">Income</option>
                            <option value="expense">Expense</option>
                        </flux:select>
                        <flux:error name="recordType" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Category</flux:label>
                        <flux:input wire:model="recordCategory" placeholder="e.g., rental, photobooth, maintenance" required />
                        <flux:error name="recordCategory" />
                    </flux:field>
                </div>

                <flux:field>
                    <flux:label>Description</flux:label>
                    <flux:textarea wire:model="description" rows="3" placeholder="Describe the transaction..." required />
                    <flux:error name="description" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Amount (Rp)</flux:label>
                        <flux:input wire:model="amount" type="number" step="0.01" min="0" placeholder="0.00" required />
                        <flux:error name="amount" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Date</flux:label>
                        <flux:input wire:model="recordDate" type="date" required />
                        <flux:error name="recordDate" />
                    </flux:field>
                </div>

                <div class="flex justify-end space-x-4">
                    <flux:button variant="ghost" wire:click="closeModal">Cancel</flux:button>
                    <flux:button type="submit"
                                 variant="primary"
                                 wire:loading.attr="disabled"
                                 wire:loading.class="opacity-50 cursor-not-allowed">
                        <x-loading-spinner wire:loading size="sm" class="text-white mr-2" />
                        <span wire:loading.remove>{{ $editingRecord ? 'Update Record' : 'Save Record' }}</span>
                        <span wire:loading>{{ $editingRecord ? 'Updating...' : 'Saving...' }}</span>
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>