@props([
    'tone' => 'neutral',
    'dot' => true,
])

@php
    $tones = [
        'neutral' => 'bg-surface-3 text-muted',
        'brand' => 'bg-brand-soft text-brand-ink dark:text-brand',
        'positive' => 'bg-positive-soft text-positive',
        'negative' => 'bg-negative-soft text-negative',
        'warning' => 'bg-warning-soft text-warning',
        'info' => 'bg-info-soft text-info',
        'outline' => 'border border-line bg-transparent text-muted',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-[11px] font-semibold leading-none '.($tones[$tone] ?? $tones['neutral'])]) }}>
    @if ($dot)
        <span class="size-1.5 rounded-full bg-current"></span>
    @endif
    {{ $slot }}
</span>
