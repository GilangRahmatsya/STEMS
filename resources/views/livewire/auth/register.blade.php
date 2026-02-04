<div class="min-h-screen flex overflow-hidden bg-white dark:bg-neutral-950" x-data="registerPage()" x-init="init()">
    <!-- Mobile Menu Toggle for Branding Side -->
    <div class="absolute top-4 left-4 md:hidden z-50">
        <button
            @click="showMobileMenu = !showMobileMenu"
            class="p-2 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- Left Section: Registration Form -->
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

            <!-- Heading and Subheading -->
            <div class="text-center mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 dark:text-white mb-2">
                    Create Account
                </h1>
                <p class="text-sm sm:text-base text-neutral-600 dark:text-neutral-400">
                    Join STEMS and start renting equipment
                </p>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800">
                    <p class="text-sm font-medium text-danger-700 dark:text-danger-300 mb-2">
                        Registration Failed
                    </p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-danger-600 dark:text-danger-400">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <form wire:submit.prevent="submit" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Full Name <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <input
                        id="name"
                        type="text"
                        wire:model="name"
                        placeholder="John Doe"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('name') ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} transition-all duration-200"
                    />
                    @error('name')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Phone Field (Optional) -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Phone Number (Optional)
                    </label>
                    <input
                        id="phone"
                        type="tel"
                        wire:model="phone"
                        placeholder="+62 8XX XXXX XXXX"
                        class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent focus:ring-primary-500 dark:focus:ring-primary-500 transition-all duration-200"
                    />
                    @error('phone')
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-neutral-900 dark:text-white mb-2">
                        Password <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            :type="showPassword ? 'text' : 'password'"
                            wire:model="password"
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('password') ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} transition-all duration-200 pr-12"
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
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">At least 8 characters</p>
                </div>

                <!-- Confirm Password Field -->
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
                            class="w-full px-4 py-2.5 rounded-lg bg-neutral-50 dark:bg-neutral-800 border border-neutral-300 dark:border-neutral-700 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $errors->has('password_confirmation') ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} transition-all duration-200 pr-12"
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
                        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms & Conditions -->
                <div class="flex items-start">
                    <input
                        id="accept_terms"
                        type="checkbox"
                        wire:model="accept_terms"
                        class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-700 text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-400 cursor-pointer mt-1"
                    />
                    <label for="accept_terms" class="ml-3 text-sm text-neutral-600 dark:text-neutral-400 cursor-pointer">
                        I agree to the <a href="#" class="text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 font-medium">terms and conditions</a>
                        <span class="text-danger-600 dark:text-danger-400">*</span>
                    </label>
                </div>
                @error('accept_terms')
                    <p class="text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-60"
                    class="w-full px-4 py-3 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold shadow-md hover:shadow-lg active:shadow-sm active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 dark:focus:ring-offset-neutral-900 disabled:opacity-50 disabled:cursor-not-allowed mt-6"
                >
                    <span wire:loading.remove class="inline-flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Create Account
                    </span>
                    <span wire:loading class="inline-flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Creating Account...
                    </span>
                </button>
            </form>

            <!-- Sign In Link -->
            <p class="mt-6 text-center text-sm text-neutral-600 dark:text-neutral-400">
                Already have an account?
                <a href="{{ route('login') }}" class="font-medium text-orange-600 dark:text-orange-400 hover:text-orange-700 dark:hover:text-orange-300 transition-colors">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <!-- Right Section: Branding (Hidden on Mobile) -->
    <div
        class="hidden md:flex md:w-3/5 relative overflow-hidden items-center justify-center"
        :style="{ backgroundImage: isDarkMode ? 'url(/assets/darkmode-background.png)' : 'url(/assets/lightmode-background.png)' }"
        style="background-size: cover; background-position: center;"
    >
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/40 dark:bg-black/60"></div>

        <!-- Branding Content -->
        <div class="relative z-10 text-center text-white px-8">
            <img src="/images/stems-logo.png" alt="STEMS" class="h-16 w-auto mx-auto mb-8 drop-shadow-lg">

            <h2 class="text-5xl lg:text-6xl font-bold mb-4 drop-shadow-lg">
                STEMS
            </h2>

            <p class="text-lg lg:text-xl text-white/90 drop-shadow-md max-w-xs mx-auto">
                Swiper Tools & Equipment Management System
            </p>

            <div class="mt-12 space-y-4 text-left max-w-sm">
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-primary-400"></div>
                    <p class="text-white/80">Easy Equipment Rental</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-secondary-400"></div>
                    <p class="text-white/80">Real-time Availability</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-3 h-3 rounded-full bg-success-400"></div>
                    <p class="text-white/80">Photobooth Integration</p>
                </div>
            </div>
        </div>
    </div>

<script>
    function registerPage() {
        return {
            isDarkMode: false,
            showPassword: false,
            showPasswordConfirm: false,
            showMobileMenu: false,

            init() {
                const saved = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                this.isDarkMode = saved ? saved === 'dark' : prefersDark;
                this.applyTheme();

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!localStorage.getItem('theme')) {
                        this.isDarkMode = e.matches;
                        this.applyTheme();
                    }
                });
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

            togglePasswordVisibility() {
                this.showPassword = !this.showPassword;
            },

            togglePasswordConfirmVisibility() {
                this.showPasswordConfirm = !this.showPasswordConfirm;
            },
        };
    }
</script>
