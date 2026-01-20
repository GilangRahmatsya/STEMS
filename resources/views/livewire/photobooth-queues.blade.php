<div class="p-6 dark:bg-zinc-800 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Photobooth Queues</h1>

        {{-- Event Selection --}}
        @if($activeEvents->count() > 1)
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 mb-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Select Event</h2>
            <div class="flex flex-wrap gap-2">
                @foreach($activeEvents as $event)
                <flux:button
                    wire:click="selectEvent({{ $event->id }})"
                    :variant="$selectedEventId == $event->id ? 'primary' : 'ghost'"
                    size="sm"
                >
                    {{ $event->title }}
                </flux:button>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Current Event Info --}}
        @if($selectedEventId && ($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId)))
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ $selectedEvent->title }}</h2>
                    <p class="text-sm text-gray-600 dark:text-zinc-400">
                        Price per strip: Rp {{ number_format($selectedEvent->price_per_strip, 0, ',', '.') }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 dark:text-zinc-400">Total in Queue</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $queues->count() }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Queue List --}}
        @if($queues->count() > 0)
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden">
            <div class="px-4 py-3 border-b border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Current Queue</h3>
            </div>

            <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @foreach($queues as $index => $queue)
                <div class="p-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            {{-- Position --}}
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold">{{ $index + 1 }}</span>
                                </div>
                            </div>

                            {{-- Customer Info --}}
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $queue->customer_name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-zinc-400">
                                    {{ $queue->strips_ordered }} strips • Rp {{ number_format($queue->total_amount, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-zinc-500">{{ $queue->whatsapp_number }}</p>
                            </div>
                        </div>

                        {{-- Status & Time --}}
                        <div class="text-right">
                            {{-- Status Badge --}}
                            <div class="mb-2">
                                @if($queue->is_picked_up)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Completed
                                    </span>
                                @elseif($queue->is_ready)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Ready for Pickup
                                    </span>
                                @elseif($queue->is_printed)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Printing
                                    </span>
                                @elseif($queue->is_photographed)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                        Photographed
                                    </span>
                                @elseif($queue->is_paid)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        Paid - Waiting
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                                        Pending Payment
                                    </span>
                                @endif
                            </div>

                            {{-- Estimated Wait Time --}}
                            @if(!$queue->is_picked_up && $index > 0)
                            <p class="text-xs text-gray-500 dark:text-zinc-400">
                                Est. wait: {{ $this->getEstimatedWaitTime($queue) }}
                            </p>
                            @endif
                        </div>
                    </div>

                    {{-- Progress Steps --}}
                    <div class="mt-3">
                        <div class="flex items-center space-x-2 text-xs">
                            <div class="flex items-center {{ $queue->is_paid ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                <flux:icon.check-circle class="w-4 h-4 mr-1" />
                                Paid
                            </div>
                            <div class="w-4 h-px bg-gray-300 dark:bg-zinc-600"></div>
                            <div class="flex items-center {{ $queue->is_photographed ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                <flux:icon.camera class="w-4 h-4 mr-1" />
                                Photo
                            </div>
                            <div class="w-4 h-px bg-gray-300 dark:bg-zinc-600"></div>
                            <div class="flex items-center {{ $queue->is_printed ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                <flux:icon.printer class="w-4 h-4 mr-1" />
                                Print
                            </div>
                            <div class="w-4 h-px bg-gray-300 dark:bg-zinc-600"></div>
                            <div class="flex items-center {{ $queue->is_ready ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                <flux:icon.check-circle class="w-4 h-4 mr-1" />
                                Ready
                            </div>
                            <div class="w-4 h-px bg-gray-300 dark:bg-zinc-600"></div>
                            <div class="flex items-center {{ $queue->is_picked_up ? 'text-green-600 dark:text-green-400' : 'text-gray-400' }}">
                                <flux:icon.check-circle class="w-4 h-4 mr-1" />
                                Picked Up
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-8 text-center">
            <flux:icon.photo class="w-12 h-12 text-gray-400 mx-auto mb-4" />
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Active Queues</h3>
            <p class="text-gray-600 dark:text-zinc-400">
                @if($selectedEventId)
                    There are currently no customers in the queue for this event.
                @else
                    No active photobooth events available.
                @endif
            </p>
        </div>
        @endif
    </div>
</div>