<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="STEMS - Swiper Tools & Equipment Management System. Easy equipment rental and management platform.">
    <title>STEMS - Equipment Rental Management System</title>
    <link rel="icon" type="image/png" href="/images/stems-logo.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary text-primary antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800 backdrop-blur-sm bg-opacity-80 dark:bg-opacity-80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <img src="/images/stems-logo.png" alt="STEMS" class="h-8 w-8">
                    <span class="text-xl font-bold hidden sm:inline">STEMS</span>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="#features" class="text-secondary hover:text-primary transition-colors">Features</a>
                    <a href="#pricing" class="text-secondary hover:text-primary transition-colors">Pricing</a>
                    <a href="#contact" class="text-secondary hover:text-primary transition-colors">Contact</a>
                </div>

                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-dark transition-colors">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-secondary hover:text-primary transition-colors">Sign In</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg bg-primary text-white hover:bg-primary-dark transition-colors">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <img src="/images/stems-logo.png" alt="STEMS" class="h-20 w-20 mx-auto mb-6">

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6">
                STEMS
            </h1>

            <p class="text-xl sm:text-2xl text-secondary mb-6">
                Swiper Tools & Equipment Management System
            </p>

            <p class="text-lg text-secondary max-w-2xl mx-auto mb-10">
                Simplify your equipment rental process with our modern, easy-to-use platform. Browse, rent, and manage tools with confidence.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                @auth
                    <a href="{{ route('user.items.index') }}" class="px-8 py-3 rounded-lg bg-primary text-white font-semibold hover:bg-primary-dark transition-colors">
                        Browse Items
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-3 rounded-lg bg-primary text-white font-semibold hover:bg-primary-dark transition-colors">
                        Start Your 30-Day Trial
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-3 rounded-lg border-2 border-primary text-primary hover:bg-secondary dark:hover:bg-neutral-800 transition-colors">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8 bg-secondary dark:bg-neutral-900">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center mb-12">Why Choose STEMS?</h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-lg bg-primary border border-neutral-200 dark:border-neutral-800">
                    <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Fast & Easy</h3>
                    <p class="text-secondary">Rent equipment in just a few clicks with our intuitive interface.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-lg bg-primary border border-neutral-200 dark:border-neutral-800">
                    <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Affordable Pricing</h3>
                    <p class="text-secondary">Transparent pricing with no hidden fees. Get value for your money.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-lg bg-primary border border-neutral-200 dark:border-neutral-800">
                    <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Reliable Service</h3>
                    <p class="text-secondary">Trust us to provide quality equipment and excellent customer support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

    @livewireScripts
</body>
</html>
