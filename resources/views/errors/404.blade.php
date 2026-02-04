<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | STEMS</title>
    <link rel="icon" type="image/png" href="/images/stems-logo.png">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-primary text-primary antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-md">
            <!-- Logo -->
            <img src="/images/stems-logo.png" alt="STEMS" class="h-16 w-16 mx-auto mb-6">

            <!-- Error Code -->
            <h1 class="text-6xl sm:text-7xl font-bold text-primary mb-4">404</h1>

            <!-- Error Message -->
            <h2 class="text-2xl sm:text-3xl font-bold text-primary mb-4">
                Page Not Found
            </h2>

            <p class="text-secondary mb-8">
                Sorry, the page you're looking for doesn't exist or has been moved. Please check the URL and try again.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="{{ route('user.dashboard') }}"
                    class="px-6 py-3 rounded-lg bg-primary text-white font-semibold hover:bg-primary-dark transition-colors"
                >
                    Go to Dashboard
                </a>
                <a
                    href="{{ url('/') }}"
                    class="px-6 py-3 rounded-lg border border-neutral-300 dark:border-neutral-700 text-primary hover:bg-secondary dark:hover:bg-neutral-800 transition-colors"
                >
                    Go Home
                </a>
            </div>

            <!-- Illustration -->
            <div class="mt-12 opacity-50">
                <svg class="w-64 h-64 mx-auto" viewBox="0 0 200 200" fill="none">
                    <circle cx="100" cy="100" r="90" stroke="currentColor" stroke-width="2"/>
                    <text x="100" y="110" text-anchor="middle" font-size="60" font-weight="bold" fill="currentColor">?</text>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>
