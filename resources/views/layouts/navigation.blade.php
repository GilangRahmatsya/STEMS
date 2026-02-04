<nav
    x-data="navigationMenu()"
    x-init="init()"
    class="sticky top-0 z-40 bg-white dark:bg-gray-700/90 border-b border-gray-200 dark:border-gray-600 shadow-md transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo and Brand -->
            <div class="flex items-center space-x-3 flex-shrink-0">
                <a
                    href="{{ route('user.dashboard') }}"
                    class="flex items-center space-x-2 hover:opacity-80 transition-opacity duration-200 group"
                >
                    <img
                        x-show="!isDarkMode"
                        src="/images/stems_logo_dark.png"
                        alt="STEMS"
                        class="h-8 w-8 rounded-lg group-hover:shadow-md transition-shadow duration-200"
                    >
                    <img
                        x-show="isDarkMode"
                        src="/images/stems_logo_light.png"
                        alt="STEMS"
                        class="h-8 w-8 rounded-lg group-hover:shadow-md transition-shadow duration-200"
                    >
                    <span class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white hidden sm:inline">
                        STEMS
                    </span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-1">
                <a
                    href="{{ route('user.dashboard') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    Dashboard
                </a>

                <a
                    href="{{ route('user.items.index') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.items.*') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10" />
                    </svg>
                    Items
                </a>

                <a
                    href="{{ route('user.rentals.index') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('user.rentals.*') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    My Rentals
                </a>

                @can('is-admin')
                    <div class="mx-2 h-6 border-r border-neutral-300 dark:border-neutral-700"></div>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                    >
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Admin
                    </a>
                @endcan
            </div>

            <!-- Right Side: Controls -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Quick Actions Dropdown -->
                <div class="hidden md:block" x-data="{ open: false }">
                    <div class="relative">
                        <button
                            @click="open = !open"
                            @keydown.escape="open = false"
                            class="flex items-center space-x-2 px-4 py-2 rounded-lg bg-gradient-to-r from-orange-500 to-red-500 dark:from-purple-600 dark:to-indigo-600 text-white hover:shadow-lg transition-all duration-200 text-sm font-medium"
                        >
                            <span>⚡</span>
                            <span>Quick Actions</span>
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                        
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-700/90 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg py-2 z-50"
                        >
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('user.rentals.create', ['item' => 1]) }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>➕</span>
                                        <span>Create Rental</span>
                                    </a>
                                    <a href="{{ route('user.items.create') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>📦</span>
                                        <span>Add Equipment</span>
                                    </a>
                                    <a href="{{ route('user.reports') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>📊</span>
                                        <span>View Reports</span>
                                    </a>
                                    <a href="{{ route('user.queues') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>⏱️</span>
                                        <span>Manage Queue</span>
                                    </a>
                                    <a href="{{ route('user.financial') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>💰</span>
                                        <span>Financial Overview</span>
                                    </a>
                                @else
                                    <a href="{{ route('user.rentals.create', ['item' => 1]) }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>➕</span>
                                        <span>Create Rental Request</span>
                                    </a>
                                    <a href="{{ route('user.items.index') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>📦</span>
                                        <span>Browse Equipment</span>
                                    </a>
                                    <a href="{{ route('user.rentals.history') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>📜</span>
                                        <span>My History</span>
                                    </a>
                                    <a href="{{ route('user.queues') }}" @click="open = false" class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors text-sm">
                                        <span>⏱️</span>
                                        <span>View Queue</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>


                <!-- Theme Toggle Button -->
                <button
                    @click="toggleTheme()"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500 transition-all duration-200 shadow-sm hover:shadow-md"
                    :aria-label="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                    title="Toggle theme"
                >
                    <svg x-show="!isDarkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1m-16 0H1m15.364 1.636l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg x-show="isDarkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                </button>

                <!-- Cart Button -->
                <a
                    href="{{ route('user.cart') }}"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-orange-100 dark:hover:bg-orange-900/40 hover:text-orange-600 dark:hover:text-orange-400 transition-all duration-200 shadow-sm hover:shadow-md relative {{ request()->routeIs('user.cart') ? 'bg-orange-100 dark:bg-orange-900/40 text-orange-600 dark:text-orange-400' : '' }}"
                    title="Shopping Cart"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </a>

                <!-- Notifications (Optional) -->
                <button
                    class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-500 transition-all duration-200 shadow-sm hover:shadow-md relative"
                    title="Notifications"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-danger-500 rounded-full"></span>
                </button>

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ userMenuOpen: false }">
                    <button
                        @click="userMenuOpen = !userMenuOpen"
                        class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-secondary dark:bg-neutral-800 hover:bg-tertiary dark:hover:bg-neutral-700 transition-all duration-200 shadow-sm hover:shadow-md group"
                    >
                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random&color=fff"
                            alt="{{ auth()->user()->name }}"
                            class="w-6 h-6 rounded-full ring-2 ring-primary-400 dark:ring-primary-600 group-hover:ring-primary-500"
                        >
                        <span class="hidden sm:inline text-sm font-medium text-gray-900 dark:text-white max-w-[100px] truncate">
                            {{ auth()->user()->name }}
                        </span>
                        <svg
                            class="w-4 h-4 text-gray-700 dark:text-gray-200 transition-transform duration-200"
                            :class="{ 'rotate-180': userMenuOpen }"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>

                    <!-- User Dropdown Menu Items -->
                    <div
                        x-show="userMenuOpen"
                        @click.outside="userMenuOpen = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 rounded-lg bg-white dark:bg-gray-700/90 border border-gray-200 dark:border-gray-600 shadow-xl z-50"
                    >
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-600">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <a
                                href="{{ route('profile.edit') }}"
                                @click="userMenuOpen = false"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white transition-colors duration-200"
                            >
                                <svg class="w-4 h-4 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profile Settings
                            </a>

                            <a
                                href="{{ route('profile.change-password') }}"
                                @click="userMenuOpen = false"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white transition-colors duration-200"
                            >
                                <svg class="w-4 h-4 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Change Password
                            </a>

                            @can('is-admin')
                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    @click="userMenuOpen = false"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 hover:text-gray-900 dark:hover:text-white transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                    </svg>
                                    Admin Panel
                                </a>
                            @endcan

                            <div class="border-t border-gray-200 dark:border-gray-600 my-2"></div>

                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button
                                    type="submit"
                                    @click="userMenuOpen = false"
                                    class="w-full text-left px-4 py-2 text-sm text-danger-600 dark:text-danger-400 hover:bg-danger-50 dark:hover:bg-danger-900/20 hover:text-danger-700 dark:hover:text-danger-300 transition-colors duration-200"
                                >
                                    <svg class="w-4 h-4 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <button
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 dark:bg-gradient-to-br dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gradient-to-br dark:hover:from-orange-600 dark:hover:via-orange-700 dark:hover:to-orange-800 transition-all duration-300 ease-in-out"
                    :aria-label="mobileMenuOpen ? 'Close menu' : 'Open menu'"
                >
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden border-t border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 backdrop-blur-sm"
        >
            <div class="px-4 py-4 space-y-2">
                <a
                    href="{{ route('user.dashboard') }}"
                    @click="mobileMenuOpen = false"
                    class="block px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    Dashboard
                </a>

                <a
                    href="{{ route('user.items.index') }}"
                    @click="mobileMenuOpen = false"
                    class="block px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('user.items.*') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10" />
                    </svg>
                    Items
                </a>

                <a
                    href="{{ route('user.rentals.index') }}"
                    @click="mobileMenuOpen = false"
                    class="block px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('user.rentals.*') ? 'bg-orange-50 dark:bg-purple-600/20 text-orange-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600' }}"
                >
                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    My Rentals
                </a>

                @can('is-admin')
                    <div class="border-t border-neutral-300 dark:border-neutral-700 my-2"></div>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        @click="mobileMenuOpen = false"
                        class="block px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 {{ request()->routeIs('admin.*') ? 'bg-orange-50 dark:bg-neutral-900 text-orange-600 dark:text-orange-400' : 'text-gray-700 dark:text-neutral-400 hover:bg-orange-50 dark:hover:bg-neutral-700' }}"
                    >
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Admin Panel
                    </a>
                @endcan
            </div>
        </div>
    </div>
</nav>

<!-- Alpine.js Navigation Script -->
<script>
    function navigationMenu() {
        return {
            isDarkMode: false,
            mobileMenuOpen: false,

            init() {
                const saved = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                this.isDarkMode = saved ? saved === 'dark' : prefersDark;
                this.applyTheme();

                // Watch for system theme changes
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
        };
    }
</script>
