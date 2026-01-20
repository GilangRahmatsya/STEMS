@props([
    'size' => 'md',
    'color' => 'blue',
    'message' => null
])

@php
    $sizeClasses = [
        'xs' => 'h-4 w-4 border-2',
        'sm' => 'h-6 w-6 border-2',
        'md' => 'h-8 w-8 border-4',
        'lg' => 'h-12 w-12 border-4',
        'xl' => 'h-16 w-16 border-6',
    ];

    $colorClasses = [
        'blue' => 'border-gray-300 border-t-blue-600 dark:border-gray-600 dark:border-t-blue-400',
        'green' => 'border-gray-300 border-t-green-600 dark:border-gray-600 dark:border-t-green-400',
        'red' => 'border-gray-300 border-t-red-600 dark:border-gray-600 dark:border-t-red-400',
        'yellow' => 'border-gray-300 border-t-yellow-600 dark:border-gray-600 dark:border-t-yellow-400',
        'purple' => 'border-gray-300 border-t-purple-600 dark:border-gray-600 dark:border-t-purple-400',
        'gray' => 'border-gray-400 border-t-gray-600 dark:border-gray-500 dark:border-t-gray-300',
    ];

    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $colorClass = $colorClasses[$color] ?? $colorClasses['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center space-y-2']) }}>
    <div class="animate-spin rounded-full {{ $sizeClass }} {{ $colorClass }}"></div>

    @if($message)
        <p class="text-sm text-gray-600 dark:text-gray-400 animate-pulse">
            {{ $message }}
        </p>
    @endif
</div>