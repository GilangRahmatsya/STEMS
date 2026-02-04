@if(auth()->check())
    <!-- Backdrop for mobile -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm z-30 md:hidden transition-opacity duration-300"
        x-show="sidebarOpen"
        x-transition
        @click="sidebarOpen = false"></div>
    
    <aside
        x-data="sidebarMenu({currentRoute: '{{ Route::currentRouteName() }}'})"
        x-init="init()"
        class="fixed left-0 top-0 h-screen w-64 flex flex-col transition-all duration-300 z-40 transform md:translate-x-0 overflow-y-auto scrollbar-thin"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        :class="darkMode 
            ? 'bg-gradient-to-b from-orange-700 via-orange-800 to-orange-900 text-orange-50' 
            : 'bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 text-white'"
        x-transition
    >
        <!-- Sidebar Header -->
        <div class="p-6 flex-shrink-0" :class="darkMode ? 'border-b border-orange-800/40' : 'border-b border-white/20'">
            <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 hover:opacity-90 transition-opacity" @click="sidebarOpen = false">
                <div class="h-10 w-10 rounded-lg bg-white/20 flex items-center justify-center flex-shrink-0">
                    <img x-show="darkMode" src="/images/stems_logo_light.png" alt="STEMS" class="w-6 h-6 object-contain">
                    <img x-show="!darkMode" src="/images/stems_logo_dark.png" alt="STEMS" class="w-6 h-6 object-contain">
                </div>
                <div>
                    <p class="text-sm font-bold" :class="darkMode ? 'text-orange-50' : 'text-white'">STEMS</p>
                    <p class="text-xs" :class="darkMode ? 'text-orange-200/70' : 'text-white/70'">Equipment Rental</p>
                </div>
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <!-- Dashboard Section -->
            <div>
                <a
                    href="{{ route('user.dashboard') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.dashboard')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-50' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-100 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- Items Section -->
            <div>
                <p class="text-xs font-semibold px-4 py-2 uppercase" :class="darkMode ? 'text-orange-200/70' : 'text-white/70'">Browse</p>

                <a
                    href="{{ route('user.items.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="(isActive('user.items') && !isActive('user.items.show'))
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4v10" />
                    </svg>
                    <span>Browse Items</span>
                    <span class="ml-auto text-xs px-2 py-1 rounded-full" :class="darkMode ? 'bg-orange-950/30 text-orange-200' : 'bg-white/20 text-white'">New</span>
                </a>

                <a
                    href="{{ route('user.items.favorites') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.items.favorites')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>Favorites</span>
                </a>
            </div>

            <!-- Rentals Section -->
            <div>
                <p class="text-xs font-semibold px-4 py-2 uppercase" :class="darkMode ? 'text-orange-200/70' : 'text-white/70'">Rentals & Analytics</p>

                <a
                    href="{{ route('user.rentals.index') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.rentals.index')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Rentals</span>
                    <span class="ml-auto text-xs px-2 py-1 rounded-full" :class="darkMode ? 'bg-orange-950/30 text-orange-200' : 'bg-white/20 text-white'">{{ Auth::user()->rentals()->whereIn('status', ['pending', 'approved'])->count() }}</span>
                </a>

                <a
                    href="{{ route('user.rentals.history') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.rentals.history')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Rental History</span>
                </a>

                <a
                    href="{{ route('user.analytics') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.analytics')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Analytics</span>
                </a>

                <a
                    href="{{ route('user.financial') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.financial')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Financial</span>
                </a>

                <a
                    href="{{ route('user.reports') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.reports')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Reports</span>
                </a>

                <a
                    href="{{ route('user.queues') }}"
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                    :class="isActive('user.queues')
                        ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                        : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                    @click="sidebarOpen = false"
                >
                    <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span>Photobooth Queue</span>
                </a>
            </div>

            <!-- Admin Section -->
            @can('is-admin')
                <div class="border-t px-4 py-4 space-y-2" :class="darkMode ? 'border-orange-800/40' : 'border-white/20'">
                    <p class="text-xs font-semibold px-0 py-2 uppercase" :class="darkMode ? 'text-orange-200/70' : 'text-white/70'">Administration</p>

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.dashboard')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4" />
                        </svg>
                        <span>Admin Dashboard</span>
                    </a>

                    <a
                        href="{{ route('admin.items.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.items.*')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <span>Manage Items</span>
                    </a>

                    <a
                        href="{{ route('admin.rentals.index') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.rentals.*')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                        <span>Manage Rentals</span>
                    </a>

                    <a
                        href="{{ route('admin.analytics') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.analytics')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Analytics</span>
                    </a>

                    <a
                        href="{{ route('admin.financial') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.financial')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Financial</span>
                    </a>

                    <a
                        href="{{ route('admin.reports') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.reports')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Reports</span>
                    </a>

                    <a
                        href="{{ route('admin.photobooth') }}"
                        class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium transition-all duration-200"
                        :class="isActive('admin.photobooth')
                            ? (darkMode ? 'bg-orange-950/40 border-l-4 border-orange-300 text-orange-100' : 'bg-white/20 border-l-4 border-white text-white')
                            : (darkMode ? 'text-orange-50 hover:bg-orange-900/50' : 'text-white hover:bg-white/10')"
                        @click="sidebarOpen = false"
                    >
                        <svg class="w-5 h-5 flex-shrink-0" :class="darkMode ? 'text-orange-200' : 'text-white'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Photobooth</span>
                    </a>
                </div>
            @endcan
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 space-y-3" :class="darkMode ? 'border-t border-orange-800/40' : 'border-t border-white/20'">
            <!-- Trial Status Card -->
            <div class="p-3 rounded-lg bg-gradient-to-br shadow-sm" :class="darkMode 
                ? 'from-orange-950/40 to-orange-950/30 border border-orange-800/40' 
                : 'from-orange-100 via-orange-50 to-orange-50 border border-orange-200 hover:shadow-md transition-shadow'">
                <p class="text-xs font-semibold mb-1" :class="darkMode ? 'text-orange-200' : 'text-orange-700'">Trial Status</p>
                <p class="text-sm font-bold mb-2" :class="darkMode ? 'text-orange-50' : 'text-orange-900'">30 Days Free</p>
                <div class="w-full rounded-full h-2" :class="darkMode ? 'bg-orange-950/50' : 'bg-orange-200'">
                    <div class="bg-gradient-to-r from-orange-400 to-orange-500 h-2 rounded-full" style="width: 75%"></div>
                </div>
                <p class="text-xs mt-2" :class="darkMode ? 'text-orange-200/70' : 'text-orange-600/70'">22 days remaining</p>
            </div>

            <!-- Help Button -->
            <button
                class="w-full flex items-center justify-center space-x-2 px-4 py-2 rounded-lg font-medium text-sm transition-all duration-300 active:scale-95"
                :class="darkMode 
                    ? 'bg-orange-900/40 text-orange-100 hover:bg-orange-900/60 hover:shadow-lg border border-orange-800/40' 
                    : 'bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:shadow-lg hover:shadow-orange-500/50 hover:-translate-y-0.5 active:translate-y-0 border border-orange-600'"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Help & Support</span>
            </button>
        </div>
    </aside>
