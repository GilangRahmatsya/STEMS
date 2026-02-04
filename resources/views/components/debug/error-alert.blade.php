@props([
    'title' => 'Error',
    'message' => '',
    'code' => null,
    'dismissible' => true,
])

<div class="p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20 border border-danger-200 dark:border-danger-800 shadow-md" role="alert">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="w-5 h-5 text-danger-600 dark:text-danger-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3 flex-1">
            <h3 class="text-sm font-medium text-danger-800 dark:text-danger-100">{{ $title }}</h3>
            <div class="mt-2 text-sm text-danger-700 dark:text-danger-200">
                {{ $message }}
                @if ($code)
                    <code class="block mt-2 p-2 rounded bg-danger-100 dark:bg-danger-800/50 font-mono text-xs">
                        {{ $code }}
                    </code>
                @endif
            </div>
        </div>
        @if ($dismissible)
            <button
                type="button"
                @click="$el.closest('[role=alert]').remove()"
                class="ml-3 text-danger-600 dark:text-danger-400 hover:text-danger-700 dark:hover:text-danger-300"
            >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif
    </div>
</div>
