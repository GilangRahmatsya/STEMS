@props([
    'title' => '',
    'description' => '',
    'submit' => 'Submit',
    'method' => 'POST',
    'action' => '',
])

<div class="card">
    @if ($title)
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-primary dark:text-white">{{ $title }}</h2>
            @if ($description)
                <p class="mt-2 text-secondary dark:text-neutral-400">{{ $description }}</p>
            @endif
        </div>
    @endif

    <form method="{{ strtolower($method) }}" action="{{ $action }}" class="space-y-6">
        @csrf
        @if (strtoupper($method) !== 'GET')
            @method($method)
        @endif

        <!-- Form Fields -->
        <div class="space-y-6">
            {{ $slot }}
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-neutral-200 dark:border-neutral-800">
            <button
                type="submit"
                class="px-6 py-2.5 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 focus:ring-primary-500 disabled:opacity-50 disabled:cursor-not-allowed shadow-md hover:shadow-lg border border-primary-700 dark:border-primary-800"
            >
                {{ $submit }}
            </button>

            <a
                href="{{ url()->previous() }}"
                class="px-6 py-2.5 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-700 font-semibold transition-all duration-200 text-center border border-neutral-300 dark:border-neutral-700 shadow-md hover:shadow-lg"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