@endif

<script>
    function sidebarMenu(initialData = {}) {
        return {
            darkMode: false,
            sidebarOpen: false,
            currentRoute: initialData.currentRoute || '',
            
            init() {
                // Initialize dark mode from localStorage
                const theme = localStorage.getItem('theme') || 'light';
                this.darkMode = theme === 'dark';
                
                // Listen for theme changes
                window.addEventListener('theme-change', (e) => {
                    this.darkMode = e.detail === 'dark';
                });
            },
            
            isActive(routeName) {
                // Check if route matches exactly
                if (this.currentRoute === routeName) {
                    return true;
                }
                
                // Handle wildcard routes (e.g., 'user.items.*')
                if (routeName.includes('*')) {
                    const pattern = routeName.replace('*', '');
                    return this.currentRoute.startsWith(pattern.slice(0, -1));
                }
                
                // Handle complex patterns like 'user.items.* && !user.items.show'
                if (routeName.includes('&&')) {
                    const [positive, negative] = routeName.split('&&').map(r => r.trim());
                    const positivePattern = positive.replace('*', '');
                    const negativePattern = negative.replace('*', '').replace('!', '');
                    
                    return this.currentRoute.startsWith(positivePattern.slice(0, -1)) && 
                           !this.currentRoute.startsWith(negativePattern.slice(0, -1));
                }
                
                return false;
            }
        };
    }
</script>

