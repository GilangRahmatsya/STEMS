<div class="px-4 py-6 sm:px-6 lg:px-8 space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">Manage Items</h1>
            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">Manage your inventory, pricing, and availability.</p>
        </div>
        @if($isEdit)
            <button 
                wire:click="resetForm" 
                class="inline-flex items-center justify-center px-5 py-2.5 bg-zinc-500 hover:bg-zinc-600 text-white shadow-md hover:shadow-lg rounded-lg text-sm font-semibold transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-zinc-500 sm:w-auto"
            >
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Close Form
            </button>
        @else
            <button 
                wire:click="$set('isEdit', true)" 
                class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white shadow-md hover:shadow-lg rounded-lg text-sm font-semibold transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:w-auto"
            >
                <flux:icon.plus class="h-5 w-5 mr-2" />
                Add New Item
            </button>
        @endif
    </div>

    <!-- Form Section (Toggleable) -->
    <div x-show="$wire.isEdit" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">{{ $itemId ? 'Edit Item' : 'Create New Item' }}</h2>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">Fill in the details below.</p>
            </div>
            <button type="button" @click="$wire.set('isEdit', false)" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form wire:submit.prevent="{{ $itemId ? 'update' : 'save' }}" class="p-6 space-y-6">
            <!-- Image Upload -->
            <div class="flex items-center gap-6">
                <div class="shrink-0">
                    @if($image)
                        <img src="{{ $image->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
                    @elseif($currentImage)
                         <img src="{{ asset('storage/' . $currentImage) }}" class="h-24 w-24 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700" />
                    @else
                        <div class="h-24 w-24 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center border border-dashed border-zinc-300 dark:border-zinc-700">
                            <svg class="h-8 w-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" wire:model="image" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-50 file:text-zinc-700 hover:file:bg-zinc-100 dark:file:bg-zinc-800 dark:file:text-zinc-300 dark:hover:file:bg-zinc-700 transition-colors"/>
                    @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </label>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Item Name</label>
                    <input wire:model="name" type="text" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder:text-zinc-500 dark:placeholder:text-zinc-400 sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="e.g. Canon EOS R5">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Category</label>
                    <select wire:model="category_id" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Condition</label>
                    <select wire:model="condition" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <option value="">Select Condition</option>
                        @foreach($conditions as $cond)
                            <option value="{{ $cond }}">{{ $cond }}</option>
                        @endforeach
                    </select>
                    @error('condition') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Location</label>
                    <input wire:model="location" type="text" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder:text-zinc-500 dark:placeholder:text-zinc-400 sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="e.g. Rack A1">
                    @error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Quantity</label>
                    <input wire:model="quantity" type="number" min="1" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    @error('quantity') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Rental Price (per day)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-zinc-700 dark:text-zinc-400 text-sm font-medium">Rp</span>
                        <input wire:model="rent_price" type="number" step="1000" class="w-full pl-10 px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder:text-zinc-500 dark:placeholder:text-zinc-400 sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    @error('rent_price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-semibold text-zinc-900 dark:text-zinc-300">Description</label>
                <textarea wire:model="description" rows="3" class="w-full px-3 py-2 rounded-lg border-2 border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder:text-zinc-500 dark:placeholder:text-zinc-400 sm:text-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500" placeholder="Item description...\"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <button type="button" @click="$wire.set('isEdit', false)" class="px-4 py-2 text-sm font-medium text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors">Cancel</button>
                <div class="relative">
                     <button type="submit" wire:loading.attr="disabled" class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 rounded-lg shadow-md hover:shadow-lg transition-all focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 disabled:opacity-50">
                        <span wire:loading.remove>{{ $itemId ? 'Update Item' : 'Create Item' }}</span>
                        <span wire:loading>Saving...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-sm overflow-hidden">
        <!-- Table Controls -->
        <div class="p-4 border-b border-zinc-200 dark:border-zinc-800 flex flex-col sm:flex-row gap-4 justify-between items-center bg-zinc-50/50 dark:bg-zinc-900/50">
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border-2 border-zinc-300 dark:border-zinc-700 rounded-lg leading-5 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-orange-500 sm:text-sm transition-colors" placeholder="Search items...\">
            </div>
            <div class="flex items-center gap-2">
                 <select wire:model.live="category" class="block w-full pl-3 pr-10 py-2 text-base border-2 border-zinc-300 dark:border-zinc-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white\">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-800">
                <thead class="bg-zinc-50 dark:bg-zinc-800/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-900 dark:text-zinc-400 uppercase tracking-wider">Item</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-900 dark:text-zinc-400 uppercase tracking-wider hidden sm:table-cell">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-900 dark:text-zinc-400 uppercase tracking-wider hidden md:table-cell">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-zinc-900 dark:text-zinc-400 uppercase tracking-wider">Price</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($items as $item)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($item->image)
                                            <img class="h-10 w-10 rounded-lg object-cover border border-zinc-200 dark:border-zinc-700" src="{{ asset('storage/' . $item->image) }}" alt="">
                                        @else
                                            <div class="h-10 w-10 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center border border-zinc-200 dark:border-zinc-700">
                                                <span class="text-xs font-medium text-zinc-500">{{ substr($item->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900 dark:text-white">{{ $item->name }}</div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $item->quantity }} units • {{ $item->location ?? 'No location' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ $item->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $item->condition === 'Excellent' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}
                                    {{ $item->condition === 'Good' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                    {{ $item->condition === 'Fair' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                    {{ $item->condition === 'Bad' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                                    {{ $item->condition }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">
                                Rp {{ number_format($item->rent_price, 0, ',', '.') }}<span class="text-xs text-zinc-400">/day</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button wire:click="edit({{ $item->id }})" class="text-zinc-400 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button wire:click="delete({{ $item->id }})" wire:confirm="Delete this item?" class="text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500 dark:text-zinc-400">
                                <div class="flex flex-col items-center">
                                    <svg class="h-12 w-12 text-zinc-300 dark:text-zinc-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    <p class="text-lg font-medium">No items found</p>
                                    <p class="text-sm">Get started by creating a new item.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($items->hasPages())
            <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900/50">
                {{ $items->links() }}
            </div>
        @endif
    </div>
</div>
