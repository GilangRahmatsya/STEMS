@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="STEMS" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/images/stems-logo.png" alt="STEMS Logo" class="size-7" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="STEMS" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <img src="/images/stems-logo.png" alt="STEMS Logo" class="size-7" />
        </x-slot>
    </flux:brand>
@endif
