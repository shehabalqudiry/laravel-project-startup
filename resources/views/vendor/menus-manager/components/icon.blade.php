<i {{ $attributes->merge($item->attributes) }}>
    @isset($slot)
    {{ $slot }}
    @else
    {{ $icon }}
    @endif
</i>
