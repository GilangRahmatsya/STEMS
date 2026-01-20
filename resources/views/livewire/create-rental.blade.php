<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Rent Item: {{ $item->name }}</h1>

    <form wire:submit="submit" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
            <input type="date" wire:model="start_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">End Date</label>
            <input type="date" wire:model="end_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notes (Optional)</label>
            <textarea wire:model="notes" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
            @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
            <h3 class="font-semibold mb-4 text-blue-800 dark:text-blue-200">Borrower Information</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                    <input type="text" wire:model="borrower_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your full name">
                    @error('borrower_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                    <input type="date" wire:model="borrower_birth_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('borrower_birth_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purpose of Rental</label>
                <textarea wire:model="purpose" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Please describe the purpose of renting this item"></textarea>
                @error('purpose') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded border border-yellow-200 dark:border-yellow-800">
                <h4 class="font-medium text-yellow-800 dark:text-yellow-200 mb-2">KTP Requirements</h4>
                <p class="text-sm text-yellow-700 dark:text-yellow-300 mb-2">
                    KTP is required as collateral for the rental. Please attach a photocopy or photo of your KTP when picking up the item.
                </p>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">KTP Notes (Optional)</label>
                <textarea wire:model="ktp_notes" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Any additional notes about KTP submission"></textarea>
                @error('ktp_notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">
                    <strong>Note:</strong> KTP will only be used as guarantee and will be returned upon item return.
                </p>
            </div>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
            <h3 class="font-semibold mb-2">Rental Summary</h3>
            <p>Item: {{ $item->name }}</p>
            <p>Price per day: Rp {{ number_format($item->rent_price) }}</p>
            @if($start_date && $end_date)
                <p>Duration: {{ \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date)) + 1 }} days</p>
                <p class="font-bold">Total: Rp {{ number_format((\Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date)) + 1) * $item->rent_price) }}</p>
            @endif
        </div>

        <div class="flex space-x-4">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Submit Rental Request
            </button>
            <a href="{{ route('user.items.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                Cancel
            </a>
        </div>
    </form>
</div>