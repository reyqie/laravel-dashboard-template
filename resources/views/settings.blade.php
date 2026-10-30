@php
$tabs = [
['key' => 'profile', 'label' => 'Profile', 'icon' => 'user'],
['key' => 'appearance', 'label' => 'Appearance', 'icon' => 'palette'],
['key' => 'notifications', 'label' => 'Notifications', 'icon' => 'bell'],
['key' => 'billing', 'label' => 'Billing', 'icon' => 'credit-card'],
['key' => 'security', 'label' => 'Security', 'icon' => 'shield-check'],
];

$inputClass = 'h-10 w-full rounded-xl border border-line bg-surface px-3.5 text-[13px] text-ink outline-none transition
placeholder:text-faint focus:border-brand/50 focus:ring-4 focus:ring-brand/10';
$labelClass = 'mb-1.5 block text-[11px] font-semibold uppercase tracking-[0.12em] text-faint';
@endphp

<x-layouts.app title="Settings" heading="Settings">
    <x-page-header eyebrow="Workspace preferences" title="Settings"
        description="Manage your personal profile, appearance, notifications and workspace billing.">
        <x-slot:actions>
            <x-button variant="ghost">Discard</x-button>
            <x-button variant="primary" icon="check">Save changes</x-button>
        </x-slot:actions>
    </x-page-header>

    <div class="grid grid-cols-1 gap-5 lg:grid-cols-[236px_minmax(0,1fr)]">
        <x-card class="h-fit p-2 lg:sticky lg:top-24">
            <nav class="flex gap-1 overflow-x-auto lg:flex-col" aria-label="Settings sections">
                @foreach ($tabs as $tab)
                <button type="button" data-settings-tab="{{ $tab['key'] }}"
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                    class="settings-tab flex w-full shrink-0 items-center gap-2.5 rounded-xl px-3 py-2.5 text-[13px] font-medium {{ $loop->first ? 'is-active' : '' }}">
                    <x-icon :name="$tab['icon']" :size="17" />
                    {{ $tab['label'] }}
                </button>
                @endforeach
            </nav>
        </x-card>

        <div class="min-w-0">
            <div data-settings-panel="profile" class="space-y-5">
                <x-card class="p-5 sm:p-6">
                    <div>
                        <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Profile information</h2>
                        <p class="mt-1 text-xs text-muted">This is how you appear across the Aurelia workspace.</p>
                    </div>

                    <div class="mt-6 flex flex-col gap-4 border-b border-line pb-6 sm:flex-row sm:items-center">
                        <x-avatar name="Reyqie" tone="brand" size="xl" status="online" />

                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <x-button variant="secondary" size="sm" icon="upload">Upload new photo</x-button>
                                <x-button variant="ghost" size="sm">Remove</x-button>
                            </div>
                            <p class="mt-2 text-[11px] text-faint">PNG, JPG or GIF. Recommended 400×400px, max 2 MB.</p>
                        </div>
                    </div>

                    <form class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2" onsubmit="return false;">
                        <label class="block">
                            <span class="{{ $labelClass }}">First name</span>
                            <input type="text" value="Reyqie" class="{{ $inputClass }}">
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Last name</span>
                            <input type="text" value="Code" class="{{ $inputClass }}">
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Email address</span>
                            <span class="relative block">
                                <input type="email" value="reyqie@northwind.co" class="{{ $inputClass }} pr-24">
                                <span class="absolute right-2.5 top-1/2 -translate-y-1/2">
                                    <x-badge tone="positive">
                                        <x-icon name="check" :size="10" :stroke="3" /> Verified
                                    </x-badge>
                                </span>
                            </span>
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Role</span>
                            <select class="{{ $inputClass }} ">
                                <option>Administrator</option>
                                <option>Product designer</option>
                                <option>Engineer</option>
                                <option>Viewer</option>
                            </select>
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Company</span>
                            <input type="text" value="Northwind Labs" class="{{ $inputClass }}">
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Timezone</span>
                            <select class="{{ $inputClass }} ">
                                <option>GMT+7 · Jakarta</option>
                                <option>GMT+1 · Berlin</option>
                                <option>GMT+0 · London</option>
                                <option>GMT-5 · New York</option>
                            </select>
                        </label>

                        <label class="block sm:col-span-2">
                            <span class="{{ $labelClass }}">Bio</span>
                            <textarea rows="3"
                                class="{{ $inputClass }} h-auto py-3 leading-relaxed">Product-minded designer building calm, useful interfaces for data-heavy teams.</textarea>
                        </label>
                    </form>
                </x-card>

                <x-card class="border-negative/20 p-5 sm:p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Delete account</h2>
                            <p class="mt-1 max-w-lg text-xs leading-relaxed text-muted">Once deleted, your workspace,
                                reports and billing history cannot be recovered.</p>
                        </div>
                        <x-button variant="secondary" size="sm"
                            class="border-negative/30 text-negative hover:bg-negative-soft">Delete account</x-button>
                    </div>
                </x-card>
            </div>

            <div data-settings-panel="appearance" class="hidden space-y-5">
                <x-card class="p-5 sm:p-6">
                    <div>
                        <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Interface theme</h2>
                        <p class="mt-1 text-xs text-muted">Choose how Aurelia looks. Your choice is saved on this
                            device.</p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-3" role="radiogroup"
                        aria-label="Interface theme">
                        <button type="button" data-theme-choice="light" role="radio" aria-checked="false"
                            class="group relative rounded-xl border border-line bg-surface p-2.5 text-left hover:border-line-strong">
                            <span
                                class="theme-check absolute right-2.5 top-2.5 z-10 grid size-5 place-items-center rounded-full bg-brand text-white shadow-sm">
                                <x-icon name="check" :size="12" :stroke="3" />
                            </span>
                            <span class="block h-24 overflow-hidden rounded-lg border border-black/5 p-2"
                                style="background:#f4f4f0">
                                <span class="flex h-full gap-1.5">
                                    <span class="w-1/4 rounded-md" style="background:#e4e4dc"></span>
                                    <span class="flex flex-1 flex-col gap-1.5">
                                        <span class="h-1.5 w-2/3 rounded-full" style="background:#d5d5cb"></span>
                                        <span class="h-8 rounded-md border border-black/5 bg-white"></span>
                                        <span class="h-1.5 w-1/2 rounded-full" style="background:#d5d5cb"></span>
                                    </span>
                                </span>
                            </span>
                            <span class="mt-2.5 flex items-center gap-2 px-1 pb-0.5 text-[12px] font-semibold text-ink">
                                <x-icon name="sun" :size="14" class="text-faint" />
                                Light
                            </span>
                        </button>

                        <button type="button" data-theme-choice="dark" role="radio" aria-checked="false"
                            class="group relative rounded-xl border border-line bg-surface p-2.5 text-left hover:border-line-strong">
                            <span
                                class="theme-check absolute right-2.5 top-2.5 z-10 grid size-5 place-items-center rounded-full bg-brand text-white shadow-sm">
                                <x-icon name="check" :size="12" :stroke="3" />
                            </span>
                            <span class="block h-24 overflow-hidden rounded-lg border border-white/5 p-2"
                                style="background:#08080a">
                                <span class="flex h-full gap-1.5">
                                    <span class="w-1/4 rounded-md" style="background:#17171c"></span>
                                    <span class="flex flex-1 flex-col gap-1.5">
                                        <span class="h-1.5 w-2/3 rounded-full" style="background:#2c2c34"></span>
                                        <span class="h-8 rounded-md border border-white/5"
                                            style="background:#121216"></span>
                                        <span class="h-1.5 w-1/2 rounded-full" style="background:#2c2c34"></span>
                                    </span>
                                </span>
                            </span>
                            <span class="mt-2.5 flex items-center gap-2 px-1 pb-0.5 text-[12px] font-semibold text-ink">
                                <x-icon name="moon" :size="14" class="text-faint" />
                                Dark
                            </span>
                        </button>

                        <button type="button" data-theme-choice="system" role="radio" aria-checked="false"
                            class="group relative rounded-xl border border-line bg-surface p-2.5 text-left hover:border-line-strong">
                            <span
                                class="theme-check absolute right-2.5 top-2.5 z-10 grid size-5 place-items-center rounded-full bg-brand text-white shadow-sm">
                                <x-icon name="check" :size="12" :stroke="3" />
                            </span>
                            <span class="block h-24 overflow-hidden rounded-lg border border-black/5"
                                style="background:linear-gradient(115deg,#f4f4f0 0 48%,#0b0b0d 48% 100%)">
                                <span class="grid h-full place-items-center">
                                    <span
                                        class="grid size-8 place-items-center rounded-full bg-white/80 text-ink shadow-sm ring-1 ring-black/5">
                                        <x-icon name="monitor" :size="15" />
                                    </span>
                                </span>
                            </span>
                            <span class="mt-2.5 flex items-center gap-2 px-1 pb-0.5 text-[12px] font-semibold text-ink">
                                <x-icon name="contrast" :size="14" class="text-faint" />
                                System
                            </span>
                        </button>
                    </div>
                </x-card>

                <x-card class="p-5 sm:p-6">
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Preferences</h2>
                    <p class="mt-1 text-xs text-muted">Fine-tune the workspace for the way you work.</p>

                    <div class="mt-5 divide-y divide-line">
                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <div>
                                <p class="text-[13px] font-medium text-ink">Reduce motion</p>
                                <p class="mt-0.5 text-xs text-muted">Minimise animations across charts and transitions.
                                </p>
                            </div>
                            <x-toggle name="reduce_motion" label="Reduce motion" />
                        </div>

                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <div>
                                <p class="text-[13px] font-medium text-ink">Compact navigation</p>
                                <p class="mt-0.5 text-xs text-muted">Show a denser sidebar with smaller spacing.</p>
                            </div>
                            <x-toggle name="compact_navigation" label="Compact navigation" />
                        </div>

                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <div>
                                <p class="text-[13px] font-medium text-ink">Show hints</p>
                                <p class="mt-0.5 text-xs text-muted">Display contextual tips in empty and first-use
                                    states.</p>
                            </div>
                            <x-toggle name="show_hints" :checked="true" label="Show hints" />
                        </div>
                    </div>
                </x-card>
            </div>

            <div data-settings-panel="notifications" class="hidden space-y-5">
                <x-card class="p-5 sm:p-6">
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Email notifications</h2>
                    <p class="mt-1 text-xs text-muted">Choose what lands in nadia@northwind.co.</p>

                    <div class="mt-5 divide-y divide-line">
                        @foreach ([
                        ['title' => 'Product updates', 'description' => 'New features, improvements and release notes.',
                        'checked' => true],
                        ['title' => 'Weekly summary', 'description' => 'A digest of revenue, customers and conversion.',
                        'checked' => true],
                        ['title' => 'Invoice & billing', 'description' => 'Payment confirmations and failed charge
                        alerts.', 'checked' => true],
                        ['title' => 'Customer activity', 'description' => 'Sign-ups, upgrades and churn from your
                        workspace.', 'checked' => false],
                        ['title' => 'Marketing emails', 'description' => 'Occasional stories, guides and product
                        offers.', 'checked' => false],
                        ] as $notification)
                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <div>
                                <p class="text-[13px] font-medium text-ink">{{ $notification['title'] }}</p>
                                <p class="mt-0.5 text-xs text-muted">{{ $notification['description'] }}</p>
                            </div>
                            <x-toggle :checked="$notification['checked']" :label="$notification['title']" />
                        </div>
                        @endforeach
                    </div>
                </x-card>

                <x-card class="p-5 sm:p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Push notifications</h2>
                            <p class="mt-1 text-xs text-muted">Real-time alerts on this device.</p>
                        </div>
                        <x-badge tone="warning">Not enabled</x-badge>
                    </div>

                    <div
                        class="mt-5 flex items-center justify-between gap-4 rounded-xl bg-surface-2 p-4 ring-1 ring-inset ring-line/70">
                        <div class="flex items-center gap-3">
                            <span class="grid size-10 place-items-center rounded-xl bg-info-soft text-info">
                                <x-icon name="smartphone" :size="18" />
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-ink">Enable push on this browser</p>
                                <p class="mt-0.5 text-xs text-muted">Get pinged the moment something important happens.
                                </p>
                            </div>
                        </div>
                        <x-button variant="secondary" size="sm">Enable</x-button>
                    </div>
                </x-card>
            </div>

            <div data-settings-panel="billing" class="hidden space-y-5">
                <x-card class="relative overflow-hidden p-5 sm:p-6">
                    <div
                        class="pointer-events-none absolute -right-16 -top-20 size-56 rounded-full bg-brand/10 blur-3xl">
                    </div>

                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-brand-soft px-2.5 py-1 text-[9px] font-semibold uppercase tracking-[0.16em] text-brand-ink dark:text-brand">
                                <x-icon name="zap" :size="11" />
                                Current plan
                            </span>
                            <h2 class="mt-3 text-xl font-semibold tracking-[-0.02em] text-ink">Scale</h2>
                            <p class="mt-1 max-w-sm text-xs leading-relaxed text-muted">Advanced analytics, unlimited
                                exports and priority support for growing teams.</p>
                        </div>

                        <div class="text-left sm:text-right">
                            <p class="tabular text-[30px] font-semibold leading-none tracking-[-0.03em] text-ink">
                                $49<span class="text-sm font-medium text-faint">/mo</span></p>
                            <p class="mt-1.5 text-[11px] text-faint">Renews Nov 30, 2026</p>
                        </div>
                    </div>

                    <div class="relative mt-6">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-muted">Team seats</span>
                            <span class="tabular font-semibold text-ink">24 of 40</span>
                        </div>
                        <x-progress :value="60" class="mt-2.5" />
                    </div>

                    <div class="relative mt-6 flex flex-wrap gap-2">
                        <x-button variant="primary" size="sm">Change plan</x-button>
                        <x-button variant="secondary" size="sm" icon="external-link">View pricing</x-button>
                    </div>
                </x-card>

                <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
                    <x-card class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Payment method</h2>
                                <p class="mt-1 text-xs text-muted">Used for your subscription</p>
                            </div>
                            <x-button variant="ghost" size="sm">Update</x-button>
                        </div>

                        <div class="mt-4 flex items-center gap-3 rounded-xl border border-line bg-surface-2 p-3.5">
                            <span class="grid h-9 w-12 place-items-center rounded-md bg-ink text-canvas">
                                <x-icon name="credit-card" :size="18" />
                            </span>
                            <div>
                                <p class="text-[13px] font-semibold text-ink">Visa ending in 4242</p>
                                <p class="text-[11px] text-faint">Expires 09 / 2029</p>
                            </div>
                            <x-badge tone="positive" class="ml-auto">Default</x-badge>
                        </div>
                    </x-card>

                    <x-card class="p-5">
                        <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Billing contact</h2>
                        <p class="mt-1 text-xs text-muted">Where invoices are delivered</p>

                        <div class="mt-4 space-y-1 text-[13px]">
                            <p class="font-semibold text-ink">Northwind Labs</p>
                            <p class="text-muted">finance@northwind.co</p>
                            <p class="text-muted">VAT ID · ID-8821-4092</p>
                        </div>

                        <button type="button"
                            class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-ink transition hover:gap-2">
                            Edit details
                            <x-icon name="arrow-right" :size="13" />
                        </button>
                    </x-card>
                </div>

                <x-card class="overflow-hidden">
                    <div class="flex items-center justify-between gap-3 p-5">
                        <div>
                            <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Invoices</h2>
                            <p class="mt-1 text-xs text-muted">Download receipts for your records</p>
                        </div>
                        <x-button variant="ghost" size="sm" icon="external-link">Billing portal</x-button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[480px] text-left">
                            <thead>
                                <tr
                                    class="border-y border-line bg-surface-2/70 text-[10px] font-semibold uppercase tracking-[0.12em] text-faint">
                                    <th scope="col" class="px-5 py-3">Invoice</th>
                                    <th scope="col" class="px-5 py-3">Date</th>
                                    <th scope="col" class="px-5 py-3">Amount</th>
                                    <th scope="col" class="px-5 py-3">Status</th>
                                    <th scope="col" class="px-5 py-3 text-right">Receipt</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-line">
                                @foreach ($invoices as $invoice)
                                <tr class="transition-colors hover:bg-surface-2/60">
                                    <td class="tabular px-5 py-3.5 text-[13px] font-semibold text-ink">
                                        {{ $invoice['id'] }}</td>
                                    <td class="whitespace-nowrap px-5 py-3.5 text-xs text-muted">{{ $invoice['date'] }}
                                    </td>
                                    <td class="tabular px-5 py-3.5 text-[13px] font-medium text-ink">
                                        {{ $invoice['amount'] }}</td>
                                    <td class="px-5 py-3.5">
                                        <x-badge tone="positive">{{ $invoice['status'] }}</x-badge>
                                    </td>
                                    <td class="px-5 py-3.5 text-right">
                                        <button type="button"
                                            class="inline-grid size-8 place-items-center rounded-lg text-faint transition hover:bg-surface-3 hover:text-ink"
                                            aria-label="Download invoice {{ $invoice['id'] }}">
                                            <x-icon name="download" :size="15" />
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-card>
            </div>

            <div data-settings-panel="security" class="hidden space-y-5">
                <x-card class="p-5 sm:p-6">
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Password</h2>
                    <p class="mt-1 text-xs text-muted">Use a long, unique password to keep your account safe.</p>

                    <form class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2" onsubmit="return false;">
                        <label class="block sm:col-span-2">
                            <span class="{{ $labelClass }}">Current password</span>
                            <input type="password" value="password" class="{{ $inputClass }}">
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">New password</span>
                            <input type="password" placeholder="••••••••••" class="{{ $inputClass }}">
                        </label>

                        <label class="block">
                            <span class="{{ $labelClass }}">Confirm password</span>
                            <input type="password" placeholder="••••••••••" class="{{ $inputClass }}">
                        </label>
                    </form>

                    <div class="mt-5 flex justify-end">
                        <x-button variant="primary" size="sm">Update password</x-button>
                    </div>
                </x-card>

                <x-card class="p-5 sm:p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Two-factor authentication
                            </h2>
                            <p class="mt-1 text-xs text-muted">Add an extra layer of security to your account.</p>
                        </div>
                        <x-badge tone="positive">
                            <x-icon name="shield-check" :size="11" /> Enabled
                        </x-badge>
                    </div>

                    <div
                        class="mt-5 flex items-center justify-between gap-4 rounded-xl bg-surface-2 p-4 ring-1 ring-inset ring-line/70">
                        <div class="flex items-center gap-3">
                            <span class="grid size-10 place-items-center rounded-xl bg-positive-soft text-positive">
                                <x-icon name="key-round" :size="18" />
                            </span>
                            <div>
                                <p class="text-[13px] font-medium text-ink">Authenticator app</p>
                                <p class="mt-0.5 text-xs text-muted">Configured on Oct 12, 2026</p>
                            </div>
                        </div>
                        <x-button variant="secondary" size="sm">Reconfigure</x-button>
                    </div>
                </x-card>

                <x-card class="p-5 sm:p-6">
                    <h2 class="text-[15px] font-semibold tracking-[-0.01em] text-ink">Active sessions</h2>
                    <p class="mt-1 text-xs text-muted">Devices currently signed in to your account.</p>

                    <div class="mt-5 space-y-3">
                        @foreach ([
                        ['device' => 'MacBook Pro · Chrome', 'location' => 'Jakarta, Indonesia', 'meta' => 'Current
                        session', 'icon' => 'monitor', 'current' => true],
                        ['device' => 'iPhone 15 · Safari', 'location' => 'Jakarta, Indonesia', 'meta' => 'Active 2 hours
                        ago', 'icon' => 'smartphone', 'current' => false],
                        ] as $session)
                        <div class="flex items-center gap-3 rounded-xl border border-line p-3.5">
                            <span
                                class="grid size-10 place-items-center rounded-xl bg-surface-2 text-muted ring-1 ring-inset ring-line">
                                <x-icon :name="$session['icon']" :size="18" />
                            </span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-[13px] font-medium text-ink">{{ $session['device'] }}</p>
                                <p class="text-[11px] text-faint">{{ $session['location'] }} · {{ $session['meta'] }}
                                </p>
                            </div>
                            @if ($session['current'])
                            <x-badge tone="positive">This device</x-badge>
                            @else
                            <x-button variant="ghost" size="sm">Sign out</x-button>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-layouts.app>