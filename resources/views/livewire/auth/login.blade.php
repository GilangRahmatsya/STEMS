<div x-data="{
    darkMode: localStorage.getItem('theme') === 'dark' || window.matchMedia('(prefers-color-scheme: dark)').matches,
    showPassword: false,
    init() {
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        this.$watch('darkMode', (val) => {
            localStorage.setItem('theme', val ? 'dark' : 'light');
            if (val) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });
    },
    toggleTheme() {
        this.darkMode = !this.darkMode;
    },
    togglePasswordVisibility() {
        this.showPassword = !this.showPassword;
    }
}" x-init="init()" class="min-h-screen flex items-center justify-center p-4 transition-all duration-500" :class="darkMode ? 'bg-gradient-to-br from-gray-600 via-gray-700 to-gray-800' : 'bg-gradient-to-br from-orange-500 via-red-500 to-red-600'">
    
    <!-- Theme Toggle Button -->
    <button
        @click="toggleTheme()"
        class="fixed top-6 right-6 p-3 rounded-full shadow-xl hover:scale-110 transition-all duration-300 z-50"
        :class="darkMode ? 'bg-gray-700 hover:bg-gray-600' : 'bg-white hover:bg-gray-50'"
        title="Toggle theme"
    >
        <svg x-show="!darkMode" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0112 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
        <svg x-show="darkMode" class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 3v1m0 16v1m9-9h-1m-16 0H1m15.364 1.636l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
    </button>

    <!-- Main Container -->
    <div class="w-full max-w-6xl rounded-2xl shadow-2xl overflow-hidden transition-all duration-500" :class="darkMode ? 'bg-gray-700/90 backdrop-blur-lg' : 'bg-white'">
        <div class="flex flex-col md:flex-row min-h-[600px]">
            
            <!-- Left Side - Login Form -->
            <div class="flex-1 p-8 md:p-12 flex items-center justify-center">
                <div class="w-full max-w-md space-y-6">
                    
                    <!-- Header -->
                    <div class="text-center space-y-2">
                        <h1 class="text-3xl font-bold transition-colors duration-300" :class="darkMode ? 'text-white' : 'text-gray-900'">
                            Hello Again!
                        </h1>
                        <p class="text-sm transition-colors duration-300" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
                            Let's get started with your 30 days trial
                        </p>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="rounded-lg p-4 transition-colors duration-300" :class="darkMode ? 'bg-red-900/20 border border-red-800' : 'bg-red-50 border border-red-200'">
                            <ul class="space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm transition-colors duration-300" :class="darkMode ? 'text-red-400' : 'text-red-600'">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- Email Input -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium transition-colors duration-300" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="rahmatsyag@gmail.com"
                                required
                                class="w-full px-4 py-3 rounded-lg border transition-all duration-300 focus:outline-none focus:ring-2"
                                :class="darkMode 
                                    ? 'bg-gray-600 border-gray-500 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500/50' 
                                    : 'bg-gray-100 border-gray-200 text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500/50'"
                            />
                        </div>

                        <!-- Password Input -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium transition-colors duration-300" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                    class="w-full px-4 py-3 pr-12 rounded-lg border transition-all duration-300 focus:outline-none focus:ring-2"
                                    :class="darkMode 
                                        ? 'bg-gray-600 border-gray-500 text-white placeholder-gray-400 focus:border-purple-500 focus:ring-purple-500/50' 
                                        : 'bg-gray-100 border-gray-200 text-gray-900 placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500/50'"
                                />
                                <button
                                    type="button"
                                    @click="togglePasswordVisibility()"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 transition-colors duration-300"
                                    :class="darkMode ? 'text-gray-400 hover:text-gray-300' : 'text-gray-500 hover:text-gray-700'"
                                >
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Remember Me & Recovery Password -->
                            <div class="flex items-center justify-between text-sm pt-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        id="remember"
                                        name="remember"
                                        value="1"
                                        class="w-4 h-4 rounded border transition-colors duration-300"
                                        :class="darkMode 
                                            ? 'bg-gray-700 border-gray-600 text-purple-600 focus:ring-purple-500' 
                                            : 'bg-white border-gray-300 text-orange-600 focus:ring-orange-500'"
                                    />
                                    <span class="transition-colors duration-300 font-medium" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
                                        Remember me
                                    </span>
                                </label>
                                <a href="{{ route('password.request') }}" class="font-medium transition-colors duration-300" :class="darkMode ? 'text-purple-400 hover:text-purple-300' : 'text-orange-600 hover:text-orange-700'">
                                    Recovery Password?
                                </a>
                            </div>
                        </div>

                        <!-- Sign In Button -->
                        <button
                            type="submit"
                            class="w-full py-3.5 rounded-lg font-semibold text-white shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]"
                            :class="darkMode 
                                ? 'bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700' 
                                : 'bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600'"
                        >
                            Sign In
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="flex items-center gap-4">
                        <div class="flex-1 border-t transition-colors duration-300" :class="darkMode ? 'border-gray-600' : 'border-gray-300'"></div>
                        <span class="text-sm transition-colors duration-300" :class="darkMode ? 'text-gray-400' : 'text-gray-400'">Or continue with</span>
                        <div class="flex-1 border-t transition-colors duration-300" :class="darkMode ? 'border-gray-600' : 'border-gray-300'"></div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="flex justify-center gap-4">
                        <!-- Google -->
                        <button type="button" class="p-3 rounded-lg border transition-all hover:scale-110" :class="darkMode ? 'bg-gray-700 border-gray-600 hover:bg-gray-600' : 'bg-white border-gray-200 hover:bg-gray-50'" title="Login with Google">
                            <svg class="w-6 h-6" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                        </button>

                        <!-- Apple -->
                        <button type="button" class="p-3 rounded-lg border transition-all hover:scale-110" :class="darkMode ? 'bg-gray-700 border-gray-600 hover:bg-gray-600' : 'bg-white border-gray-200 hover:bg-gray-50'" title="Login with Apple">
                            <svg class="w-6 h-6" :fill="darkMode ? '#FFFFFF' : '#000000'" viewBox="0 0 24 24">
                                <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01M12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                            </svg>
                        </button>

                        <!-- Facebook -->
                        <button type="button" class="p-3 rounded-lg border transition-all hover:scale-110" :class="darkMode ? 'bg-gray-700 border-gray-600 hover:bg-gray-600' : 'bg-white border-gray-200 hover:bg-gray-50'" title="Login with Facebook">
                            <svg class="w-6 h-6" fill="#1877F2" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Sign Up Link -->
                    <p class="text-center text-sm transition-colors duration-300" :class="darkMode ? 'text-gray-400' : 'text-gray-600'">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-semibold transition-colors duration-300" :class="darkMode ? 'text-purple-400 hover:text-purple-300' : 'text-orange-600 hover:text-orange-700'">
                            Sign up
                        </a>
                    </p>
                </div>
            </div>

            <!-- Right Side - Branding (Hidden on Mobile) -->
            <div class="hidden md:flex flex-1 items-center justify-center p-12 transition-all duration-500" :class="darkMode ? 'bg-gradient-to-br from-gray-700 to-gray-800' : 'bg-gradient-to-br from-gray-300 to-gray-400'">
                <div class="text-center space-y-8">
                    <!-- Logo Circle -->
                    <div class="flex justify-center">
                        <div class="w-32 h-32 rounded-full bg-white flex items-center justify-center shadow-2xl transition-all duration-300">
                            <!-- Camera Aperture Icon -->
                            <svg class="w-20 h-20 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Title and Subtitle -->
                    <div>
                        <h2 class="text-5xl font-bold mb-3 transition-colors duration-300" :class="darkMode ? 'text-white' : 'text-gray-900'">
                            STEMS
                        </h2>
                        <p class="text-lg mb-6 transition-colors duration-300" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
                            Swiper Tools & Equipment<br />Management System
                        </p>
                    </div>

                    <!-- Feature List -->
                    <div class="space-y-3 text-left max-w-xs mx-auto transition-colors duration-300" :class="darkMode ? 'text-gray-300' : 'text-gray-700'">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full transition-colors duration-300" :class="darkMode ? 'bg-purple-500' : 'bg-orange-500'"></div>
                            <span>Easy Equipment Rental</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full transition-colors duration-300" :class="darkMode ? 'bg-purple-500' : 'bg-orange-500'"></div>
                            <span>Real-time Availability</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-1.5 rounded-full transition-colors duration-300" :class="darkMode ? 'bg-purple-500' : 'bg-orange-500'"></div>
                            <span>Photobooth Integration</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
