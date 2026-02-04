@props([
    'name',
    'label' => '',
    'options' => [],
    'value' => '',
    'helper' => '',
    'error' => '',
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Select an option...',
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

    <select
        id="{{ $name }}"
        name="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        class="w-full px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 text-neutral-900 dark:text-white placeholder-neutral-500 dark:placeholder-neutral-400 transition-all duration-200 appearance-none focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent cursor-pointer {{ $error ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500' }} {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
        style="background-image: url('data:image/svg+xml;utf8,<svg fill=\'none\' height=\'24\' viewBox=\'0 0 24 24\' width=\'24\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M7 10l5 5 5-5z\' fill=\'%23666\'/></svg>'); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
        {{ $attributes }}
    >
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ $value == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>

    @if ($error)
        <p class="mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $error }}</p>
    @elseif ($helper)
        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
    @endif
</div>
