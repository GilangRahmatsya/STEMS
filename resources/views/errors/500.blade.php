<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - Server Error | STEMS</title>
    <link rel="icon" type="image/png" href="/images/stems-logo.png">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-primary dark:bg-neutral-950 text-primary dark:text-white antialiased">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl">
            <!-- Logo -->
            <img src="/images/stems-logo.png" alt="STEMS" class="h-16 w-16 mx-auto mb-6">

            <!-- Error Code -->
            <h1 class="text-6xl sm:text-7xl font-bold text-danger-600 dark:text-danger-400 mb-4">500</h1>

            <!-- Error Message -->
            <h2 class="text-2xl sm:text-3xl font-bold text-primary dark:text-white mb-4">
                Server Error
            </h2>

            <p class="text-lg text-secondary dark:text-neutral-400 mb-8">
                Something went wrong on our end. Our team has been notified and is working to fix it.
            </p>

            <!-- Error Details (Development Only) -->
            @if (app()->isLocal() && isset($exception))
                <div class="mb-8 p-6 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800 text-left">
                    <h3 class="text-lg font-bold text-danger-900 dark:text-danger-100 mb-3">Debug Information</h3>
                    
                    <!-- Exception Type -->
                    <div class="mb-4 p-3 rounded bg-neutral-100 dark:bg-neutral-800">
                        <p class="text-xs font-semibold text-secondary dark:text-neutral-400 mb-1">Exception Type:</p>
                        <p class="text-sm font-mono text-danger-700 dark:text-danger-300">
                            {{ class_basename($exception::class) }}
                        </p>
                    </div>

                    <!-- Exception Message -->
                    <div class="mb-4 p-3 rounded bg-neutral-100 dark:bg-neutral-800">
                        <p class="text-xs font-semibold text-secondary dark:text-neutral-400 mb-1">Message:</p>
                        <p class="text-sm font-mono text-danger-700 dark:text-danger-300 break-words">
                            {{ $exception->getMessage() ?? 'No message provided' }}
                        </p>
                    </div>

                    <!-- File and Line -->
                    <div class="mb-4 p-3 rounded bg-neutral-100 dark:bg-neutral-800">
                        <p class="text-xs font-semibold text-secondary dark:text-neutral-400 mb-1">Location:</p>
                        <p class="text-sm font-mono text-danger-700 dark:text-danger-300 break-words">
                            {{ $exception->getFile() }} (Line {{ $exception->getLine() }})
                        </p>
                    </div>

                    <!-- Stack Trace -->
                    <details class="text-left">
                        <summary class="cursor-pointer text-sm font-semibold text-danger-700 dark:text-danger-300 hover:text-danger-800 dark:hover:text-danger-200">
                            Stack Trace
                        </summary>
                        <div class="mt-3 p-3 rounded bg-neutral-100 dark:bg-neutral-800 overflow-auto max-h-64">
                            <code class="text-xs font-mono text-danger-700 dark:text-danger-300 whitespace-pre-wrap break-words">{{ $exception->getTraceAsString() }}</code>
                        </div>
                    </details>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="{{ route('user.dashboard') }}"
                    class="px-6 py-3 rounded-lg bg-primary dark:bg-primary-700 text-white font-semibold hover:bg-primary-dark dark:hover:bg-primary-800 transition-colors"
                >
                    Go to Dashboard
                </a>
                <a
                    href="{{ url('/') }}"
                    class="px-6 py-3 rounded-lg border-2 border-neutral-300 dark:border-neutral-700 text-primary dark:text-white hover:bg-secondary dark:hover:bg-neutral-800 transition-colors font-semibold"
                >
                    Go Home
                </a>
            </div>

            <!-- Support Message -->
            <div class="mt-12 p-6 rounded-lg bg-secondary dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700">
                <h3 class="font-semibold text-primary dark:text-white mb-2">Need Help?</h3>
                <p class="text-sm text-secondary dark:text-neutral-400 mb-3">
                    If this error persists, please contact our support team.
                </p>
                <div class="flex flex-col sm:flex-row gap-2 justify-center">
                    <a href="mailto:support@stems.local" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                        Email Support
                    </a>
                    <span class="text-neutral-400 dark:text-neutral-600">•</span>
                    <a href="#" class="text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 font-medium">
                        View Status
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
