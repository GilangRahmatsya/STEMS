<div class="space-y-8">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary dark:text-white">Profile Settings</h1>
        <p class="text-secondary dark:text-neutral-400 mt-2">Manage your personal information</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Profile Form -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h2 class="text-xl font-semibold text-primary dark:text-white mb-6">Personal Information</h2>

                <form wire:submit="submit" class="space-y-6">
                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Full Name <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <input
                            id="name"
                            type="text"
                            wire:model="name"
                            placeholder="Your full name"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('name') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('name')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Email Address <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            placeholder="your@email.com"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('email') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('email')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Phone Number (Optional)
                        </label>
                        <input
                            id="phone"
                            type="tel"
                            wire:model="phone"
                            placeholder="+62 8XX XXXX XXXX"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('phone') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('phone')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Address (Optional)
                        </label>
                        <textarea
                            id="address"
                            wire:model="address"
                            placeholder="Your street address"
                            rows="3"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('address') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200 resize-vertical"
                        ></textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- KTP Number -->
                    <div>
                        <label for="ktp_number" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            KTP Number (Optional)
                        </label>
                        <input
                            id="ktp_number"
                            type="text"
                            wire:model="ktp_number"
                            placeholder="Your KTP number"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('ktp_number') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200"
                        />
                        @error('ktp_number')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-secondary dark:text-neutral-400">Used for rental verification</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
                        >
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Saving...
                            </span>
                        </button>

                        <a
                            href="{{ route('user.dashboard') }}"
                            class="px-6 py-2.5 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-700 font-semibold transition-all duration-200 text-center"
                        >
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Account Info Card -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h3 class="text-lg font-semibold text-primary dark:text-white mb-4">Account Information</h3>

                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">Account Created</p>
                        <p class="font-medium text-primary dark:text-white">{{ auth()->user()->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-secondary dark:text-neutral-500 mb-1">KTP Verification</p>
                        @if (auth()->user()->ktp_verified_at)
                            <p class="font-medium text-success-600 dark:text-success-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Verified
                            </p>
                        @else
                            <p class="font-medium text-warning-600 dark:text-warning-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Pending
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Security Card -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h3 class="text-lg font-semibold text-primary dark:text-white mb-4">Security</h3>

                <div class="space-y-3">
                    <a
                        href="{{ route('profile.change-password') }}"
                        class="block px-4 py-2 rounded-lg bg-secondary dark:bg-neutral-800 text-primary dark:text-white hover:bg-tertiary dark:hover:bg-neutral-700 font-medium text-center transition-colors"
                    >
                        Change Password
                    </a>
                </div>
            </div>

            <!-- Help Card -->
            <div class="p-6 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800 shadow-md">
                <h3 class="text-sm font-semibold text-primary-900 dark:text-primary-100 mb-2">Need Help?</h3>
                <p class="text-xs text-primary-700 dark:text-primary-300 mb-3">
                    If you need assistance with your profile, contact our support team.
                </p>
                <a href="#" class="inline-flex items-center text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                    Contact Support →
                </a>
            </div>
        </div>
    </div>
</div>
