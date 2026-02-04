@props([
    'name',
    'label' => '',
    'value' => '1',
    'checked' => false,
    'helper' => '',
    'disabled' => false,
])

<div class="flex items-start">
    <div class="flex items-center h-5">
        <input
            type="checkbox"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-700 text-primary-600 dark:text-primary-500 bg-neutral-50 dark:bg-neutral-800 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 cursor-pointer transition-colors duration-200 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            {{ $attributes }}
        />
    </div>

    @if ($label)
        <div class="ml-3">
            <label for="{{ $name }}" class="text-sm font-medium text-neutral-900 dark:text-white cursor-pointer">
                {{ $label }}
            </label>
            @if ($helper)
                <p class="mt-0.5 text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
            @endif
        </div>
    @endif
</div>
