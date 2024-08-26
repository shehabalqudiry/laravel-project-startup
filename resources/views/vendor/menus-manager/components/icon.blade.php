<i {{ $attributes }}>
    @isset($slot)
    {{ $slot }}
    @else
    {{ $icon }}
    @endif
</i>
