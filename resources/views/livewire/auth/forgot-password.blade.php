<div class="min-h-screen flex overflow-hidden bg-white dark:bg-neutral-950">
    <!-- Left Section: Form -->
    <div class="w-full md:w-2/5 flex items-center justify-center px-6 sm:px-8 lg:px-10 py-12 bg-white dark:bg-neutral-900">
        <div class="w-full max-w-md">
            <!-- Theme Toggle Button -->
            <div class="absolute top-4 right-4">
                <button
                    @click="toggleTheme()"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors"
                    title="Toggle theme"
                >
                    <svg x-show="!isDarkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1m-16 0H1m15.364 1.636l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="isDarkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="/images/stems-logo.png" alt="STEMS" class="h-10 w-auto mx-auto mb-4">
            </div>

            <!-- Heading -->
            <div class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-white mb-2">
                    Reset Password
                </h1>
                <p class="text-sm sm:text-base text-neutral-600 dark:text-neutral-400">
                    Enter your email address and we'll send you a link to reset your password
                </p>
            </div>

            <!-- Success Message -->
            @if ($status)
                <div class="mb-6 p-4 rounded-lg bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-800">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-success-600 dark:text-success-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-success-700 dark:text-success-300">
                                {{ $status }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800">
                    <p class="text-sm font-medium text-danger-700 dark:text-danger-300 mb-2">
                        Request Failed
                    </p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-danger-600 dark:text-danger-400">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form wire:submit="submit" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Email Address <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        wire:model="email"
                        placeholder="you@example.com"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('email') ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} transition-all duration-200"
                    />
                    @error('email')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full px-4 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-neutral-900 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span wire:loading.remove>Send Reset Link</span>
                    <span wire:loading class="inline-flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Sending...
                    </span>
                </button>
            </form>

            <!-- Back to Login Link -->
            <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400">
                Remember your password?
                <a href="{{ route('login') }}" class="font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <!-- Right Section: Branding -->
    <div
        class="hidden md:flex md:w-3/5 relative overflow-hidden items-center justify-center"
        :style="{ backgroundImage: isDarkMode ? 'url(/assets/darkmode-background.png)' : 'url(/assets/lightmode-background.png)' }"
        style="background-size: cover; background-position: center;"
    >
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60"></div>

        <div class="relative z-10 text-center text-white px-8">
            <img src="/images/stems-logo.png" alt="STEMS" class="h-16 w-auto mx-auto mb-8 drop-shadow-lg">
            <h2 class="text-5xl lg:text-6xl font-bold mb-4 drop-shadow-lg">STEMS</h2>
            <p class="text-lg lg:text-xl text-white/90 drop-shadow-md max-w-xs mx-auto">
                Swiper Tools & Equipment Management System
            </p>
        </div>
    </div>
</div>

<!-- Alpine.js Data -->
<div x-data="forgotPasswordPage()" x-init="init()" style="display: none;"></div>

<script>
    function forgotPasswordPage() {
        return {
            isDarkMode: false,

            init() {
                const saved = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                this.isDarkMode = saved ? saved === 'dark' : prefersDark;
                this.applyTheme();
            },

            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                this.applyTheme();
            },

            applyTheme() {
                const html = document.documentElement;
                if (this.isDarkMode) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            },
        };
    }
</script>
