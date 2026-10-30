@props(['heading' => 'Overview'])

@php
$notifications = [
['title' => 'Payment received', 'meta' => 'Reyqie paid invoice #AUR-2048', 'time' => '2m', 'icon' => 'credit-card',
'tone' => 'positive', 'unread' => true],
['title' => 'New team member', 'meta' => 'Maya Collins joined the Design space', 'time' => '1h', 'icon' => 'user-plus',
'tone' => 'info', 'unread' => true],
['title' => 'Goal almost reached', 'meta' => 'You are 72% towards the monthly target', 'time' => '3h', 'icon' =>
'target', 'tone' => 'warning', 'unread' => true],
['title' => 'Weekly report ready', 'meta' => 'Your analytics summary is available', 'time' => '1d', 'icon' =>
'file-text', 'tone' => 'brand', 'unread' => false],
];

$tones = [
'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
'positive' => 'bg-positive-soft text-positive',
'info' => 'bg-info-soft text-info',
'warning' => 'bg-warning-soft text-warning',
];
@endphp

<header class="sticky top-0 z-30 border-b border-line bg-canvas/75 backdrop-blur-xl">
    <div class="flex h-[72px] items-center gap-3 px-4 sm:px-6 lg:px-8">
        <button type="button" data-sidebar-open
            class="grid size-10 shrink-0 place-items-center rounded-xl border border-line bg-surface text-muted transition hover:text-ink lg:hidden"
            aria-label="Open navigation">
            <x-icon name="menu" :size="18" />
        </button>

        <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 lg:hidden">
            <span class="grid size-8 place-items-center rounded-xl bg-ink text-canvas">
                <span class="font-serif text-[18px] leading-none italic">a</span>
            </span>
            <span class="hidden font-serif text-xl tracking-tight text-ink min-[360px]:inline">Aurelia</span>
        </a>

        <div class="hidden items-center gap-2 text-[13px] sm:flex lg:ml-1">
            <span class="text-faint">Workspace</span>
            <x-icon name="chevron-right" :size="13" class="text-faint" />
            <span class="font-medium text-ink">{{ $heading }}</span>
        </div>

        <div class="ml-auto flex items-center gap-2 sm:gap-2.5">
            <div class="relative hidden md:block">
                <x-icon name="search" :size="16"
                    class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 text-faint" />
                <input id="global-search" type="search" placeholder="Search anything…" autocomplete="off"
                    class="h-10 w-56 rounded-xl border border-line bg-surface pl-9 pr-14 text-[13px] text-ink outline-none transition placeholder:text-faint focus:w-64 focus:border-line-strong focus:ring-4 focus:ring-brand/10 xl:w-64" />
                <kbd
                    class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 rounded-md border border-line bg-surface-2 px-1.5 py-0.5 font-sans text-[10px] font-medium text-faint">⌘K</kbd>
            </div>

            <button type="button" data-theme-toggle
                class="relative grid size-10 shrink-0 place-items-center rounded-xl border border-line bg-surface text-muted transition hover:text-ink"
                aria-label="Toggle color theme">
                <x-icon name="sun" :size="18" class="theme-icon theme-icon-sun" />
                <x-icon name="moon" :size="18" class="theme-icon theme-icon-moon absolute" />
            </button>

            <div class="relative">
                <button type="button" data-dropdown-trigger aria-expanded="false" aria-haspopup="true"
                    aria-label="Notifications"
                    class="relative grid size-10 shrink-0 place-items-center rounded-xl border border-line bg-surface text-muted transition hover:text-ink">
                    <x-icon name="bell" :size="18" />
                    <span class="absolute right-2.5 top-2.5 size-1.5 rounded-full bg-brand ring-2 ring-surface"></span>
                </button>

                <div data-dropdown-panel
                    class="absolute right-0 top-[52px] z-50 hidden w-[340px] overflow-hidden rounded-2xl border border-line bg-surface shadow-float">
                    <div class="flex items-center justify-between border-b border-line px-4 py-3.5">
                        <p class="text-sm font-semibold text-ink">Notifications</p>
                        <span
                            class="rounded-full bg-brand-soft px-2 py-0.5 text-[10px] font-semibold text-brand-ink dark:text-brand">3
                            new</span>
                    </div>

                    <div class="max-h-[320px] overflow-y-auto p-1.5">
                        @foreach ($notifications as $notification)
                        <a href="#" class="flex gap-3 rounded-xl p-2.5 transition hover:bg-surface-2">
                            <span
                                class="grid size-9 shrink-0 place-items-center rounded-xl {{ $tones[$notification['tone']] ?? $tones['brand'] }}">
                                <x-icon :name="$notification['icon']" :size="16" />
                            </span>
                            <span class="min-w-0 flex-1">
                                <span class="flex items-center gap-2">
                                    <span
                                        class="truncate text-[13px] font-semibold text-ink">{{ $notification['title'] }}</span>
                                    @if ($notification['unread'])
                                    <span class="size-1.5 shrink-0 rounded-full bg-brand"></span>
                                    @endif
                                </span>
                                <span
                                    class="mt-0.5 block truncate text-xs text-muted">{{ $notification['meta'] }}</span>
                            </span>
                            <span class="shrink-0 text-[10px] font-medium text-faint">{{ $notification['time'] }}</span>
                        </a>
                        @endforeach
                    </div>

                    <a href="#"
                        class="flex items-center justify-center gap-1.5 border-t border-line px-4 py-3 text-xs font-semibold text-ink transition hover:bg-surface-2">
                        View all notifications
                        <x-icon name="arrow-right" :size="13" />
                    </a>
                </div>
            </div>

            <div class="relative">
                <button type="button" data-dropdown-trigger aria-expanded="false" aria-haspopup="true"
                    aria-label="Account menu"
                    class="flex items-center gap-2 rounded-xl border border-line bg-surface p-1.5 pr-2 text-left transition hover:border-line-strong">
                    <x-avatar name="Reyqie" tone="brand" size="sm" />
                    <span class="hidden leading-tight xl:block">
                        <span class="block text-[12px] font-semibold text-ink">Reyqie</span>
                        <span class="block text-[10px] text-faint">Administrator</span>
                    </span>
                    <x-icon name="chevron-down" :size="14" class="hidden text-faint xl:block" />
                </button>

                <div data-dropdown-panel
                    class="absolute right-0 top-[52px] z-50 hidden w-64 overflow-hidden rounded-2xl border border-line bg-surface shadow-float">
                    <div class="border-b border-line px-4 py-3.5">
                        <p class="text-sm font-semibold text-ink">Reyqie</p>
                        <p class="mt-0.5 truncate text-xs text-muted">reyqie@northwind.co</p>
                    </div>

                    <div class="p-1.5">
                        <a href="{{ route('settings') }}"
                            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] text-muted transition hover:bg-surface-2 hover:text-ink">
                            <x-icon name="user" :size="16" />
                            Profile settings
                        </a>
                        <a href="{{ route('settings') }}"
                            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] text-muted transition hover:bg-surface-2 hover:text-ink">
                            <x-icon name="credit-card" :size="16" />
                            Billing & invoices
                        </a>
                        <a href="{{ route('settings') }}"
                            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] text-muted transition hover:bg-surface-2 hover:text-ink">
                            <x-icon name="palette" :size="16" />
                            Appearance
                        </a>
                    </div>

                    <div class="border-t border-line p-1.5">
                        <a href="#"
                            class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-[13px] text-muted transition hover:bg-negative-soft hover:text-negative">
                            <x-icon name="log-out" :size="16" />
                            Sign out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>