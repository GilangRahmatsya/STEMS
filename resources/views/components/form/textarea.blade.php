@props([
    'name',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'helper' => '',
    'error' => '',
    'required' => false,
    'disabled' => false,
    'rows' => 4,
])

<div class="space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-neutral-900 dark:text-white">
            {{ $label }}
            @if ($required)
                <span class="text-danger-600 dark:text-danger-400">*</span>
            @endif
        </label>
    @endif

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 transition-all duration-200 resize-vertical focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $error ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        {{ $attributes }}
    >{{ $value }}</textarea>

    @if ($error)
        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $error }}</p>
    @elseif ($helper)
        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
    @endif
</div>
