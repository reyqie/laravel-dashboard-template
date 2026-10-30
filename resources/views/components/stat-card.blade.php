@props([
    'label' => '',
    'value' => '',
    'delta' => null,
    'trend' => 'up',
    'caption' => null,
    'icon' => 'activity',
    'tone' => 'brand',
    'spark' => [],
    'positive' => null,
])

@php
    $tones = [
        'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
        'positive' => 'bg-positive-soft text-positive',
        'warning' => 'bg-warning-soft text-warning',
        'info' => 'bg-info-soft text-info',
        'negative' => 'bg-negative-soft text-negative',
    ];

    $sparkColors = [
        'brand' => 'text-brand',
        'positive' => 'text-positive',
        'warning' => 'text-warning',
        'info' => 'text-info',
        'negative' => 'text-negative',
    ];

    $spark = is_array($spark) ? $spark : [];
    $sparkId = 'spark-'.md5($label);
    $coordinates = collect($spark)->map(function (float|int $point, int $index) use ($spark): string {
        $count = count($spark);
        $min = min($spark);
        $max = max($spark);
        $range = max($max - $min, 1);
        $x = $count > 1 ? ($index / ($count - 1)) * 100 : 0;
        $y = 34 - (($point - $min) / $range) * 28;

        return round($x, 2).','.round($y, 2);
    });
@endphp

<div {{ $attributes->merge(['class' => 'group relative overflow-hidden rounded-2xl border border-line bg-surface p-5 shadow-card transition duration-300 hover:-translate-y-0.5 hover:shadow-float']) }}>
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <p class="text-[13px] font-medium text-muted">{{ $label }}</p>
            <p class="tabular mt-2.5 text-[26px] font-semibold leading-none tracking-[-0.03em] text-ink sm:text-[28px]">{{ $value }}</p>
        </div>

        <span class="grid size-10 shrink-0 place-items-center rounded-xl ring-1 ring-inset ring-black/[0.03] dark:ring-white/[0.04] {{ $tones[$tone] ?? $tones['brand'] }}">
            <x-icon :name="$icon" :size="18" :stroke="1.8" />
        </span>
    </div>

    <div class="mt-5 flex items-end justify-between gap-3">
        <div class="flex flex-wrap items-center gap-2">
            @if ($delta)
                <x-delta :value="$delta" :trend="$trend" :caption="$caption" :positive="$positive" />
            @elseif ($caption)
                <span class="text-xs text-faint">{{ $caption }}</span>
            @endif
        </div>

        @if (count($spark) > 1)
            <svg viewBox="0 0 100 38" preserveAspectRatio="none" class="h-9 w-20 shrink-0 {{ $sparkColors[$tone] ?? $sparkColors['brand'] }}" aria-hidden="true">
                <defs>
                    <linearGradient id="{{ $sparkId }}" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="currentColor" stop-opacity="0.22" />
                        <stop offset="100%" stop-color="currentColor" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <polygon points="0,38 {{ $coordinates->implode(' ') }} 100,38" fill="url(#{{ $sparkId }})" />
                <polyline points="{{ $coordinates->implode(' ') }}" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke" />
            </svg>
        @endif
    </div>
</div>
