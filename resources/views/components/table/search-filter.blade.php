@props([
    'searchPlaceholder' => 'Search...',
    'hasFilters' => false,
])

<div class="flex flex-col sm:flex-row gap-4 mb-6">
    <!-- Search Bar -->
    <div class="flex-1 relative">
        <input
            type="text"
            placeholder="{{ $searchPlaceholder }}"
            {{ $attributes->merge(['class' => 'w-full px-4 py-2.5 pl-10 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-500']) }}
        />
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>

    <!-- Filter Button (Optional) -->
    @if ($hasFilters)
        <button
            type="button"
            class="px-4 py-2.5 rounded-lg bg-secondary dark:bg-neutral-800 text-neutral-900 dark:text-white hover:bg-tertiary dark:hover:bg-neutral-700 font-medium transition-colors duration-200 flex items-center gap-2 border border-neutral-200 dark:border-neutral-700"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filter
        </button>
    @endif

    <!-- Slot for Additional Actions -->
    @if ($slot->isNotEmpty())
        <div class="flex gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
