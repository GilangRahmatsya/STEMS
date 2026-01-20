<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

<flux:sidebar sticky collapsible="mobile"
    class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 flex flex-col min-h-screen">

    {{-- HEADER --}}
    <flux:sidebar.header class="flex-shrink-0">
        <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>

    {{-- NAVIGATION --}}
    <flux:sidebar.nav class="flex-1">

        {{-- PLATFORM --}}
        <flux:sidebar.group heading="Platform">
            <flux:sidebar.item
                icon="home"
                :href="route('dashboard')"
                :current="request()->routeIs('dashboard')"
                wire:navigate
            >
                Dashboard
            </flux:sidebar.item>
        </flux:sidebar.group>

        {{-- ITEMS --}}
        <flux:sidebar.group heading="Items">
            <flux:sidebar.item
                icon="cube"
                :href="route('user.items.index')"
                :current="request()->routeIs('user.items.index')"
                wire:navigate
            >
                Browse Items
            </flux:sidebar.item>

            @can('is-admin')
                <flux:sidebar.item
                    icon="cog-6-tooth"
                    :href="route('admin.items')"
                    :current="request()->routeIs('admin.items')"
                    wire:navigate
                >
                    Manage Items
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="exclamation-triangle"
                    :href="route('admin.damaged-items')"
                    :current="request()->routeIs('admin.damaged-items')"
                    wire:navigate
                >
                    Damaged Items
                </flux:sidebar.item>
            @endcan
        </flux:sidebar.group>

        {{-- RENTALS --}}
        <flux:sidebar.group heading="Rentals">
            <flux:sidebar.item
                icon="clipboard-document-list"
                :href="route('user.rentals.index')"
                :current="request()->routeIs('user.rentals.*')"
                wire:navigate
            >
                My Rentals
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="shopping-cart"
                :href="route('user.rentals.create')"
                :current="request()->routeIs('user.rentals.create')"
                wire:navigate
            >
                Create Rental
            </flux:sidebar.item>

            @can('is-admin')
                <flux:sidebar.item
                    icon="clipboard-document-check"
                    :href="route('admin.rentals')"
                    :current="request()->routeIs('admin.rentals')"
                    wire:navigate
                >
                    Manage Rentals
                </flux:sidebar.item>
            @endcan
        </flux:sidebar.group>

        {{-- REPORTS & ANALYTICS --}}
        <flux:sidebar.group heading="Business Intelligence">
            <flux:sidebar.item
                icon="document-chart-bar"
                :href="route('user.reports')"
                :current="request()->routeIs('user.reports')"
                wire:navigate
            >
                Reports
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="chart-bar"
                :href="route('user.analytics')"
                :current="request()->routeIs('user.analytics')"
                wire:navigate
            >
                Analytics
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="queue-list"
                :href="route('user.queues')"
                :current="request()->routeIs('user.queues')"
                wire:navigate
            >
                Queues
            </flux:sidebar.item>
        </flux:sidebar.group>

        {{-- FINANCIAL --}}
        <flux:sidebar.group heading="Financial">
            <flux:sidebar.item
                icon="currency-dollar"
                :href="route('user.financial')"
                :current="request()->routeIs('user.financial')"
                wire:navigate
            >
                Financial Overview
            </flux:sidebar.item>

            @can('is-admin')
                <flux:sidebar.item
                    icon="currency-dollar"
                    :href="route('admin.financial')"
                    :current="request()->routeIs('admin.financial')"
                    wire:navigate
                >
                    Financial Records
                </flux:sidebar.item>
            @endcan
        </flux:sidebar.group>

        {{-- ADMIN ONLY --}}
        @can('is-admin')
            <flux:sidebar.group heading="Admin">
                {{-- <flux:sidebar.item
                    icon="users"
                    href="#"
                    wire:navigate
                >
                    Users
                </flux:sidebar.item> --}}

                <flux:sidebar.item
                    icon="document-chart-bar"
                    :href="route('admin.reports')"
                    :current="request()->routeIs('admin.reports')"
                    wire:navigate
                >
                    Admin Reports
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="chart-bar"
                    :href="route('admin.analytics')"
                    :current="request()->routeIs('admin.analytics')"
                    wire:navigate
                >
                    Admin Analytics
                </flux:sidebar.item>

                <flux:sidebar.item
                    icon="photo"
                    :href="route('admin.photobooth')"
                    :current="request()->routeIs('admin.photobooth')"
                    wire:navigate
                >
                    Photobooth
                </flux:sidebar.item>
            </flux:sidebar.group>
        @endcan

    </flux:sidebar.nav>

    {{-- USER MENU DESKTOP - FIXED BOTTOM --}}
    @auth
        <div class="mt-auto pt-4 border-t border-zinc-200 dark:border-zinc-700">
            <x-desktop-user-menu
                class="hidden lg:block transform transition-all duration-200 hover:scale-105 active:scale-95"
                :name="auth()->user()->name"
            />
        </div>
    @endauth

</flux:sidebar>

{{-- MOBILE HEADER --}}
<flux:header class="lg:hidden">
    <flux:sidebar.toggle icon="bars-2" inset="left" />
    <flux:spacer />

    @auth
        <flux:dropdown position="top" align="end">
            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>
                <flux:menu.item :href="route('profile.edit')" wire:navigate>
                    Settings
                </flux:menu.item>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit">
                        Log Out
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    @endauth
</flux:header>

{{ $slot }}

{{-- Global Loading Overlay --}}
<x-loading-overlay wire:loading />

@fluxScripts
</body>
</html>