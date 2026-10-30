@php
$statusTones = ['Paid' => 'positive', 'Pending' => 'warning', 'Refunded' => 'negative'];
$circumference = 2 * M_PI * 68;
@endphp

<x-layouts.app title="Overview" heading="Overview">
    <x-page-header :eyebrow="now()->format('l, j F Y')" title="Good morning," accent="Reyqie"
        description="Here is what is happening across Northwind Labs today. Your revenue is up 12.4% compared to last month.">
        <x-slot:actions>
            <x-button variant="secondary" icon="calendar">
                Last 30 days
                <x-icon name="chevron-down" :size="14" class="text-faint" />
            </x-button>
            <x-button variant="primary" icon="download">Export report</x-button>
        </x-slot:actions>
    </x-page-header>

    <section aria-label="Key metrics" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
        <x-stat-card :label="$stat['label']" :value="$stat['value']" :delta="$stat['delta']" :trend="$stat['trend']"
            :caption="$stat['caption']" :icon="$stat['icon']" :tone="$stat['tone']" :spark="$stat['spark']" />
        @endforeach
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Revenue and goals">
        <x-card data-chart-card class="overflow-hidden xl:col-span-2">
            <div class="flex flex-col gap-5 border-b border-line p-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Revenue overview</h2>
                        <x-badge tone="brand" :dot="false">Live</x-badge>
                    </div>
                    <p class="mt-1 text-xs text-muted">Gross revenue across all channels</p>

                    <div class="mt-4 flex flex-wrap items-end gap-3">
                        <p class="tabular text-[28px] font-semibold leading-none tracking-[-0.03em] text-ink">$486,520
                        </p>
                        <x-delta value="+14.8%" trend="up" caption="vs last year" />
                    </div>
                </div>

                <div class="flex w-fit items-center gap-1 rounded-xl bg-surface-2 p-1 ring-1 ring-inset ring-line/60">
                    <button type="button" data-chart-range="12"
                        class="seg-btn is-active rounded-lg px-3 py-1.5 text-[11px] font-semibold"
                        aria-pressed="true">12M</button>
                    <button type="button" data-chart-range="6"
                        class="seg-btn rounded-lg px-3 py-1.5 text-[11px] font-semibold"
                        aria-pressed="false">6M</button>
                    <button type="button" data-chart-range="3"
                        class="seg-btn rounded-lg px-3 py-1.5 text-[11px] font-semibold"
                        aria-pressed="false">3M</button>
                </div>
            </div>

            <div class="p-3 sm:p-4">
                <div class="mb-3 flex flex-wrap items-center gap-4 px-2">
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-brand"></span>
                        This year
                    </span>
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-[var(--chart-5)]"></span>
                        Last year
                    </span>
                </div>

                <div id="revenueChart" data-chart="area" data-height="296" data-prefix="$" data-suffix="k"
                    data-dash="0,5" data-labels='@json($revenue['labels'])' data-series='@json($revenue['series'])'
                    data-colors='["--chart-1", "--chart-5"]' class="w-full"></div>
            </div>
        </x-card>

        <x-card class="flex flex-col p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Monthly goal</h2>
                    <p class="mt-1 text-xs text-muted">October revenue target</p>
                </div>
                <x-badge tone="positive">On track</x-badge>
            </div>

            <div class="relative mx-auto mt-6 grid size-[184px] place-items-center">
                <div class="pointer-events-none absolute inset-6 rounded-full bg-brand/10 blur-2xl"></div>
                <svg viewBox="0 0 160 160" class="size-full -rotate-90" aria-hidden="true">
                    <defs>
                        <linearGradient id="goalGradient" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="var(--chart-1)" />
                            <stop offset="100%" stop-color="var(--chart-4)" />
                        </linearGradient>
                    </defs>
                    <circle cx="80" cy="80" r="68" fill="none" stroke="var(--surface-3)" stroke-width="10" />
                    <circle cx="80" cy="80" r="68" fill="none" stroke="url(#goalGradient)" stroke-width="10"
                        stroke-linecap="round" stroke-dasharray="{{ round($circumference, 2) }}"
                        stroke-dashoffset="{{ round($circumference * (1 - $goal['percent'] / 100), 2) }}" />
                </svg>
                <div class="absolute text-center">
                    <p class="tabular text-[34px] font-semibold leading-none tracking-[-0.04em] text-ink">
                        {{ $goal['percent'] }}%</p>
                    <p class="mt-1.5 text-[9px] font-semibold uppercase tracking-[0.18em] text-faint">Completed</p>
                </div>
            </div>

            <dl class="mt-6 space-y-3 text-[13px]">
                <div class="flex items-center justify-between gap-3">
                    <dt class="text-muted">Achieved</dt>
                    <dd class="tabular font-semibold text-ink">{{ $goal['achieved'] }}</dd>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <dt class="text-muted">Target</dt>
                    <dd class="tabular font-semibold text-ink">{{ $goal['target'] }}</dd>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <dt class="text-muted">Remaining</dt>
                    <dd class="tabular font-semibold text-ink">{{ $goal['remaining'] }}</dd>
                </div>
            </dl>

            <div class="mt-auto pt-5">
                <div
                    class="flex items-center justify-between gap-3 rounded-xl bg-surface-2 px-3 py-2.5 ring-1 ring-inset ring-line/70">
                    <span class="inline-flex items-center gap-2 text-xs text-muted">
                        <x-icon name="clock" :size="14" class="text-faint" />
                        {{ $goal['daysLeft'] }} days left
                    </span>
                    <a href="{{ route('analytics') }}"
                        class="group inline-flex items-center gap-1 text-xs font-semibold text-ink">
                        View report
                        <x-icon name="arrow-right" :size="13"
                            class="transition-transform group-hover:translate-x-0.5" />
                    </a>
                </div>
            </div>
        </x-card>
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Transactions and products">
        <x-card class="overflow-hidden xl:col-span-2">
            <div class="flex items-start justify-between gap-3 p-5">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Recent transactions</h2>
                    <p class="mt-1 text-xs text-muted">Latest payments from your customers</p>
                </div>
                <a href="{{ route('orders') }}"
                    class="group inline-flex items-center gap-1 text-xs font-semibold text-ink">
                    View all
                    <x-icon name="arrow-right" :size="13" class="transition-transform group-hover:translate-x-0.5" />
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[680px] text-left">
                    <thead>
                        <tr
                            class="border-y border-line bg-surface-2/70 text-[10px] font-semibold uppercase tracking-[0.12em] text-faint">
                            <th scope="col" class="px-5 py-3">Customer</th>
                            <th scope="col" class="px-5 py-3">Order</th>
                            <th scope="col" class="px-5 py-3">Date</th>
                            <th scope="col" class="px-5 py-3">Status</th>
                            <th scope="col" class="px-5 py-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($transactions as $transaction)
                        <tr class="group transition-colors hover:bg-surface-2/60">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <x-avatar :name="$transaction['name']" :tone="$transaction['tone']" size="md" />
                                    <div class="min-w-0">
                                        <p class="truncate text-[13px] font-semibold text-ink">
                                            {{ $transaction['name'] }}</p>
                                        <p class="truncate text-[11px] text-faint">{{ $transaction['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="tabular whitespace-nowrap px-5 py-3.5 text-xs font-medium text-muted">
                                {{ $transaction['id'] }}</td>
                            <td class="whitespace-nowrap px-5 py-3.5 text-xs text-muted">{{ $transaction['date'] }}</td>
                            <td class="px-5 py-3.5">
                                <x-badge :tone="$statusTones[$transaction['status']] ?? 'neutral'">
                                    {{ $transaction['status'] }}</x-badge>
                            </td>
                            <td
                                class="tabular whitespace-nowrap px-5 py-3.5 text-right text-[13px] font-semibold text-ink">
                                {{ $transaction['amount'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="flex flex-col">
            <div class="flex items-start justify-between gap-3 p-5 pb-2">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Top products</h2>
                    <p class="mt-1 text-xs text-muted">By revenue this month</p>
                </div>
                <a href="{{ route('orders') }}"
                    class="group inline-flex items-center gap-1 text-xs font-semibold text-ink">
                    View all
                    <x-icon name="arrow-right" :size="13" class="transition-transform group-hover:translate-x-0.5" />
                </a>
            </div>

            <div class="p-2">
                @foreach ($products as $product)
                @php
                $productTones = [
                'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
                'info' => 'bg-info-soft text-info',
                'positive' => 'bg-positive-soft text-positive',
                'warning' => 'bg-warning-soft text-warning',
                ];
                @endphp
                <div class="flex items-center gap-3 rounded-xl p-3 transition hover:bg-surface-2">
                    <span
                        class="grid size-10 shrink-0 place-items-center rounded-xl ring-1 ring-inset ring-black/[0.03] dark:ring-white/[0.04] {{ $productTones[$product['tone']] ?? $productTones['brand'] }}">
                        <x-icon name="layers" :size="17" />
                    </span>

                    <div class="min-w-0 flex-1">
                        <p class="truncate text-[13px] font-semibold text-ink">{{ $product['name'] }}</p>
                        <p class="text-[11px] text-faint">{{ $product['category'] }} · {{ $product['sales'] }} sales</p>
                    </div>

                    <div class="shrink-0 text-right">
                        <p class="tabular text-[13px] font-semibold text-ink">{{ $product['revenue'] }}</p>
                        <p
                            class="text-[11px] font-semibold {{ $product['trend'] === 'up' ? 'text-positive' : 'text-negative' }}">
                            {{ $product['growth'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-auto border-t border-line p-4">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-muted">Total product revenue</span>
                    <span class="tabular font-semibold text-ink">$29,000</span>
                </div>
            </div>
        </x-card>
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Traffic, activity and insights">
        <x-card class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Traffic sources</h2>
                    <p class="mt-1 text-xs text-muted">Where your visitors come from</p>
                </div>
                <a href="{{ route('analytics') }}"
                    class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-2 hover:text-ink"
                    aria-label="Open analytics">
                    <x-icon name="arrow-up-right" :size="15" />
                </a>
            </div>

            <div id="channelChart" data-chart="donut" data-height="206" data-total="24.8k" data-total-label="Visitors"
                data-labels='@json(collect($channels)->pluck(' name'))' data-series='@json(collect($channels)->pluck('
                value'))' data-colors='["--chart-1", "--chart-2", "--chart-3", "--chart-4"]' class="mt-2 w-full"></div>

            <ul class="mt-2 space-y-3">
                @foreach ($channels as $channel)
                <li class="flex items-center gap-3 text-xs">
                    <span class="size-2 rounded-full {{ $channel['color'] }}"></span>
                    <span class="min-w-0 flex-1 truncate text-muted">{{ $channel['name'] }}</span>
                    <span class="tabular font-semibold text-ink">{{ $channel['value'] }}%</span>
                    <span class="tabular w-14 text-right text-faint">{{ $channel['amount'] }}</span>
                </li>
                @endforeach
            </ul>
        </x-card>

        <x-card class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Recent activity</h2>
                    <p class="mt-1 text-xs text-muted">Updates from your workspace</p>
                </div>
                <a href="#"
                    class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-2 hover:text-ink"
                    aria-label="View all activity">
                    <x-icon name="ellipsis" :size="16" />
                </a>
            </div>

            <ol
                class="relative mt-5 space-y-5 before:absolute before:left-[19px] before:top-2 before:h-[calc(100%-24px)] before:w-px before:bg-line">
                @foreach ($activities as $activity)
                @php
                $activityTones = [
                'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
                'positive' => 'bg-positive-soft text-positive',
                'info' => 'bg-info-soft text-info',
                'warning' => 'bg-warning-soft text-warning',
                ];
                @endphp
                <li class="relative flex gap-3">
                    <span
                        class="relative z-10 grid size-10 shrink-0 place-items-center rounded-full border border-line bg-surface {{ $activityTones[$activity['tone']] ?? $activityTones['brand'] }}">
                        <x-icon :name="$activity['icon']" :size="16" />
                    </span>

                    <div class="min-w-0 flex-1 pt-0.5">
                        <p class="text-[13px] font-medium leading-snug text-ink">{{ $activity['name'] }}</p>
                        <p class="mt-0.5 truncate text-[11px] text-faint">{{ $activity['meta'] }}</p>
                    </div>

                    <span class="shrink-0 pt-0.5 text-[10px] font-medium text-faint">{{ $activity['time'] }}</span>
                </li>
                @endforeach
            </ol>
        </x-card>

        <div class="relative overflow-hidden rounded-2xl border border-ink bg-ink p-5 text-canvas shadow-card">
            <div class="pointer-events-none absolute -right-16 -top-20 size-56 rounded-full bg-brand/40 blur-3xl"></div>
            <div
                class="pointer-events-none absolute -bottom-20 -left-12 size-48 rounded-full bg-[var(--chart-4)]/25 blur-3xl">
            </div>
            <div class="pointer-events-none absolute inset-0 bg-dots opacity-[0.08]"></div>

            <div class="relative flex h-full flex-col">
                <span
                    class="inline-flex w-fit items-center gap-1.5 rounded-full bg-canvas/10 px-2.5 py-1 text-[9px] font-semibold uppercase tracking-[0.16em] ring-1 ring-inset ring-canvas/15">
                    <x-icon name="sparkles" :size="11" :stroke="2" />
                    Smart insight
                </span>

                <p class="mt-5 font-serif text-[26px] leading-[1.15] tracking-[-0.01em]">
                    Your retention is up 8.4% this week.
                </p>

                <p class="mt-2.5 max-w-xs text-xs leading-relaxed text-canvas/65">
                    Customers who activated Atlas Analytics renewed 2.3× more often. Consider featuring it in
                    onboarding.
                </p>

                <div class="mt-auto pt-6">
                    <div class="flex items-center justify-between text-[11px] text-canvas/60">
                        <span>Confidence</span>
                        <span class="font-semibold text-canvas">92%</span>
                    </div>
                    <div class="mt-2 h-1.5 overflow-hidden rounded-full bg-canvas/15">
                        <div class="h-full w-[92%] rounded-full bg-gradient-to-r from-brand to-[var(--chart-4)]"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>