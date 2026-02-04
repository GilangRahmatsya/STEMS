<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Management</h1>
            <p class="text-gray-700 dark:text-neutral-400 mt-2">Manage application users and permissions</p>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Users Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 dark:text-gray-400 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-200 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a9 9 0 0118 0v2h2v-2a11 11 0 00-20 0v2h2v-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Admins Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-orange-50 to-orange-100 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 dark:text-gray-400 text-sm font-medium">Admins</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_admins'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-orange-200 dark:bg-orange-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Regular Users Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-green-50 to-green-100 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 dark:text-gray-400 text-sm font-medium">Regular Users</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_regular_users'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-200 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- KTP Verified Card -->
        <div class="p-6 rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 dark:bg-gradient-to-br dark:from-gray-800 dark:to-gray-700 border border-neutral-200 dark:border-gray-600 shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-700 dark:text-gray-400 text-sm font-medium">KTP Verified</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['ktp_verified'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-purple-200 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <x-table.search-filter
        wire:model.live.debounce-500="search"
        searchPlaceholder="Search users by name, email, or phone..."
        hasFilters
    >
        <select
            wire:model.live="role"
            class="px-4 py-2.5 rounded-lg border border-neutral-300 dark:border-gray-600 bg-neutral-50 dark:bg-gray-800 text-neutral-900 dark:text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500"
        >
            <option value="">All Roles</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </x-table.search-filter>

    <!-- Users Table -->
    <div class="rounded-lg border border-neutral-200 dark:border-gray-600 shadow-md overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-secondary dark:bg-gray-700 border-b border-neutral-200 dark:border-gray-600">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">User</th>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">Email</th>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">Phone</th>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">Role</th>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">KTP Status</th>
                    <th class="px-6 py-3 text-left font-semibold text-neutral-900 dark:text-white">Joined</th>
                    <th class="px-6 py-3 text-right font-semibold text-neutral-900 dark:text-white">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-gray-600">
                @forelse ($users as $user)
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img
                                    src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff"
                                    alt="{{ $user->name }}"
                                    class="w-10 h-10 rounded-full ring-2 ring-primary-400 dark:ring-primary-600"
                                >
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                                    <p class="text-xs text-secondary dark:text-gray-500">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-secondary dark:text-gray-400">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-secondary dark:text-gray-400">{{ $user->phone ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if ($user->role === 'admin')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-orange-100 to-orange-50 dark:from-orange-900/30 dark:to-orange-800/20 text-orange-700 dark:text-orange-300 border border-orange-200 dark:border-orange-800/50">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 dark:bg-gray-700 text-neutral-700 dark:text-gray-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                    User
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->ktp_verified_at)
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-success-100 dark:bg-success-900/20 text-success-700 dark:text-success-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    Verified
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-warning-100 dark:bg-warning-900/20 text-warning-700 dark:text-warning-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-secondary dark:text-gray-400">
                            {{ $user->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <x-table.action-button
                                    href="{{ route('admin.users.show', $user->id) }}"
                                    type="primary"
                                    label="View"
                                    icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>'
                                />

                                <x-table.action-button
                                    href="{{ route('admin.users.edit', $user->id) }}"
                                    type="secondary"
                                    label="Edit"
                                    icon='<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'
                                />

                                @if ($user->role === 'admin')
                                    <button
                                        wire:click="revokeAdmin({{ $user->id }})"
                                        wire:confirm="Are you sure you want to revoke admin privileges from this user?"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-200 hover:shadow-lg active:scale-95"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3V9h3V7h-3V4h-2v3h-3v2h3v4zm-6 6h-2v-2h2v2zm0-4h-2v-2h2v2zm0-4h-2V7h2v4zm4 12h-2v-2h2v2zm0-4h-2v-2h2v2z" />
                                        </svg>
                                        Revoke Admin
                                    </button>
                                @else
                                    <button
                                        wire:click="grantAdmin({{ $user->id }})"
                                        wire:confirm="Are you sure you want to grant admin privileges to this user?"
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg font-medium text-sm transition-all duration-200 bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:shadow-lg active:scale-95"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                        </svg>
                                        Grant Admin
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-neutral-400 dark:text-gray-600 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a9 9 0 0118 0v2h2v-2a11 11 0 00-20 0v2h2v-2z" />
                                </svg>
                                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-1">No Users Found</h3>
                                <p class="text-sm text-neutral-600 dark:text-gray-400">
                                    Try adjusting your search or filter criteria
                                </p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <x-table.pagination :paginator="$users" />
</div>
