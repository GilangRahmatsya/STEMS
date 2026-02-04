@props([
    'name',
    'label' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'helper' => '',
    'error' => '',
    'required' => false,
    'disabled' => false,
    'icon' => null,
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

    <div class="relative">
        @if ($icon)
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-neutral-600 dark:text-neutral-400">
                {!! $icon !!}
            </div>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            value="{{ $value }}"
            {{ $disabled ? 'disabled' : '' }}
            {{ $required ? 'required' : '' }}
            class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent {{ $error ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} {{ $icon ? 'pl-11' : '' }} {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
            {{ $attributes }}
        />
    </div>

    @if ($error)
        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $error }}</p>
    @elseif ($helper)
        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
    @endif
</div>
