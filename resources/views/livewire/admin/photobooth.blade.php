<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Photobooth Management</h1>
            <div class="flex space-x-2">
                <flux:button variant="primary" wire:click="openEventModal">
                    <flux:icon.plus class="w-4 h-4 mr-2" />
                    New Event
                </flux:button>
            </div>
        </div>
    </div>

    <!-- Revenue Summary -->
    <div class="bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg mb-6">
        <div class="flex items-center">
            <div class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg">
                <flux:icon.currency-dollar class="w-6 h-6 text-blue-600 dark:text-blue-400" />
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Total Photobooth Revenue</p>
                <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="mb-6">
        <nav class="flex space-x-1 bg-gray-100 dark:bg-gray-800 p-1 rounded-lg">
            <button
                wire:click="switchTab('events')"
                class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors {{ $activeTab === 'events' ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Events
            </button>
            <button
                wire:click="switchTab('queues')"
                class="flex-1 py-2 px-4 text-sm font-medium rounded-md transition-colors {{ $activeTab === 'queues' ? 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Queues {{ $selectedEventId ? '(' . \App\Models\PhotoboothEvent::find($selectedEventId)?->title . ')' : '' }}
            </button>
        </nav>
    </div>

    <!-- Events Tab -->
    @if($activeTab === 'events')
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Photobooth Events</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-zinc-400">Manage your photobooth events and pricing.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Package</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Revenue</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($events as $event)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $event->title }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                    {{ $event->strips_count }} strips
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                    Rp {{ number_format($event->price_per_strip, 0, ',', '.') }}/strip
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $event->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                        {{ $event->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                    Rp {{ number_format($event->totalRevenue(), 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <flux:button variant="ghost" size="sm" wire:click="selectEvent({{ $event->id }})">
                                            <flux:icon.eye class="w-4 h-4" />
                                        </flux:button>
                                        <flux:button variant="ghost" size="sm" wire:click="editEvent({{ $event->id }})">
                                            <flux:icon.pencil class="w-4 h-4" />
                                        </flux:button>
                                        <flux:button variant="ghost" size="sm" wire:click="toggleEventStatus({{ $event->id }})">
                                            @if ($event->is_active)
                                                <flux:icon.eye-slash class="w-4 h-4" />
                                            @else
                                                <flux:icon.eye class="w-4 h-4" />
                                            @endif
                                        </flux:button>
                                        <flux:button variant="ghost" size="sm" wire:click="deleteEvent({{ $event->id }})"
                                                     onclick="return confirm('Are you sure you want to delete &quot;{{ addslashes($event->title) }}&quot;? This will permanently remove the event and all associated queues.')">
                                            <flux:icon.trash class="w-4 h-4 text-red-500" />
                                        </flux:button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No photobooth events found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Queues Tab -->
    @if($activeTab === 'queues')
        @if($selectedEventId && ($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId)))
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ $selectedEvent?->title }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-zinc-400">
                                {{ $selectedEvent?->strips_count }} strips @ Rp {{ number_format($selectedEvent?->price_per_strip ?? 0, 0, ',', '.') }}/strip
                            </p>
                        </div>
                        <flux:button variant="primary" wire:click="openQueueModal">
                            <flux:icon.plus class="w-4 h-4 mr-2" />
                            Add Queue
                        </flux:button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">Strips</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">WhatsApp</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-900 dark:text-zinc-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($queues as $queue)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-zinc-100">
                                        {{ $queue->customer_name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                        {{ $queue->strips_ordered }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-zinc-100">
                                        {{ $queue->whatsapp_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-zinc-100">
                                        Rp {{ number_format($queue->total_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-1">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $queue->is_paid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $queue->is_paid ? 'Paid' : 'Unpaid' }}
                                            </span>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $queue->is_photographed ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $queue->is_photographed ? 'Shot' : 'Pending' }}
                                            </span>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $queue->is_printed ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $queue->is_printed ? 'Printed' : 'Pending' }}
                                            </span>
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $queue->is_picked_up ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $queue->is_picked_up ? 'Picked Up' : 'Ready' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex flex-wrap gap-1">
                                            <flux:button variant="ghost" size="sm" wire:click="updateQueueStatus({{ $queue->id }}, 'paid')"
                                                         class="{{ $queue->is_paid ? 'text-green-600' : 'text-gray-400' }}">
                                                <flux:icon.currency-dollar class="w-4 h-4" />
                                            </flux:button>
                                            <flux:button variant="ghost" size="sm" wire:click="updateQueueStatus({{ $queue->id }}, 'photographed')"
                                                         class="{{ $queue->is_photographed ? 'text-blue-600' : 'text-gray-400' }}">
                                                <flux:icon.camera class="w-4 h-4" />
                                            </flux:button>
                                            <flux:button variant="ghost" size="sm" wire:click="updateQueueStatus({{ $queue->id }}, 'printed')"
                                                         class="{{ $queue->is_printed ? 'text-purple-600' : 'text-gray-400' }}">
                                                <flux:icon.printer class="w-4 h-4" />
                                            </flux:button>
                                            <flux:button variant="ghost" size="sm" wire:click="updateQueueStatus({{ $queue->id }}, 'picked_up')"
                                                         class="{{ $queue->is_picked_up ? 'text-green-600' : 'text-gray-400' }}">
                                                <flux:icon.check-circle class="w-4 h-4" />
                                            </flux:button>
                                            <flux:button variant="ghost" size="sm" wire:click="deleteQueue({{ $queue->id }})"
                                                         onclick="return confirm('Are you sure you want to delete the queue for {{ addslashes($queue->customer_name) }}? This will permanently remove their order.')">
                                                <flux:icon.trash class="w-4 h-4 text-red-500" />
                                            </flux:button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-zinc-400">
                                        No queues found for this event.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($queues->hasPages())
                    <div class="bg-white dark:bg-zinc-800 px-4 py-3 border-t border-gray-200 dark:border-zinc-700 sm:px-6">
                        {{ $queues->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow p-12 text-center">
                <flux:icon.photo class="w-12 h-12 text-gray-400 mx-auto mb-4" />
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Event Selected</h3>
                <p class="text-gray-600 dark:text-zinc-400 mb-4">Please select an event from the Events tab to manage queues.</p>
                <flux:button wire:click="switchTab('events')" variant="primary">
                    Go to Events
                </flux:button>
            </div>
        @endif
    @endif

    <!-- Create/Edit Event Modal -->
    <flux:modal name="event-modal" :show="$showEventModal" @close="$wire.closeEventModal()">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <flux:heading size="lg">{{ $editingEvent ? 'Edit Photobooth Event' : 'Create Photobooth Event' }}</flux:heading>
                    <flux:subheading>Set up a new photobooth event with pricing.</flux:subheading>
                </div>
                <button type="button" @click="$wire.closeEventModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit="saveEvent" class="space-y-6">
                <flux:field>
                    <flux:label class="font-semibold text-gray-900 dark:text-gray-100">Event Title</flux:label>
                    <flux:input wire:model="eventTitle" placeholder="e.g., Wedding Reception, Birthday Party" class="text-gray-900 dark:text-white" required />
                    <flux:error name="eventTitle" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label class="font-semibold text-gray-900 dark:text-gray-100">Strips per Package</flux:label>
                        <flux:input wire:model="stripsCount" type="number" min="1" class="text-gray-900 dark:text-white" required />
                        <flux:error name="stripsCount" />
                    </flux:field>

                    <flux:field>
                        <flux:label class="font-semibold text-gray-900 dark:text-gray-100">Price per Strip (Rp)</flux:label>
                        <flux:input wire:model="pricePerStrip" type="number" step="1000" placeholder="e.g., 150000" class="text-gray-900 dark:text-white" required />
                        <flux:error name="pricePerStrip" />
                    </flux:field>
                </div>

                @if($pricePerStrip && $stripsCount)
                    <div class="bg-gray-50 dark:bg-zinc-700 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-zinc-400">
                            Total package price: <strong>Rp {{ number_format($pricePerStrip * $stripsCount, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                @endif

                <div class="flex justify-end space-x-4">
                    <flux:button variant="ghost" wire:click="closeEventModal">Cancel</flux:button>
                    <flux:button type="submit"
                                 variant="primary"
                                 wire:loading.attr="disabled"
                                 wire:loading.class="opacity-50 cursor-not-allowed">
                        <x-loading-spinner wire:loading size="sm" class="text-white mr-2" />
                        <span wire:loading.remove>{{ $editingEvent ? 'Update Event' : 'Create Event' }}</span>
                        <span wire:loading>{{ $editingEvent ? 'Updating...' : 'Creating...' }}</span>
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Add Queue Modal -->
    <flux:modal name="queue-modal" :show="$showQueueModal" @close="$wire.closeQueueModal()">
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <flux:heading size="lg">Add New Queue</flux:heading>
                    <flux:subheading>Add a customer to the queue for {{ $selectedEventId && ($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId))?->title ?? 'this event' }}.</flux:subheading>
                </div>
                <button type="button" @click="$wire.closeQueueModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit="saveQueue" class="space-y-6">
                <flux:field>
                    <flux:label>Customer Name</flux:label>
                    <flux:input wire:model="customerName" placeholder="Enter customer name" required />
                    <flux:error name="customerName" />
                </flux:field>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:field>
                        <flux:label>Strips Ordered</flux:label>
                        <flux:input wire:model="stripsOrdered" type="number" min="1" :max="($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId))?->strips_count ?? 10" required />
                        <flux:error name="stripsOrdered" />
                    </flux:field>

                    <flux:field>
                        <flux:label>WhatsApp Number</flux:label>
                        <flux:input wire:model="whatsappNumber" placeholder="081234567890" required />
                        <flux:error name="whatsappNumber" />
                    </flux:field>
                </div>

                @if($selectedEventId && ($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId)) && $stripsOrdered)
                    <div class="bg-gray-50 dark:bg-zinc-700 p-4 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-zinc-400">
                            Total amount: <strong>Rp {{ number_format(($selectedEvent?->price_per_strip ?? 0) * $stripsOrdered, 0, ',', '.') }}</strong>
                        </p>
                    </div>
                @endif

                <div class="flex justify-end space-x-4">
                    <flux:button variant="ghost" wire:click="closeQueueModal">Cancel</flux:button>
                    <flux:button type="submit"
                                 variant="primary"
                                 wire:loading.attr="disabled"
                                 wire:loading.class="opacity-50 cursor-not-allowed">
                        <x-loading-spinner wire:loading size="sm" class="text-white mr-2" />
                        <span wire:loading.remove>Add to Queue</span>
                        <span wire:loading>Adding...</span>
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>