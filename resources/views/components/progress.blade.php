@props([
    'value' => 0,
    'tone' => 'brand',
    'height' => 'h-1.5',
])

@php
    $colors = [
        'brand' => 'bg-brand',
        'positive' => 'bg-positive',
        'warning' => 'bg-warning',
        'negative' => 'bg-negative',
        'info' => 'bg-info',
        'ink' => 'bg-ink',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'w-full overflow-hidden rounded-full bg-surface-3 '.$height]) }} role="progressbar" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">
    <div class="h-full rounded-full transition-[width] duration-700 ease-out {{ $colors[$tone] ?? $colors['brand'] }}" style="width: {{ max(0, min(100, (int) $value)) }}%"></div>
</div>
