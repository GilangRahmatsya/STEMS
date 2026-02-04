@props([
    'name',
    'options' => [],
    'label' => '',
    'value' => '',
    'helper' => '',
    'error' => '',
    'required' => false,
    'disabled' => false,
])

<div class="space-y-2">
    @if ($label)
        <label class="block text-sm font-semibold text-neutral-900 dark:text-white">
            {{ $label }}
            @if ($required)
                <span class="text-danger-600 dark:text-danger-400">*</span>
            @endif
        </label>
    @endif

    <div class="space-y-2">
        @foreach ($options as $optionValue => $optionLabel)
            <div class="flex items-center">
                <input
                    type="radio"
                    id="{{ $name }}-{{ $optionValue }}"
                    name="{{ $name }}"
                    value="{{ $optionValue }}"
                    {{ $value == $optionValue ? 'checked' : '' }}
                    {{ $disabled ? 'disabled' : '' }}
                    class="w-4 h-4 border-neutral-300 dark:border-neutral-700 text-primary-600 dark:text-primary-500 bg-neutral-50 dark:bg-neutral-800 focus:ring-2 focus:ring-primary-500 dark:focus:ring-primary-400 cursor-pointer transition-colors duration-200 {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $attributes }}
                />
                <label for="{{ $name }}-{{ $optionValue }}" class="ml-3 text-sm font-medium text-neutral-900 dark:text-white cursor-pointer">
                    {{ $optionLabel }}
                </label>
            </div>
        @endforeach
    </div>

    @if ($error)
        <p class="text-sm text-danger-600 dark:text-danger-400 font-medium">{{ $error }}</p>
    @elseif ($helper)
        <p class="text-xs text-neutral-600 dark:text-neutral-400">{{ $helper }}</p>
    @endif
</div>
