@props([
    'name' => '',
    'tone' => 'brand',
    'size' => 'md',
    'status' => null,
])

@php
    $initials = collect(explode(' ', trim($name)))
        ->filter()
        ->take(2)
        ->map(fn (string $part): string => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');

    $tones = [
        'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
        'info' => 'bg-info-soft text-info',
        'positive' => 'bg-positive-soft text-positive',
        'warning' => 'bg-warning-soft text-warning',
        'negative' => 'bg-negative-soft text-negative',
        'neutral' => 'bg-surface-3 text-muted',
    ];

    $sizes = [
        'xs' => 'size-7 text-[10px]',
        'sm' => 'size-8 text-[11px]',
        'md' => 'size-9 text-xs',
        'lg' => 'size-11 text-sm',
        'xl' => 'size-16 text-lg',
    ];
@endphp

<span class="relative inline-grid shrink-0 place-items-center rounded-full font-semibold tracking-tight ring-1 ring-inset ring-black/[0.03] dark:ring-white/[0.04] {{ $tones[$tone] ?? $tones['brand'] }} {{ $sizes[$size] ?? $sizes['md'] }}">
    {{ $initials }}

    @if ($status)
        <span class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full border-2 border-surface {{ $status === 'online' ? 'bg-positive' : 'bg-faint' }}"></span>
    @endif
</span>
