<div class="space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-secondary dark:text-neutral-400">
        <a href="{{ route('user.items.index') }}" class="hover:text-primary dark:hover:text-white">Items</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('user.items.show', $item->id) }}" class="hover:text-primary dark:hover:text-white">{{ $item->name }}</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span>Create Rental</span>
    </div>

    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary dark:text-white">Create Rental Request</h1>
        <p class="text-secondary dark:text-neutral-400 mt-2">Request to rent an item for your project</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <!-- Item Details Card -->
            <div class="p-6 rounded-lg bg-secondary dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 mb-6">
                <h2 class="text-lg font-semibold text-primary dark:text-white mb-4">Item Details</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Item Name</p>
                        <p class="text-lg font-semibold text-primary dark:text-white">{{ $item->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Category</p>
                        <p class="text-sm text-primary dark:text-white">{{ $item->category->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Daily Rate</p>
                        <p class="text-xl font-bold text-primary-600 dark:text-primary-400">Rp {{ number_format($item->daily_rate, 0, ',', '.') }}/day</p>
                    </div>
                </div>
            </div>

            <!-- Rental Form -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h2 class="text-lg font-semibold text-primary dark:text-white mb-6">Rental Details</h2>
                
                <form wire:submit="submit" class="space-y-6">
                    @csrf

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Rental Start Date <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <input
                            id="start_date"
                            type="date"
                            wire:model.live="start_date"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('start_date') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('start_date')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-secondary dark:text-neutral-400">When do you need this item?</p>
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Rental End Date <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <input
                            id="end_date"
                            type="date"
                            wire:model.live="end_date"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('end_date') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('end_date')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-secondary dark:text-neutral-400">When will you return it?</p>
                    </div>

                    <!-- Cost Summary -->
                    @if ($start_date && $end_date)
                        <div class="p-4 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-neutral-900 dark:text-white">Estimated Cost:</span>
                                <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                    Rp {{ number_format($this->calculateCost(), 0, ',', '.') }}
                                </span>
                            </div>
                            <p class="text-xs text-secondary dark:text-neutral-500 mt-2">
                                {{ $this->getDurationInDays() }} day(s) @ Rp {{ number_format($item->daily_rate, 0, ',', '.') }}/day
                            </p>
                        </div>
                    @endif

                    <!-- Purpose -->
                    <div>
                        <label for="purpose" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Rental Purpose (Optional)
                        </label>
                        <textarea
                            id="purpose"
                            wire:model="purpose"
                            placeholder="Tell us what you'll use this item for"
                            rows="3"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent focus:ring-primary-500 transition-all duration-200 resize-vertical"
                        ></textarea>
                        @error('purpose')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Terms Acceptance -->
                    <div class="flex items-start">
                        <input
                            id="accept_terms"
                            type="checkbox"
                            wire:model="accept_terms"
                            class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-700 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-400 cursor-pointer mt-1"
                        />
                        <label for="accept_terms" class="ml-3 text-sm text-neutral-600 dark:text-neutral-400 cursor-pointer">
                            I agree to the <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">rental terms and conditions</a>
                            <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                    </div>
                    @error('accept_terms')
                        <p class="text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                    @enderror

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full px-4 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span wire:loading.remove>Request Rental</span>
                        <span wire:loading class="inline-flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Requesting...
                        </span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Sidebar: Important Info -->
        <div class="space-y-6">
            <!-- Info Card -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h3 class="text-lg font-semibold text-primary dark:text-white mb-4">Important Information</h3>
                
                <div class="space-y-4 text-sm">
                    <div class="p-3 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="font-medium text-primary dark:text-white mb-1">📋 Verification Required</p>
                        <p class="text-xs text-secondary dark:text-neutral-400">Your KTP must be verified to rent items.</p>
                    </div>

                    <div class="p-3 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="font-medium text-primary dark:text-white mb-1">⏳ Approval Process</p>
                        <p class="text-xs text-secondary dark:text-neutral-400">Your rental request will be reviewed by our team.</p>
                    </div>

                    <div class="p-3 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="font-medium text-primary dark:text-white mb-1">💳 Payment</p>
                        <p class="text-xs text-secondary dark:text-neutral-400">Payment will be collected upon approval.</p>
                    </div>

                    <div class="p-3 rounded-lg bg-secondary dark:bg-neutral-800">
                        <p class="font-medium text-primary dark:text-white mb-1">📦 Condition</p>
                        <p class="text-xs text-secondary dark:text-neutral-400">You are responsible for the item's condition during rental.</p>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="p-6 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 shadow-md">
                <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-100 mb-2">Need Help?</h3>
                <p class="text-xs text-primary-700 dark:text-primary-300 mb-3">
                    Contact our support team if you have any questions about the rental process.
                </p>
                <a href="#" class="inline-flex items-center text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                    Get Support →
                </a>
            </div>
        </div>
    </div>
</div>
