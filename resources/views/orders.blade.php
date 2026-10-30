@php
    $orderStatus = [
        'paid' => ['label' => 'Paid', 'tone' => 'positive'],
        'pending' => ['label' => 'Pending', 'tone' => 'warning'],
        'refunded' => ['label' => 'Refunded', 'tone' => 'negative'],
    ];
@endphp

<x-layouts.app title="Orders" heading="Orders">
    <x-page-header
        eyebrow="Commerce"
        title="Orders"
        description="Review, filter and manage every order placed across your storefront."
    >
        <x-slot:actions>
            <x-button variant="secondary" icon="download">Export CSV</x-button>
            <x-button variant="primary" icon="plus">Create order</x-button>
        </x-slot:actions>
    </x-page-header>

    <section aria-label="Order summary" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($summary as $item)
            <x-card class="p-5">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-[13px] font-medium text-muted">{{ $item['label'] }}</p>
                    <span class="size-2 rounded-full {{ $item['dot'] }}"></span>
                </div>
                <p class="tabular mt-3 text-[26px] font-semibold leading-none tracking-[-0.03em] text-ink">{{ $item['value'] }}</p>
            </x-card>
        @endforeach
    </section>

    <x-card class="mt-5 overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-line p-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">All orders</h2>
                    <p class="mt-1 text-xs text-muted">A complete list of recent transactions</p>
                </div>

                <div class="flex w-fit items-center gap-1 overflow-x-auto rounded-xl bg-surface-2 p-1 ring-1 ring-inset ring-line/60">
                    <button type="button" data-order-filter="all" class="filter-tab is-active whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="true">All orders</button>
                    <button type="button" data-order-filter="paid" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">Paid</button>
                    <button type="button" data-order-filter="pending" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">Pending</button>
                    <button type="button" data-order-filter="refunded" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">Refunded</button>
                </div>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div class="relative w-full sm:max-w-xs">
                    <x-icon name="search" :size="15" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-faint" />
                    <input id="order-search" type="search" placeholder="Search orders or customers…" class="h-10 w-full rounded-xl border border-line bg-surface pl-9 pr-3 text-[13px] text-ink outline-none transition placeholder:text-faint focus:border-line-strong focus:ring-4 focus:ring-brand/10">
                </div>

                <div class="flex items-center gap-2">
                    <x-button variant="secondary" size="sm" icon="filter">Filter</x-button>
                    <x-button variant="secondary" size="icon-sm" aria-label="Table view">
                        <x-icon name="layout-dashboard" :size="16" />
                    </x-button>
                    <x-button variant="secondary" size="icon-sm" aria-label="More options">
                        <x-icon name="ellipsis" :size="16" />
                    </x-button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px] text-left">
                <thead>
                    <tr class="border-b border-line bg-surface-2/70 text-[10px] font-semibold uppercase tracking-[0.12em] text-faint">
                        <th scope="col" class="w-12 px-5 py-3">
                            <input type="checkbox" data-select-all class="size-4 rounded border-line bg-surface accent-brand" aria-label="Select all orders">
                        </th>
                        <th scope="col" class="px-3 py-3">Order</th>
                        <th scope="col" class="px-5 py-3">Customer</th>
                        <th scope="col" class="px-5 py-3">Date</th>
                        <th scope="col" class="px-5 py-3">Items</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="px-5 py-3 text-right">Total</th>
                        <th scope="col" class="w-12 px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @foreach ($orders as $order)
                        <tr data-order-row data-status="{{ $order['status'] }}" data-search="{{ strtolower($order['id'].' '.$order['name'].' '.$order['email']) }}" class="group transition-colors hover:bg-surface-2/60">
                            <td class="px-5 py-3.5">
                                <input type="checkbox" data-select-row class="size-4 rounded border-line bg-surface accent-brand" aria-label="Select order {{ $order['id'] }}">
                            </td>
                            <td class="whitespace-nowrap px-3 py-3.5">
                                <p class="tabular text-[13px] font-semibold text-ink">{{ $order['id'] }}</p>
                                <p class="mt-0.5 text-[11px] text-faint">{{ $order['method'] }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <x-avatar :name="$order['name']" :tone="$order['tone']" size="md" />
                                    <div class="min-w-0">
                                        <p class="truncate text-[13px] font-semibold text-ink">{{ $order['name'] }}</p>
                                        <p class="truncate text-[11px] text-faint">{{ $order['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-3.5">
                                <p class="text-xs text-ink">{{ $order['date'] }}</p>
                                <p class="mt-0.5 text-[11px] text-faint">{{ $order['time'] }}</p>
                            </td>
                            <td class="whitespace-nowrap px-5 py-3.5 text-xs text-muted">{{ $order['items'] }} {{ \Illuminate\Support\Str::plural('item', $order['items']) }}</td>
                            <td class="whitespace-nowrap px-5 py-3.5">
                                <x-badge :tone="$orderStatus[$order['status']]['tone'] ?? 'neutral'">{{ $orderStatus[$order['status']]['label'] ?? $order['status'] }}</x-badge>
                            </td>
                            <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-[13px] font-semibold text-ink">{{ $order['total'] }}</td>
                            <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                <button type="button" class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-3 hover:text-ink" aria-label="Open order {{ $order['id'] }}">
                                    <x-icon name="ellipsis" :size="16" />
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex flex-col gap-3 border-t border-line px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-muted">
                Showing <span class="tabular font-semibold text-ink" data-order-count>{{ count($orders) }}</span> of
                <span class="tabular font-semibold text-ink">1,284</span> orders
            </p>

            <nav class="flex items-center gap-1" aria-label="Pagination">
                <button type="button" class="grid size-8 place-items-center rounded-lg border border-line text-faint transition hover:text-ink disabled:opacity-40" disabled aria-label="Previous page">
                    <x-icon name="chevron-left" :size="15" />
                </button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg bg-ink text-[12px] font-semibold text-canvas">1</button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">2</button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">3</button>
                <span class="grid size-8 place-items-center text-[12px] text-faint">…</span>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">24</button>
                <button type="button" class="grid size-8 place-items-center rounded-lg border border-line text-faint transition hover:text-ink" aria-label="Next page">
                    <x-icon name="chevron-right" :size="15" />
                </button>
            </nav>
        </div>
    </x-card>
</x-layouts.app>
