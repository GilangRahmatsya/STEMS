@props([
    'show' => false,
    'message' => 'Loading...',
    'backdrop' => true,
    'size' => 'md'
])

@if($show)
<div
    x-data="{ show: @entangle($attributes->wire('model')) }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @if($backdrop)
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    @else
        class="absolute inset-0 z-10 flex items-center justify-center bg-white bg-opacity-75 dark:bg-zinc-900 dark:bg-opacity-75"
    @endif
>
    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-xl p-6 max-w-sm w-full mx-4">
        <div class="flex flex-col items-center space-y-4">
            <x-loading-spinner :size="$size" class="text-blue-600" />

            <p class="text-center text-gray-600 dark:text-gray-300 font-medium">
                {{ $message }}
            </p>
        </div>
    </div>
</div>
@endif