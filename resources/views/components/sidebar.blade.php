@php
$navigation = [
[
'label' => 'Workspace',
'items' => [
['name' => 'Overview', 'route' => 'dashboard', 'icon' => 'layout-dashboard'],
['name' => 'Analytics', 'route' => 'analytics', 'icon' => 'chart-line'],
['name' => 'Orders', 'route' => 'orders', 'icon' => 'shopping-bag', 'badge' => '12'],
['name' => 'Customers', 'route' => 'customers', 'icon' => 'users'],
],
],
[
'label' => 'Account',
'items' => [
['name' => 'Settings', 'route' => 'settings', 'icon' => 'settings'],
],
],
];
@endphp

<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-[276px] -translate-x-full flex-col border-r border-line bg-canvas-soft/90 backdrop-blur-2xl transition-transform duration-300 ease-out lg:translate-x-0"
    aria-label="Sidebar">
    <div class="flex h-[72px] shrink-0 items-center justify-between px-5">
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3">
            <span
                class="relative grid size-10 place-items-center rounded-2xl bg-ink text-canvas shadow-[0_10px_30px_-12px_rgba(91,76,245,0.55)]">
                <span class="font-serif text-[24px] leading-none italic">a</span>
                <span
                    class="absolute -right-0.5 -top-0.5 size-2.5 rounded-full border-2 border-canvas-soft bg-brand"></span>
            </span>
            <span class="flex flex-col leading-tight">
                <span class="font-serif text-[23px] tracking-[-0.01em] text-ink">Aurelia</span>
                <span class="text-[9px] font-semibold uppercase tracking-[0.22em] text-faint">Admin suite</span>
            </span>
        </a>

        <button type="button" data-sidebar-close
            class="grid size-9 place-items-center rounded-lg text-muted transition hover:bg-surface-2 hover:text-ink lg:hidden"
            aria-label="Close navigation">
            <x-icon name="x" :size="18" />
        </button>
    </div>

    <div class="px-4">
        <button type="button"
            class="flex w-full items-center gap-3 rounded-xl border border-line bg-surface p-2.5 text-left shadow-[0_1px_2px_rgb(var(--shadow-color)/0.03)] transition hover:border-line-strong">
            <span
                class="grid size-9 shrink-0 place-items-center rounded-lg bg-gradient-to-br from-brand to-[var(--chart-4)] text-sm font-semibold text-white">N</span>
            <span class="min-w-0 flex-1">
                <span class="block truncate text-[13px] font-semibold text-ink">Northwind Labs</span>
                <span class="block text-[11px] text-faint">Scale plan · 24 members</span>
            </span>
            <x-icon name="chevrons-up-down" :size="15" class="text-faint" />
        </button>
    </div>

    <nav class="mt-7 flex-1 overflow-y-auto px-4 pb-5">
        @foreach ($navigation as $group)
        <div class="{{ $loop->first ? '' : 'mt-7' }}">
            <p class="px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-faint">{{ $group['label'] }}</p>

            <div class="mt-2.5 space-y-1">
                @foreach ($group['items'] as $item)
                @php($isActive = request()->routeIs($item['route']))
                <a href="{{ route($item['route']) }}" @if ($isActive) aria-current="page" @endif
                    class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-[13px] font-medium transition duration-200 {{ $isActive ? 'bg-ink text-canvas shadow-[0_10px_24px_-14px_rgb(var(--shadow-color)/0.8)]' : 'text-muted hover:bg-surface-2 hover:text-ink' }}">
                    <x-icon :name="$item['icon']" :size="18" :stroke="$isActive ? 2 : 1.8"
                        class="{{ $isActive ? '' : 'text-faint transition group-hover:text-ink' }}" />
                    <span class="flex-1">{{ $item['name'] }}</span>

                    @isset($item['badge'])
                    <span
                        class="rounded-md px-1.5 py-0.5 text-[10px] font-semibold tabular {{ $isActive ? 'bg-canvas/15 text-canvas' : 'bg-surface-3 text-muted' }}">{{ $item['badge'] }}</span>
                    @endisset
                </a>
                @endforeach
            </div>
        </div>
        @endforeach

        <div class="relative mt-8 overflow-hidden rounded-2xl border border-line bg-surface p-4 shadow-card">
            <div class="pointer-events-none absolute -right-10 -top-12 size-32 rounded-full bg-brand/20 blur-3xl"></div>
            <div
                class="pointer-events-none absolute -bottom-12 -left-10 size-28 rounded-full bg-[var(--chart-4)]/15 blur-3xl">
            </div>

            <div class="relative">
                <span
                    class="inline-flex items-center gap-1.5 rounded-full bg-brand-soft px-2 py-1 text-[9px] font-semibold uppercase tracking-[0.16em] text-brand-ink dark:text-brand">
                    <x-icon name="sparkles" :size="11" :stroke="2" />
                    Aurelia Pro
                </span>
                <p class="mt-3 font-serif text-[21px] leading-tight tracking-[-0.01em] text-ink">Unlock deeper insights
                </p>
                <p class="mt-1 text-[11px] leading-relaxed text-muted">Advanced reports, unlimited exports and priority
                    support.</p>
                <x-button variant="primary" size="sm" class="mt-3.5 w-full">Upgrade plan</x-button>
            </div>
        </div>
    </nav>

    <div class="shrink-0 border-t border-line p-3">
        <div class="flex items-center gap-3 rounded-xl p-1.5 transition hover:bg-surface-2">
            <x-avatar name="Reyqie" tone="brand" size="md" status="online" />
            <a href="{{ route('settings') }}" class="min-w-0 flex-1">
                <span class="block truncate text-[13px] font-semibold text-ink">Reyqie</span>
                <span class="block truncate text-[11px] text-faint">reyqie@northwind.co</span>
            </a>
            <a href="#"
                class="grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-3 hover:text-ink"
                aria-label="Sign out">
                <x-icon name="log-out" :size="16" />
            </a>
        </div>
    </div>
</aside>