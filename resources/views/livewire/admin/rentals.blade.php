<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Manage Rentals</h1>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Status</label>
        <select wire:model.live="statusFilter" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="all">All</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse ($rentals as $rental)
            <div class="border rounded-lg p-4 bg-white dark:bg-zinc-900">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $rental->item->name }}</h2>
                        <p class="text-sm text-zinc-500">Rented by: {{ $rental->user->name }} ({{ $rental->user->email }})</p>
                        <p class="text-sm text-zinc-500">
                            Period: {{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}
                        </p>
                        <p class="text-sm text-zinc-500">
                            Total: Rp {{ number_format($rental->total_price) }}
                        </p>
                        @if($rental->notes)
                            <p class="text-sm text-zinc-500">Notes: {{ $rental->notes }}</p>
                        @endif
                    </div>

                    {{-- Borrower Information --}}
                    @if($rental->borrower_name)
                    <div class="mt-4 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                        <h3 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">Borrower Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm">
                            <p><strong>Name:</strong> {{ $rental->borrower_name }}</p>
                            <p><strong>Date of Birth:</strong> {{ $rental->borrower_birth_date ? $rental->borrower_birth_date->format('d M Y') : 'Not provided' }}</p>
                        </div>
                        @if($rental->purpose)
                            <p class="mt-2"><strong>Purpose:</strong> {{ $rental->purpose }}</p>
                        @endif
                    </div>
                    @endif

                    {{-- KTP Information --}}
                    @if($rental->ktp_notes)
                    <div class="mt-2 bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded-lg">
                        <h3 class="font-semibold text-yellow-800 dark:text-yellow-200 mb-2">KTP Information</h3>
                        <p class="text-sm">{{ $rental->ktp_notes }}</p>
                    </div>
                    @endif

                    {{-- Status Management --}}
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        {{-- Payment Status --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Payment</label>
                            <select wire:change="updatePaymentStatus({{ $rental->id }}, $event.target.value)" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="unpaid" {{ $rental->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                <option value="paid" {{ $rental->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        {{-- Pickup Status --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Pickup</label>
                            <select wire:change="updatePickupStatus({{ $rental->id }}, $event.target.value)" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="not_picked_up" {{ $rental->pickup_status == 'not_picked_up' ? 'selected' : '' }}>Not Picked Up</option>
                                <option value="picked_up" {{ $rental->pickup_status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            </select>
                        </div>

                        {{-- Return Status --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Return</label>
                            <select wire:change="updateReturnStatus({{ $rental->id }}, $event.target.value)"
                                    wire:confirm="Are you sure you want to mark '{{ $rental->item->name }}' as returned? This will update the inventory status."
                                    class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="not_returned" {{ $rental->return_status == 'not_returned' ? 'selected' : '' }}>Not Returned</option>
                                <option value="returned" {{ $rental->return_status == 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                        </div>

                        {{-- KTP Status --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">KTP</label>
                            <select wire:change="updateKtpStatus({{ $rental->id }}, $event.target.value)" class="w-full text-xs border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="not_received" {{ $rental->ktp_status == 'not_received' ? 'selected' : '' }}>Not Received</option>
                                <option value="received" {{ $rental->ktp_status == 'received' ? 'selected' : '' }}>Received</option>
                                <option value="returned" {{ $rental->ktp_status == 'returned' ? 'selected' : '' }}>Returned</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <p class="text-sm mb-2">Status: <span class="capitalize font-semibold
                            {{ $rental->status == 'approved' ? 'text-green-600' : ($rental->status == 'pending' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $rental->status }}
                        </span></p>
                        @if($rental->status == 'pending')
                            <div class="space-x-2">
                                <button wire:click="updateStatus({{ $rental->id }}, 'approved')"
                                        wire:confirm="Are you sure you want to APPROVE this rental for '{{ $rental->item->name }}' by {{ $rental->user->name }}? This will create a financial record and mark the item as rented."
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed"
                                        class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 disabled:bg-green-400 flex items-center gap-1">
                                    <x-loading-spinner wire:loading size="xs" class="text-white" />
                                    <span wire:loading.remove>Approve</span>
                                    <span wire:loading>Approving...</span>
                                </button>
                                <button wire:click="updateStatus({{ $rental->id }}, 'rejected')"
                                        wire:confirm="Are you sure you want to REJECT this rental request for '{{ $rental->item->name }}' by {{ $rental->user->name }}?"
                                        wire:loading.attr="disabled"
                                        wire:loading.class="opacity-50 cursor-not-allowed"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 disabled:bg-red-400 flex items-center gap-1">
                                    <x-loading-spinner wire:loading size="xs" class="text-white" />
                                    <span wire:loading.remove>Reject</span>
                                    <span wire:loading>Rejecting...</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-zinc-500 text-center py-8">No rentals found.</p>
        @endforelse

        {{-- Pagination --}}
        @if($rentals->hasPages())
            <div class="mt-6">
                {{ $rentals->links() }}
            </div>
        @endif
    </div>
</div>