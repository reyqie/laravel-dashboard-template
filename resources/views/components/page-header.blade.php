@props([
    'eyebrow' => null,
    'title' => '',
    'accent' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-5 pb-7 pt-8 sm:flex-row sm:items-end sm:justify-between']) }}>
    <div class="min-w-0">
        @if ($eyebrow)
            <p class="mb-2.5 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.18em] text-faint">
                <span class="h-px w-5 bg-line-strong"></span>
                {{ $eyebrow }}
            </p>
        @endif

        <h1 class="text-[28px] font-semibold leading-[1.1] tracking-[-0.035em] text-ink sm:text-[34px]">
            {{ $title }}@if ($accent)
                <span class="font-serif font-normal italic tracking-[-0.01em] text-ink">{{ $accent }}</span>
            @endif
        </h1>

        @if ($description)
            <p class="mt-2 max-w-xl text-sm leading-relaxed text-muted">{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
        <div class="flex flex-wrap items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
