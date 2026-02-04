@props([
    'href' => '#',
    'type' => 'primary',
    'icon' => null,
    'label' => '',
    'method' => 'GET',
    'confirm' => false,
    'confirmMessage' => 'Are you sure?',
])

@php
    $classes = match($type) {
        'primary' => 'text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 hover:bg-primary-50 dark:hover:bg-primary-900/20',
        'secondary' => 'text-secondary-600 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-secondary-300 hover:bg-secondary-50 dark:hover:bg-secondary-900/20',
        'danger' => 'text-danger-600 dark:text-danger-400 hover:text-danger-700 dark:hover:text-danger-300 hover:bg-danger-50 dark:hover:bg-danger-900/20',
        'warning' => 'text-warning-600 dark:text-warning-400 hover:text-warning-700 dark:hover:text-warning-300 hover:bg-warning-50 dark:hover:bg-warning-900/20',
        default => 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800',
    };
@endphp

@if ($method === 'GET')
    <a
        href="{{ $href }}"
        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg font-medium text-sm transition-all duration-200 {{ $classes }}"
        {{ $attributes }}
    >
        @if ($icon)
            {!! $icon !!}
        @endif
        @if ($label)
            <span>{{ $label }}</span>
        @endif
    </a>
@else
    <form
        action="{{ $href }}"
        method="POST"
        class="inline"
        @if ($confirm)
            onsubmit="return confirm('{{ $confirmMessage }}');"
        @endif
    >
        @csrf
        @method($method)
        <button
            type="submit"
            class="inline-flex items-center gap-2 px-3 py-2 rounded-lg font-medium text-sm transition-all duration-200 {{ $classes }}"
            {{ $attributes }}
        >
            @if ($icon)
                {!! $icon !!}
            @endif
            @if ($label)
                <span>{{ $label }}</span>
            @endif
        </button>
    </form>
@endif
