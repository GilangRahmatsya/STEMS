<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">My Rentals</h1>

    <div class="space-y-4">
        @forelse ($rentals as $rental)
            <div class="border rounded-lg p-4 bg-white dark:bg-zinc-900">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="font-semibold text-lg">{{ $rental->item->name }}</h2>
                        <p class="text-sm text-zinc-500">
                            Status: <span class="capitalize {{ $rental->status == 'approved' ? 'text-green-600' : ($rental->status == 'pending' ? 'text-yellow-600' : 'text-red-600') }}">{{ $rental->status }}</span>
                        </p>
                        <p class="text-sm text-zinc-500">
                            Period: {{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}
                        </p>
                        <p class="text-sm text-zinc-500">
                            Total: Rp {{ number_format($rental->total_price) }}
                        </p>
                    </div>
                    <div class="text-right">
                        @if($rental->status == 'pending')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs">Pending Approval</span>
                        @elseif($rental->status == 'approved')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Approved</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Rejected</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-zinc-500 text-center py-8">You haven't made any rentals yet.</p>
        @endforelse
    </div>

    @if($rentals->hasPages())
        <div class="mt-6">
            {{ $rentals->links() }}
        </div>
    @endif
</div>