@props([
    'paginator',
    'totalItems' => 0,
])

@if ($paginator && $paginator->hasPages())
    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <!-- Results Info -->
        <div class="text-sm text-neutral-600 dark:text-gray-400">
            Showing <span class="font-semibold text-neutral-900 dark:text-white">{{ $paginator->firstItem() }}</span>
            to <span class="font-semibold text-neutral-900 dark:text-white">{{ $paginator->lastItem() }}</span>
            of <span class="font-semibold text-neutral-900 dark:text-white">{{ $paginator->total() }}</span> results
        </div>

        <!-- Pagination Links -->
        <div class="flex items-center gap-2">
            <!-- Previous Button -->
            <a
                href="{{ $paginator->previousPageUrl() }}"
                {{ !$paginator->onFirstPage() ? '' : 'disabled' }}
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>

            <!-- Page Numbers -->
            <div class="flex items-center gap-1">
                @foreach ($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
                    <a
                        href="{{ $url }}"
                        class="px-3 py-2 rounded-lg border transition-colors duration-200 text-sm font-medium {{ $page === $paginator->currentPage() ? 'bg-blue-600 dark:bg-blue-600 text-white border-blue-600 dark:border-blue-600 hover:bg-blue-700 dark:hover:bg-blue-700' : 'border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                    >
                        {{ $page }}
                    </a>
                @endforeach
            </div>

            <!-- Next Button -->
            <a
                href="{{ $paginator->nextPageUrl() }}"
                {{ $paginator->hasMorePages() ? '' : 'disabled' }}
                class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
@endif
