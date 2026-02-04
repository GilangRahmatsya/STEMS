<div class="p-6 dark:bg-zinc-900 min-h-screen">
    <div class="max-w-5xl mx-auto space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-zinc-900 dark:text-white">Photobooth Queues</h1>
                <p class="text-zinc-500 dark:text-zinc-400 mt-2">Monitor real-time status and queue progression.</p>
            </div>
             @if($activeEvents->count() > 1)
                <div class="flex flex-wrap gap-2">
                    @foreach($activeEvents as $event)
                    <button
                        wire:click="selectEvent({{ $event->id }})"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition-all border {{ $selectedEventId == $event->id ? 'bg-gradient-to-r from-orange-500 to-orange-600 border-transparent text-white shadow-md hover:shadow-lg transform hover:-translate-y-0.5' : 'bg-white text-zinc-600 border-zinc-200 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700' }}"
                    >
                        {{ $event->title }}
                    </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Current Event Info --}}
        @if($selectedEventId && ($selectedEvent = \App\Models\PhotoboothEvent::find($selectedEventId)))
        <div class="bg-white dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">{{ $selectedEvent->title }}</h2>
                    <p class="text-zinc-500 dark:text-zinc-400 mt-1 flex items-center gap-2">
                        <flux:icon.banknotes class="w-4 h-4" />
                        Rp {{ number_format($selectedEvent->price_per_strip, 0, ',', '.') }} / strip
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">Queue Length</p>
                    <div class="flex items-baseline justify-end gap-1 mt-1">
                        <span class="text-4xl font-bold text-zinc-900 dark:text-white">{{ $queues->count() }}</span>
                        <span class="text-zinc-500 dark:text-zinc-400">waiting</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Queue List --}}
        @if($queues->count() > 0)
        <div class="space-y-4">
            @foreach($queues as $index => $queue)
            <div class="bg-white dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl p-6 hover:shadow-md transition-shadow relative overflow-hidden group">
                {{-- Status Bar (Left Accent) --}}
                <div class="absolute left-0 top-0 bottom-0 w-1.5 
                    {{ $queue->is_picked_up ? 'bg-emerald-500' : '' }}
                    {{ $queue->is_ready && !$queue->is_picked_up ? 'bg-blue-500' : '' }}
                    {{ $queue->is_printed && !$queue->is_ready ? 'bg-amber-500' : '' }}
                    {{ $queue->is_photographed && !$queue->is_printed ? 'bg-purple-500' : '' }}
                    {{ !$queue->is_photographed ? 'bg-zinc-300 dark:bg-zinc-600' : '' }}
                "></div>

                <div class="pl-4 flex flex-col md:flex-row gap-6 justify-between items-start md:items-center">
                    <div class="flex items-center gap-4">
                        {{-- Position --}}
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-lg shadow-sm border
                                {{ $index === 0 ? 'bg-zinc-900 text-white border-zinc-900 dark:bg-white dark:text-zinc-900' : 'bg-zinc-100 text-zinc-600 border-zinc-200 dark:bg-zinc-700 dark:text-zinc-300 dark:border-zinc-600' }}">
                                {{ $index + 1 }}
                            </div>
                        </div>

                        {{-- Customer Info --}}
                        <div>
                            <h4 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $queue->customer_name }}</h4>
                            <div class="flex items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">
                                <span>{{ $queue->strips_ordered }} strips</span>
                                <span class="w-1 h-1 rounded-full bg-zinc-300 dark:bg-zinc-600"></span>
                                <span>Rp {{ number_format($queue->total_amount, 0, ',', '.') }}</span>
                                <span class="w-1 h-1 rounded-full bg-zinc-300 dark:bg-zinc-600"></span>
                                <span>{{ $queue->whatsapp_number }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Status & Time --}}
                    <div class="text-right space-y-2">
                        @if($queue->is_picked_up)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                <flux:icon.check-circle class="w-3.5 h-3.5 mr-1.5" /> Completed
                            </span>
                        @elseif($queue->is_ready)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                <flux:icon.bell class="w-3.5 h-3.5 mr-1.5" /> Ready for Pickup
                            </span>
                        @elseif($queue->is_printed)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                <flux:icon.printer class="w-3.5 h-3.5 mr-1.5" /> Printing
                            </span>
                        @elseif($queue->is_photographed)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400 border border-purple-200 dark:border-purple-800">
                                <flux:icon.camera class="w-3.5 h-3.5 mr-1.5" /> Photographed
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-zinc-100 text-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-600">
                                <flux:icon.clock class="w-3.5 h-3.5 mr-1.5" /> In Queue
                            </span>
                        @endif

                        @if(!$queue->is_picked_up && $index > 0)
                        <p class="text-xs font-medium text-zinc-400 uppercase tracking-wider">
                            Est. {{ $this->getEstimatedWaitTime($queue) }}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Progress Steps --}}
                <div class="pl-4 mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-700/50">
                    <div class="relative flex items-center justify-between w-full">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-zinc-100 dark:bg-zinc-700 -z-10"></div>
                        
                        <!-- Step 1: Paid -->
                        <div class="flex flex-col items-center gap-1.5 bg-white dark:bg-zinc-800 px-2 group/step">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors
                                {{ $queue->is_paid ? 'bg-green-50 border-green-500 text-green-600 dark:bg-green-900/20 dark:border-green-500 dark:text-green-400' : 'bg-white border-zinc-200 text-zinc-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-600' }}">
                                <flux:icon.banknotes class="w-4 h-4" />
                            </div>
                            <span class="text-[10px] font-medium uppercase tracking-wider {{ $queue->is_paid ? 'text-zinc-900 dark:text-zinc-200' : 'text-zinc-400 dark:text-zinc-600' }}">Paid</span>
                        </div>

                        <!-- Step 2: Photo -->
                        <div class="flex flex-col items-center gap-1.5 bg-white dark:bg-zinc-800 px-2 group/step">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors
                                {{ $queue->is_photographed ? 'bg-purple-50 border-purple-500 text-purple-600 dark:bg-purple-900/20 dark:border-purple-500 dark:text-purple-400' : 'bg-white border-zinc-200 text-zinc-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-600' }}">
                                <flux:icon.camera class="w-4 h-4" />
                            </div>
                            <span class="text-[10px] font-medium uppercase tracking-wider {{ $queue->is_photographed ? 'text-zinc-900 dark:text-zinc-200' : 'text-zinc-400 dark:text-zinc-600' }}">Photo</span>
                        </div>

                        <!-- Step 3: Print -->
                         <div class="flex flex-col items-center gap-1.5 bg-white dark:bg-zinc-800 px-2 group/step">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors
                                {{ $queue->is_printed ? 'bg-amber-50 border-amber-500 text-amber-600 dark:bg-amber-900/20 dark:border-amber-500 dark:text-amber-400' : 'bg-white border-zinc-200 text-zinc-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-600' }}">
                                <flux:icon.printer class="w-4 h-4" />
                            </div>
                            <span class="text-[10px] font-medium uppercase tracking-wider {{ $queue->is_printed ? 'text-zinc-900 dark:text-zinc-200' : 'text-zinc-400 dark:text-zinc-600' }}">Print</span>
                        </div>

                        <!-- Step 4: Ready -->
                        <div class="flex flex-col items-center gap-1.5 bg-white dark:bg-zinc-800 px-2 group/step">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors
                                {{ $queue->is_ready ? 'bg-blue-50 border-blue-500 text-blue-600 dark:bg-blue-900/20 dark:border-blue-500 dark:text-blue-400' : 'bg-white border-zinc-200 text-zinc-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-600' }}">
                                <flux:icon.check-circle class="w-4 h-4" />
                            </div>
                            <span class="text-[10px] font-medium uppercase tracking-wider {{ $queue->is_ready ? 'text-zinc-900 dark:text-zinc-200' : 'text-zinc-400 dark:text-zinc-600' }}">Ready</span>
                        </div>

                        <!-- Step 5: Pickup -->
                        <div class="flex flex-col items-center gap-1.5 bg-white dark:bg-zinc-800 px-2 group/step">
                             <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-colors
                                {{ $queue->is_picked_up ? 'bg-emerald-50 border-emerald-500 text-emerald-600 dark:bg-emerald-900/20 dark:border-emerald-500 dark:text-emerald-400' : 'bg-white border-zinc-200 text-zinc-300 dark:bg-zinc-800 dark:border-zinc-600 dark:text-zinc-600' }}">
                                <flux:icon.hand-thumb-up class="w-4 h-4" />
                            </div>
                            <span class="text-[10px] font-medium uppercase tracking-wider {{ $queue->is_picked_up ? 'text-zinc-900 dark:text-zinc-200' : 'text-zinc-400 dark:text-zinc-600' }}">Done</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-white dark:bg-zinc-800/50 border border-zinc-200 dark:border-zinc-700 rounded-xl p-12 text-center">
            <div class="w-16 h-16 bg-zinc-50 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 border border-zinc-100 dark:border-zinc-700">
                <flux:icon.queue-list class="w-8 h-8 text-zinc-400" />
            </div>
            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">Queue is Empty</h3>
            <p class="text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto">
                @if($selectedEventId)
                    There are currently no customers in the queue for this event. 
                @else
                    No active photobooth events available to display.
                @endif
            </p>
        </div>
        @endif
    </div>
</div>