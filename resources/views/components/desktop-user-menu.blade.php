<flux:dropdown position="bottom" align="start" class="w-full">
    <flux:sidebar.profile
        {{ $attributes->only('name') }}
        :initials="auth()->user()->initials()"
        icon:trailing="chevrons-up-down"
        data-test="sidebar-menu-button"
        class="w-full transition-all duration-200 hover:scale-[1.02] hover:shadow-md active:scale-[0.98] cursor-pointer"
    />

    <flux:menu class="w-64">
        <div class="flex items-center gap-3 px-3 py-2 text-start text-sm border-b border-zinc-200 dark:border-zinc-700">
            <flux:avatar
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                class="ring-2 ring-zinc-200 dark:ring-zinc-700"
            />
            <div class="grid flex-1 text-start text-sm leading-tight">
                <flux:heading class="truncate font-medium">{{ auth()->user()->name }}</flux:heading>
                <flux:text class="truncate text-zinc-500 dark:text-zinc-400">{{ auth()->user()->email }}</flux:text>
            </div>
        </div>
        <flux:menu.separator />
        <flux:menu.radio.group>
            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate
                class="transition-all duration-150 hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:scale-[1.01]">
                {{ __('Settings') }}
            </flux:menu.item>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item
                    as="button"
                    type="submit"
                    icon="arrow-right-start-on-rectangle"
                    class="w-full cursor-pointer transition-all duration-150 hover:bg-red-50 dark:hover:bg-red-900/20 hover:scale-[1.01] hover:text-red-600 dark:hover:text-red-400"
                    data-test="logout-button"
                >
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu.radio.group>
    </flux:menu>
</flux:dropdown>
