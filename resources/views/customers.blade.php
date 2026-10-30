@php
    $customerStatus = [
        'Active' => ['tone' => 'positive', 'key' => 'active'],
        'Trial' => ['tone' => 'info', 'key' => 'trial'],
        'At risk' => ['tone' => 'warning', 'key' => 'at-risk'],
        'Churned' => ['tone' => 'negative', 'key' => 'churned'],
    ];
@endphp

<x-layouts.app title="Customers" heading="Customers">
    <x-page-header
        eyebrow="Relationships"
        title="Customers"
        description="Understand your audience, spot loyal accounts and keep an eye on churn risk."
    >
        <x-slot:actions>
            <x-button variant="secondary" icon="download">Export list</x-button>
            <x-button variant="primary" icon="user-plus">Add customer</x-button>
        </x-slot:actions>
    </x-page-header>

    <section aria-label="Customer metrics" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($summary as $stat)
            <x-stat-card
                :label="$stat['label']"
                :value="$stat['value']"
                :delta="$stat['delta']"
                :trend="$stat['trend']"
                :positive="$stat['label'] === 'At risk' ? true : null"
                :icon="$stat['icon']"
                :tone="$stat['tone']"
            />
        @endforeach
    </section>

    <x-card class="mt-5 overflow-hidden">
        <div class="flex flex-col gap-4 border-b border-line p-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Customer directory</h2>
                    <p class="mt-1 text-xs text-muted">Everyone with an active or past subscription</p>
                </div>

                <div class="flex w-fit items-center gap-1 overflow-x-auto rounded-xl bg-surface-2 p-1 ring-1 ring-inset ring-line/60">
                    <button type="button" data-customer-filter="all" class="filter-tab is-active whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="true">All</button>
                    <button type="button" data-customer-filter="active" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">Active</button>
                    <button type="button" data-customer-filter="trial" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">Trial</button>
                    <button type="button" data-customer-filter="at-risk" class="filter-tab whitespace-nowrap rounded-lg px-3 py-1.5 text-[11px] font-semibold" aria-selected="false">At risk</button>
                </div>
            </div>

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div class="relative w-full sm:max-w-xs">
                    <x-icon name="search" :size="15" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-faint" />
                    <input id="customer-search" type="search" placeholder="Search customers…" class="h-10 w-full rounded-xl border border-line bg-surface pl-9 pr-3 text-[13px] text-ink outline-none transition placeholder:text-faint focus:border-line-strong focus:ring-4 focus:ring-brand/10">
                </div>

                <div class="flex items-center gap-2">
                    <x-button variant="secondary" size="sm" icon="sliders-horizontal">Segment</x-button>
                    <x-button variant="secondary" size="icon-sm" aria-label="Columns">
                        <x-icon name="layers" :size="16" />
                    </x-button>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px] text-left">
                <thead>
                    <tr class="border-b border-line bg-surface-2/70 text-[10px] font-semibold uppercase tracking-[0.12em] text-faint">
                        <th scope="col" class="px-5 py-3">Customer</th>
                        <th scope="col" class="px-5 py-3">Plan</th>
                        <th scope="col" class="px-5 py-3 text-right">Total spend</th>
                        <th scope="col" class="px-5 py-3 text-right">Orders</th>
                        <th scope="col" class="px-5 py-3">Last active</th>
                        <th scope="col" class="px-5 py-3">Status</th>
                        <th scope="col" class="w-12 px-5 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @foreach ($customers as $customer)
                        <tr data-customer-row data-status="{{ $customerStatus[$customer['status']]['key'] ?? 'active' }}" data-search="{{ strtolower($customer['name'].' '.$customer['email'].' '.$customer['plan']) }}" class="group transition-colors hover:bg-surface-2/60">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <x-avatar :name="$customer['name']" :tone="$customer['tone']" size="md" />
                                    <div class="min-w-0">
                                        <p class="truncate text-[13px] font-semibold text-ink">{{ $customer['name'] }}</p>
                                        <p class="truncate text-[11px] text-faint">{{ $customer['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-5 py-3.5">
                                <x-badge tone="outline" :dot="false">{{ $customer['plan'] }}</x-badge>
                            </td>
                            <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-[13px] font-semibold text-ink">{{ $customer['spend'] }}</td>
                            <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-xs text-muted">{{ $customer['orders'] }}</td>
                            <td class="whitespace-nowrap px-5 py-3.5 text-xs text-muted">{{ $customer['active'] }}</td>
                            <td class="whitespace-nowrap px-5 py-3.5">
                                <x-badge :tone="$customerStatus[$customer['status']]['tone'] ?? 'neutral'">{{ $customer['status'] }}</x-badge>
                            </td>
                            <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                <button type="button" class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-3 hover:text-ink" aria-label="Open customer {{ $customer['name'] }}">
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
                Showing <span class="tabular font-semibold text-ink" data-customer-count>{{ count($customers) }}</span> of
                <span class="tabular font-semibold text-ink">8,942</span> customers
            </p>

            <nav class="flex items-center gap-1" aria-label="Pagination">
                <button type="button" class="grid size-8 place-items-center rounded-lg border border-line text-faint transition hover:text-ink disabled:opacity-40" disabled aria-label="Previous page">
                    <x-icon name="chevron-left" :size="15" />
                </button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg bg-ink text-[12px] font-semibold text-canvas">1</button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">2</button>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">3</button>
                <span class="grid size-8 place-items-center text-[12px] text-faint">…</span>
                <button type="button" class="tabular grid size-8 place-items-center rounded-lg text-[12px] font-medium text-muted transition hover:bg-surface-2 hover:text-ink">112</button>
                <button type="button" class="grid size-8 place-items-center rounded-lg border border-line text-faint transition hover:text-ink" aria-label="Next page">
                    <x-icon name="chevron-right" :size="15" />
                </button>
            </nav>
        </div>
    </x-card>
</x-layouts.app>
