<ul {{ $attributes }}>
    @foreach($items as $item)
        @if ($item->isDivider())
        <x-menus-divider :item="$item" class="py-2 px-16 border-0 bg-gray-500 text-gray-500 h-px" />
        @else
            <x-menus-item :item="$item" class="nav-item {{ $item->isActive() ? 'active' : '' }}" />
        @endif
    @endforeach
</ul>

