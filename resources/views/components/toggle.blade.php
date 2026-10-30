@props([
    'name' => null,
    'checked' => false,
    'label' => 'Toggle setting',
])

<label class="inline-flex cursor-pointer items-center">
    <input type="checkbox" @if ($name) name="{{ $name }}" @endif class="peer sr-only" @checked($checked) aria-label="{{ $label }}" />
    <span class="relative h-6 w-11 rounded-full bg-line-strong transition-colors duration-300 after:absolute after:left-0.5 after:top-0.5 after:size-5 after:rounded-full after:bg-white after:shadow-sm after:transition-transform after:duration-300 peer-checked:bg-brand peer-checked:after:translate-x-5 peer-focus-visible:ring-2 peer-focus-visible:ring-brand/50 peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-surface"></span>
</label>
