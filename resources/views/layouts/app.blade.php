<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">
    <title>{{ isset($title) ? $title . ' - STEMS' : 'STEMS - Equipment Rental Management' }}</title>
    <link rel="icon" type="image/png" href="/images/stems-logo-dark.png">
    
    {{-- CRITICAL: Apply theme BEFORE page renders to prevent FOUC --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body
    class="bg-gray-50 dark:bg-gradient-to-br dark:from-gray-600 dark:via-gray-700 dark:to-gray-800 text-primary dark:text-white antialiased transition-colors duration-300 overflow-hidden"
    x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    x-cloak
>
    <!-- Sidebar: Fixed, Independent Scroll -->
    @include('layouts.sidebar')
    
    <!-- Main Content Area: Independent Scroll -->
    <div class="ml-64 h-screen overflow-y-auto bg-gray-50 dark:bg-transparent scrollbar-thin flex flex-col">
        <!-- Navigation/Topbar: Sticky -->
        @include('layouts.navigation')

        <!-- Page Content: Scrollable -->
        <main class="flex-1 bg-gray-50 dark:bg-transparent animate-fadeIn">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-success-50 dark:bg-success-900/20 border border-success-200 dark:border-success-800 shadow-md animate-fade-in">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-success-600 dark:text-success-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-success-700 dark:text-success-300">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800 shadow-md animate-fade-in">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-danger-600 dark:text-danger-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-danger-700 dark:text-danger-300">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                {{ $slot }}
            </div>
        </main>
        
        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @livewireScripts
    
    {{-- Load Agentation Lite for development --}}
    @vite('resources/js/agentation-lite.js')
    
    {{-- Smooth page transitions with Livewire --}}
    <script>
        // Smooth transition on Livewire navigation
        document.addEventListener('livewire:navigating', () => {
            const main = document.querySelector('main');
            if (main) main.style.opacity = '0.7';
        });
        
        document.addEventListener('livewire:navigated', () => {
            const main = document.querySelector('main');
            if (main) main.style.opacity = '1';
        });
    </script>
</body>
</html>
