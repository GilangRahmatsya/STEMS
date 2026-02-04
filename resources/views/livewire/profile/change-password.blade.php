<div class="space-y-8">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary dark:text-white">Change Password</h1>
        <p class="text-secondary dark:text-neutral-400 mt-2">Update your account password for better security</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Password Change Form -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h2 class="text-xl font-semibold text-primary dark:text-white mb-6">Password Details</h2>

                <form wire:submit="submit" class="space-y-6">
                    @csrf

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Current Password <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <div class="relative">
                            <input
                                id="current_password"
                                :type="showCurrentPassword ? 'text' : 'password'"
                                wire:model="current_password"
                                placeholder="••••••••"
                                class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('current_password') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200 pr-12"
                            />
                            <button
                                type="button"
                                @click="toggleCurrentPasswordVisibility()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors"
                            >
                                <svg x-show="!showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.114a9.967 9.967 0 016.394 1.318m-15.842 5.817a3 3 0 113 3m-3-3l9-9" />
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            New Password <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                wire:model="password"
                                placeholder="••••••••"
                                class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('password') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200 pr-12"
                            />
                            <button
                                type="button"
                                @click="togglePasswordVisibility()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors"
                            >
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.114a9.967 9.967 0 016.394 1.318m-15.842 5.817a3 3 0 113 3m-3-3l9-9" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-secondary dark:text-neutral-400">At least 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                            Confirm Password <span class="text-danger-600 dark:text-danger-400">*</span>
                        </label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                :type="showPasswordConfirm ? 'text' : 'password'"
                                wire:model="password_confirmation"
                                placeholder="••••••••"
                                class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('password_confirmation') ? 'border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500' }} transition-all duration-200 pr-12"
                            />
                            <button
                                type="button"
                                @click="togglePasswordConfirmVisibility()"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors"
                            >
                                <svg x-show="!showPasswordConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPasswordConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.114a9.967 9.967 0 016.394 1.318m-15.842 5.817a3 3 0 113 3m-3-3l9-9" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-1 text-sm text-danger-600 dark:text-danger-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg"
                        >
                            <span wire:loading.remove>Change Password</span>
                            <span wire:loading class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Updating...
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
            <!-- Password Requirements -->
            <div class="p-6 rounded-lg bg-primary dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-md">
                <h3 class="text-lg font-semibold text-primary dark:text-white mb-4">Password Requirements</h3>

                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-secondary dark:text-neutral-400">At least 8 characters long</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-secondary dark:text-neutral-400">Mix uppercase and lowercase letters</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-secondary dark:text-neutral-400">Include numbers and special characters</span>
                    </li>
                </ul>
            </div>

            <!-- Security Tips -->
            <div class="p-6 rounded-lg bg-warning-50 dark:bg-warning-900/20 border border-warning-200 dark:border-warning-800 shadow-md">
                <h3 class="text-lg font-semibold text-warning-900 dark:text-warning-100 mb-4">🔒 Security Tips</h3>

                <ul class="space-y-2 text-sm text-warning-700 dark:text-warning-300">
                    <li>• Don't share your password with anyone</li>
                    <li>• Change password every 90 days</li>
                    <li>• Use unique passwords for each account</li>
                    <li>• Enable 2FA if available</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Alpine.js for password visibility toggle -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('changePassword', () => ({
            showCurrentPassword: false,
            showPassword: false,
            showPasswordConfirm: false,

            toggleCurrentPasswordVisibility() {
                this.showCurrentPassword = !this.showCurrentPassword;
            },

            togglePasswordVisibility() {
                this.showPassword = !this.showPassword;
            },

            togglePasswordConfirmVisibility() {
                this.showPasswordConfirm = !this.showPasswordConfirm;
            },
        }));
    });
</script>
