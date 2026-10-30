@php
    $deviceDots = ['bg-[var(--chart-1)]', 'bg-[var(--chart-2)]', 'bg-[var(--chart-3)]'];
@endphp

<x-layouts.app title="Analytics" heading="Analytics">
    <x-page-header
        eyebrow="Performance report"
        title="Analytics"
        accent="overview"
        description="Track how people discover, explore and convert on your product across every channel."
    >
        <x-slot:actions>
            <x-button variant="secondary" icon="calendar">
                Last 6 months
                <x-icon name="chevron-down" :size="14" class="text-faint" />
            </x-button>
            <x-button variant="primary" icon="download">Export CSV</x-button>
        </x-slot:actions>
    </x-page-header>

    <section aria-label="Audience metrics" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <x-stat-card
                :label="$stat['label']"
                :value="$stat['value']"
                :delta="$stat['delta']"
                :trend="$stat['trend']"
                :icon="$stat['icon']"
                :tone="$stat['label'] === 'Bounce rate' ? 'positive' : ($loop->index === 1 ? 'info' : ($loop->index === 2 ? 'warning' : 'brand'))"
                :positive="$stat['label'] === 'Bounce rate' ? true : null"
            />
        @endforeach
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Traffic trends">
        <x-card class="overflow-hidden xl:col-span-2">
            <div class="flex flex-col gap-4 border-b border-line p-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Sessions &amp; conversions</h2>
                    <p class="mt-1 text-xs text-muted">Traffic and conversion volume over time</p>

                    <div class="mt-4 flex flex-wrap items-end gap-3">
                        <p class="tabular text-[28px] font-semibold leading-none tracking-[-0.03em] text-ink">248,920</p>
                        <x-delta value="+18.2%" trend="up" caption="vs previous period" />
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-4 sm:justify-end">
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-brand"></span>
                        Sessions
                    </span>
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-positive"></span>
                        Conversions
                    </span>
                </div>
            </div>

            <div class="p-3 sm:p-4">
                <div
                    id="sessionsChart"
                    data-chart="area"
                    data-height="300"
                    data-dash="0,5"
                    data-labels='@json($sessions['labels'])'
                    data-series='@json($sessions['series'])'
                    data-colors='["--chart-1", "--chart-2"]'
                    class="w-full"
                ></div>
            </div>
        </x-card>

        <x-card class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Devices</h2>
                    <p class="mt-1 text-xs text-muted">Sessions by device type</p>
                </div>
                <x-badge tone="brand" :dot="false">96.4k total</x-badge>
            </div>

            <div
                id="devicesChart"
                data-chart="donut"
                data-height="240"
                data-total="{{ $devices['total'] }}"
                data-total-label="{{ $devices['totalLabel'] }}"
                data-labels='@json($devices['labels'])'
                data-series='@json($devices['series'])'
                class="mt-3 w-full"
            ></div>

            <ul class="mt-2 space-y-3">
                @foreach ($devices['labels'] as $index => $label)
                    <li class="flex items-center gap-3 text-xs">
                        <span class="size-2 rounded-full {{ $deviceDots[$index] ?? 'bg-brand' }}"></span>
                        <span class="flex-1 text-muted">{{ $label }}</span>
                        <span class="tabular font-semibold text-ink">{{ $devices['series'][$index] }}%</span>
                    </li>
                @endforeach
            </ul>
        </x-card>
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Content and acquisition">
        <x-card class="overflow-hidden xl:col-span-2">
            <div class="flex items-start justify-between gap-3 p-5">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Top pages</h2>
                    <p class="mt-1 text-xs text-muted">Most visited pages in the last 30 days</p>
                </div>
                <a href="#" class="group inline-flex items-center gap-1 text-xs font-semibold text-ink">
                    Full report
                    <x-icon name="arrow-right" :size="13" class="transition-transform group-hover:translate-x-0.5" />
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[620px] text-left">
                    <thead>
                        <tr class="border-y border-line bg-surface-2/70 text-[10px] font-semibold uppercase tracking-[0.12em] text-faint">
                            <th scope="col" class="px-5 py-3">Page</th>
                            <th scope="col" class="px-5 py-3 text-right">Views</th>
                            <th scope="col" class="px-5 py-3 text-right">Unique</th>
                            <th scope="col" class="px-5 py-3 text-right">Bounce</th>
                            <th scope="col" class="px-5 py-3 text-right">Trend</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($pages as $page)
                            <tr class="transition-colors hover:bg-surface-2/60">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-surface-2 text-faint ring-1 ring-inset ring-line">
                                            <x-icon name="file-text" :size="15" />
                                        </span>
                                        <div class="min-w-0">
                                            <p class="truncate text-[13px] font-semibold text-ink">{{ $page['title'] }}</p>
                                            <p class="truncate font-mono text-[11px] text-faint">{{ $page['path'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-xs font-medium text-ink">{{ $page['views'] }}</td>
                                <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-xs text-muted">{{ $page['unique'] }}</td>
                                <td class="tabular whitespace-nowrap px-5 py-3.5 text-right text-xs text-muted">{{ $page['bounce'] }}</td>
                                <td class="whitespace-nowrap px-5 py-3.5 text-right">
                                    <x-delta :value="$page['delta']" :trend="$page['trend']" size="xs" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

        <x-card class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Acquisition</h2>
                    <p class="mt-1 text-xs text-muted">Sessions by channel</p>
                </div>
                <a href="#" class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-2 hover:text-ink" aria-label="Acquisition details">
                    <x-icon name="arrow-up-right" :size="15" />
                </a>
            </div>

            <ul class="mt-6 space-y-5">
                @foreach ($acquisition as $channel)
                    <li>
                        <div class="flex items-center justify-between gap-3 text-xs">
                            <span class="font-medium text-ink">{{ $channel['label'] }}</span>
                            <span class="tabular font-semibold text-ink">{{ $channel['value'] }}%</span>
                        </div>
                        <x-progress :value="$channel['value']" class="mt-2.5" />
                        <p class="mt-1.5 text-[11px] text-faint">{{ $channel['amount'] }} sessions</p>
                    </li>
                @endforeach
            </ul>
        </x-card>
    </section>

    <section class="mt-5 grid grid-cols-1 gap-5 xl:grid-cols-3" aria-label="Revenue targets and geography">
        <x-card class="overflow-hidden xl:col-span-2">
            <div class="flex flex-col gap-4 border-b border-line p-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Revenue vs target</h2>
                    <p class="mt-1 text-xs text-muted">Monthly performance against plan</p>
                </div>

                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-brand"></span>
                        Actual
                    </span>
                    <span class="inline-flex items-center gap-2 text-[11px] font-medium text-muted">
                        <span class="size-2 rounded-full bg-[var(--chart-3)]"></span>
                        Target
                    </span>
                </div>
            </div>

            <div class="p-3 sm:p-4">
                <div
                    id="targetChart"
                    data-chart="bar"
                    data-height="288"
                    data-prefix="$"
                    data-suffix="k"
                    data-labels='@json($target['labels'])'
                    data-series='@json($target['series'])'
                    data-colors='["--chart-1", "--chart-3"]'
                    class="w-full"
                ></div>
            </div>
        </x-card>

        <x-card class="p-5">
            <div class="flex items-start justify-between gap-3">
                <div>
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Top countries</h2>
                    <p class="mt-1 text-xs text-muted">Audience by location</p>
                </div>
                <x-icon name="globe" :size="18" class="text-faint" />
            </div>

            <ul class="mt-6 space-y-5">
                @foreach ($countries as $country)
                    <li class="flex items-center gap-3">
                        <span class="grid size-9 shrink-0 place-items-center rounded-lg bg-surface-2 text-[10px] font-bold tracking-wide text-muted ring-1 ring-inset ring-line">{{ $country['code'] }}</span>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2 text-xs">
                                <span class="truncate font-medium text-ink">{{ $country['name'] }}</span>
                                <span class="tabular font-semibold text-ink">{{ $country['value'] }}%</span>
                            </div>
                            <x-progress :value="$country['value']" tone="ink" height="h-1" class="mt-2" />
                        </div>
                        <span class="tabular w-14 shrink-0 text-right text-[11px] text-faint">{{ $country['amount'] }}</span>
                    </li>
                @endforeach
            </ul>
        </x-card>
    </section>
</x-layouts.app>
