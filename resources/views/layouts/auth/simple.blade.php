<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body x-data="{dark: (localStorage.getItem('theme') || 'light') === 'dark'}"
    x-init="document.body.style.backgroundImage = dark ? 'url(/images/darkmode backgorund.png)' : 'url(/images/lightmode background.png)'"
    x-effect="document.body.style.backgroundImage = dark ? 'url(/images/darkmode backgorund.png)' : 'url(/images/lightmode background.png)'"
    class="min-h-screen antialiased bg-cover bg-center bg-no-repeat transition-colors duration-500 relative">
    <!-- Overlay for better contrast -->
    <div class="absolute inset-0 w-full h-full z-0 pointer-events-none">
        <div class="w-full h-full bg-white/80 dark:bg-[#161615]/90"></div>
    </div>
    <div class="fixed top-4 right-4 z-50">
        <button
            type="button"
            x-on:click="dark = !dark; localStorage.setItem('theme', dark ? 'dark' : 'light')"
            class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
            aria-label="Toggle theme"
        >
            <svg x-show="!dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
            <svg x-show="dark" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
        </button>
    </div>
    <div class="relative z-10 flex min-h-screen w-full items-center justify-center p-0">
        <div class="flex w-full max-w-5xl flex-col gap-2 lg:flex-row items-center justify-center min-h-screen py-12">
            @yield('content')
        </div>
    </div>
    @fluxScripts
</body>
</html>
