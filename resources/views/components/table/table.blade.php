@props([
    'columns' => [],
    'rows' => [],
    'striped' => true,
    'hoverable' => true,
    'sortable' => false,
    'selectable' => false,
    'responsive' => true,
])

<div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800 shadow-md">
    <table class="w-full text-sm">
        <!-- Table Header -->
        <thead class="bg-secondary dark:bg-neutral-800 border-b border-neutral-200 dark:border-neutral-700">
            <tr>
                @if ($selectable)
                    <th class="w-12 px-4 py-3">
                        <input
                            type="checkbox"
                            @change="selectAll"
                            class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-700 text-primary-600 dark:text-primary-500 focus:ring-primary-500"
                        />
                    </th>
                @endif

                @foreach ($columns as $column)
                    <th
                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-white {{ $sortable ? 'cursor-pointer hover:bg-tertiary dark:hover:bg-neutral-700 transition-colors' : '' }}"
                        @if ($sortable)
                            @click="sort('{{ $column['key'] }}')"
                        @endif
                    >
                        <div class="flex items-center gap-2">
                            <span>{{ $column['label'] }}</span>
                            @if ($sortable)
                                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 4m0 0l4 4m6-4v12m0 0l4-4m0 0l-4 4" />
                                </svg>
                            @endif
                        </div>
                    </th>
                @endforeach

                <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-white">Actions</th>
            </tr>
        </thead>

        <!-- Table Body -->
        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
            @forelse ($rows as $row)
                <tr
                    class="transition-colors duration-200 {{ $striped && $loop->odd ? 'bg-primary dark:bg-neutral-900' : 'bg-white dark:bg-neutral-950' }} {{ $hoverable ? 'hover:bg-secondary dark:hover:bg-neutral-800' : '' }}"
                >
                    @if ($selectable)
                        <td class="w-12 px-4 py-3">
                            <input
                                type="checkbox"
                                :value="'{{ $row['id'] }}'"
                                @change="toggleSelection"
                                class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-700 text-primary-600 dark:text-primary-500 focus:ring-primary-500"
                            />
                        </td>
                    @endif

                    @foreach ($columns as $column)
                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-100">
                            @if (is_callable($column['format'] ?? null))
                                {!! $column['format']($row) !!}
                            @else
                                {{ data_get($row, $column['key']) ?? '—' }}
                            @endif
                        </td>
                    @endforeach

                    <td class="px-4 py-3 text-right">
                        {{ $actions ?? '' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($selectable ? 2 : 1) }}" class="px-4 py-12 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400 dark:text-neutral-600 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-1">No Data</h3>
                            <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ $emptyMessage ?? 'No records found' }}</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
