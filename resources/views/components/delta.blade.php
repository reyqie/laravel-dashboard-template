@props([
    'value' => '',
    'trend' => 'up',
    'caption' => null,
    'size' => 'sm',
    'positive' => null,
])

@php($isPositive = $positive ?? $trend === 'up')

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5']) }}>
    <span class="inline-flex items-center gap-1 rounded-full font-semibold leading-none {{ $size === 'xs' ? 'px-2 py-1 text-[10px]' : 'px-2 py-1 text-[11px]' }} {{ $isPositive ? 'bg-positive-soft text-positive' : 'bg-negative-soft text-negative' }}">
        <x-icon :name="$trend === 'up' ? 'arrow-up-right' : 'arrow-down-right'" :size="11" :stroke="2.4" />
        {{ $value }}
    </span>

    @if ($caption)
        <span class="text-xs text-faint">{{ $caption }}</span>
    @endif
</span>
