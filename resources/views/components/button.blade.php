@props([
    'variant' => 'secondary',
    'size' => 'md',
    'icon' => null,
    'iconRight' => null,
    'href' => null,
    'type' => 'button',
])

@php
    $variants = [
        'primary' => 'bg-ink text-canvas hover:opacity-90 shadow-sm',
        'secondary' => 'border border-line bg-surface text-ink hover:bg-surface-2 hover:border-line-strong shadow-[0_1px_2px_rgb(var(--shadow-color)/0.04)]',
        'ghost' => 'text-muted hover:bg-surface-2 hover:text-ink',
        'brand' => 'bg-brand text-white hover:bg-brand-strong shadow-[0_8px_24px_-12px_var(--brand)]',
        'soft' => 'bg-surface-3 text-ink hover:bg-line',
    ];

    $sizes = [
        'sm' => 'h-9 gap-1.5 rounded-lg px-3.5 text-[13px]',
        'md' => 'h-10 gap-2 rounded-xl px-4 text-sm',
        'lg' => 'h-11 gap-2 rounded-xl px-5 text-sm',
        'icon' => 'size-10 justify-center rounded-xl',
        'icon-sm' => 'size-9 justify-center rounded-lg',
    ];

    $classes = 'inline-flex shrink-0 items-center justify-center font-medium tracking-[-0.01em] transition-all duration-200 disabled:pointer-events-none disabled:opacity-50 '
        .($variants[$variant] ?? $variants['secondary']).' '
        .($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" :size="16" :stroke="2" />
        @endif
        {{ $slot }}
        @if ($iconRight)
            <x-icon :name="$iconRight" :size="16" :stroke="2" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)
            <x-icon :name="$icon" :size="16" :stroke="2" />
        @endif
        {{ $slot }}
        @if ($iconRight)
            <x-icon :name="$iconRight" :size="16" :stroke="2" />
        @endif
    </button>
@endif
